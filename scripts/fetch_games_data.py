import requests
import json
import os
import time
from dotenv import load_dotenv
from queue import Queue
import sys

load_dotenv()

API_URL = os.getenv("API_URL")
CLIENT_ID = os.getenv("TWITCH_CLIENT_ID")
CLIENT_SECRET = os.getenv("TWITCH_SECRET")
AUTH_URL = os.getenv("AUTH_URL")

# Authtenticate with IGDB API
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

headers = {
    'Client-ID': CLIENT_ID,
    'Authorization': f'Bearer {auth}',
    'Accept': 'application/json',
}

fields = [
    'id',
    'artworks',
    'category',
    'checksum',
    'collections',
    'cover',
    'dlcs',
    'expansions',
    'first_release_date',
    'franchises',
    'game_localizations',
    'game_modes',
    'genres',
    'involved_companies',
    'language_supports',
    'multiplayer_modes',
    'name',
    'parent_game',
    'platforms',
    'player_perspectives',
    'release_dates',
    'screenshots',
    'similar_games',
    'slug',
    'storyline',
    'summary',
    'themes',
    'url',
    'videos',
    'websites'
]

limit = 500
offset = 0
all_games = []
def fetch_game_data():
    global offset
    progress = 0
    #q = Queue()

    while True:
        url = f'{API_URL}games'
        body= f'fields {",".join(fields)}; limit {limit}; offset {offset};'

        response = requests.post(url, data=body, headers=headers)

        if response.status_code == 200:
            game_data = response.json()
            if not game_data:
                break
            all_games.extend(game_data)
            offset += limit
            #q.put(game_data)
            sys.stdout.write(str(progress) + ' games fetched\r')
            sys.stdout.flush()
            progress += 500
        else:
            print(f"Error fetching data: {response.status_code} {response.text}")
            break

        time.sleep(1)  # Rate limit

    return all_games

def save_to_json(data, filename):
    with open(filename, 'w') as json_file:
        json.dump(data, json_file, indent=4)

def main():
    games_data = fetch_game_data()
    save_to_json(games_data, 'scripts/data/games_data.json')

if __name__ == "__main__":
    # Ensure the directory exists
    os.makedirs('scripts/data', exist_ok=True)
    # Fetch and save games
    main()
