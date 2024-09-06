import requests
import json
import os
import time
from dotenv import load_dotenv
import sys

# Load .env variables
load_dotenv()

# Default variables
API_URL = os.getenv("API_URL")
CLIENT_ID = os.getenv("TWITCH_CLIENT_ID")
CLIENT_SECRET = os.getenv("TWITCH_SECRET")
AUTH_URL = os.getenv("AUTH_URL")

# Get access_token from IGDB
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

# Read endpoints and fields from JSON file
def load_endpoints():
    with open('scripts/endpoints/endpoints.json') as e:
        return json.load(e)

# Fetch data from the API
######### max_items for testing #########
def fetch_data(endpoint, fields, max_items):
    limit = 500
    offset = 0
    total_fetched = 0
    all_data = []

    while True:
        url = f'{API_URL}{endpoint}'
        body= f'fields {",".join(fields)}; limit {limit}; offset {offset};'

        response = requests.post(url, data=body, headers=headers)

        if response.status_code == 200:
            game_data = response.json()
            if not game_data:
                break
            all_data.extend(game_data)
            fetched_count = len(game_data)
            ###### Testing block ######
            if total_fetched + fetched_count > max_items:
                data = data[:max_items - total_fetched]
                fetched_count = len(data)
                all_data.extend(data)
                total_fetched += fetched_count
                break
            ###########################
            total_fetched += fetched_count
            offset += limit
            sys.stdout.write(f"{fetched_count} {endpoint} fetched")
            sys.stdout.flush()
            print(f"Total {endpoint} fetched = {total_fetched}".ljust(80))

        else:
            print(f"Error fetching data: {response.status_code} {response.text}")
            break

        ###### Testing block ######
        if total_fetched >= max_items:
            break
        ###########################

        time.sleep(0.25)  # Rate limit

    return all_data, total_fetched

# Save data to JSON file
def save_to_json(data, filename):
    # Ensure the directory exists
    os.makedirs('scripts/data', exist_ok=True)

    with open(filename, 'w') as json_file:
        json.dump(data, json_file, indent=4)

# Save logs
def save_log(endpoint, total_fetched):
    log_file = 'scripts/logs/fetch_log.txt'

    # Ensure the directory exists
    os.makedirs('scripts/logs', exist_ok=True)

    with open(log_file, 'a') as log:
        log.write(f"Total {total_fetched} {endpoint} fetched\n")

def main():
    endpoints = load_endpoints()

    ###### max_items for testing ######
    max_items = 1000
    ###################################

    # Iterate over each endpoint and fetch data
    for endpoint_data in endpoints:
        endpoint = endpoint_data['endpoint']
        fields = endpoint_data['fields']

        print(f"Fetching {endpoint}...")

        ####### max_items for testing ######
        games_data, total_fetched = fetch_data(endpoint, fields, max_items)
        ####################################

        global offset
        offset = 0

        # Save the data
        save_to_json(games_data, f'scripts/data/{endpoint}_data.json')

        # Save the total fetched count to a log file
        save_log(endpoint, total_fetched)

        print(f"Total {endpoint} fetched = {total_fetched}")

if __name__ == "__main__":
    main()
