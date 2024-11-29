import requests
import json
import os
import time
from dotenv import load_dotenv
import concurrent.futures
from datetime import datetime

# Load .env variables
load_dotenv()

# Default variables
API_URL = os.getenv("API_URL")
CLIENT_ID = os.getenv("TWITCH_CLIENT_ID")
CLIENT_SECRET = os.getenv("TWITCH_SECRET")
AUTH_URL = os.getenv("AUTH_URL")

# Authenticate and get access token
def authenticate():
    params = {
        'client_id': CLIENT_ID,
        'client_secret': CLIENT_SECRET,
        'grant_type': 'client_credentials'
    }
    response = requests.post(AUTH_URL, params=params)
    response.raise_for_status()
    auth_data = response.json()
    return auth_data['access_token']

auth = authenticate()

# Headers for authentication
headers = {
    'Client-ID': CLIENT_ID,
    'Authorization': f'Bearer {auth}',
    'Accept': 'application/json',
}

# Load endpoints and fields from JSON file
def load_endpoints():
    with open('scripts/endpoints/endpoints.json') as e:
        return json.load(e)

# Make a single request to the API
def request_data(url, body, headers):
    response = requests.post(url, data=body, headers=headers)
    response.raise_for_status()
    return response.json()

# Format time for readability
def format_time(seconds):
    if seconds < 60:
        return f"{seconds:.2f} seconds"
    else:
        minutes = int(seconds // 60)
        remaining_seconds = seconds % 60
        return f"{minutes}m{remaining_seconds:.0f}s"

# Fetch data from the API
def fetch_data(endpoint, fields):
    limit = 500
    total_fetched = 0
    all_data = []
    offset = 0

    # Use ThreadPoolExecutor to make 4 requests concurrently
    with concurrent.futures.ThreadPoolExecutor(max_workers=4) as executor:
        while True:
            # Prepare up to 4 tasks
            tasks = []
            for _ in range(4):
                url = f'{API_URL}{endpoint}'
                body = f'fields {",".join(fields)}; limit {limit}; offset {offset};'
                tasks.append(executor.submit(request_data, url, body, headers))
                offset += limit

            # Flag to check if there’s no data left across all tasks
            no_more_data = True

            # Collect results from tasks
            for future in concurrent.futures.as_completed(tasks):
                try:
                    data = future.result()
                    if data:  # If data is returned, append it to the list
                        no_more_data = False
                        all_data.extend(data)
                        fetched_count = len(data)
                        total_fetched += fetched_count
                        print(f"{total_fetched} {endpoint} fetched", end="\r")

                except Exception as e:
                    print(f"Exception occurred: {str(e)}")
                    save_log(endpoint, total_fetched, str(e))

            # Stop if no more data across all tasks
            if no_more_data:
                break

            time.sleep(1)  # Ensure 1-second interval per batch of 4 requests

    # Final print statement to show total fetched after loop ends
    print(f"\nTotal {endpoint} fetched = {total_fetched}")
    return all_data, total_fetched

# Save data to JSON file
def save_to_json(data, filename):
    os.makedirs('scripts/data', exist_ok=True)
    with open(filename, 'w') as json_file:
        json.dump(data, json_file, indent=4)

# Save logs
def save_log(endpoint, total_fetched, error_message=None):
    log_file = 'scripts/logs/fetch_log.txt'
    os.makedirs('scripts/logs', exist_ok=True)
    now = datetime.now().strftime('%Y-%m-%d %H:%M:%S')
    with open(log_file, 'a') as log:
        if error_message:
            log.write(f"[{now}] ERROR: {error_message}\n")
        else:
            log.write(f"[{now}] Total {total_fetched} {endpoint} fetched\n")

def main():
    endpoints = load_endpoints()
    total_elapsed_start_time = time.time()
    for endpoint_data in endpoints:
        endpoint = endpoint_data['endpoint']
        fields = endpoint_data['fields']
        print(f"Fetching {endpoint}...")

        # Start the timer
        start_time = time.time()

        # Fetch the data
        games_data, total_fetched = fetch_data(endpoint, fields)

        # End the timer
        end_time = time.time()
        elapsed_time = end_time - start_time

        # Save the data
        save_to_json(games_data, f'scripts/data/{endpoint}_data.json')
        save_log(endpoint, total_fetched)

        # Print elapsed time for this endpoint
        print(f"Time elapsed for {endpoint}: {format_time(elapsed_time)}\n")

    total_elapsed_end_time = time.time()
    total_elapsed_time = total_elapsed_end_time - total_elapsed_start_time

    print(f'Total elapsed time: {format_time(total_elapsed_time)}')

if __name__ == "__main__":
    main()
