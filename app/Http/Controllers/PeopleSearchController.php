<?php

namespace App\Http\Controllers;

use App\Models\People;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PeopleSearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function map()
    {
        return view('map');
    }

    public function search(Request $request)
    {
        $lastname = $request->query('lastname');
        $city = $request->query('city');
        $country = $request->query('country');

        if (!$lastname || !$city || !$country) {
            return response()->json(['error' => 'Achternaam, stad en land zijn verplicht'], 400);
        }

        // Zoek mensen in de database op achternaam, stad en land
        $users = People::where('lastname', $lastname)
                     ->where('city', $city)
                     ->where('country', $country)
                     ->get();

        if ($users->isEmpty()) {
            return response()->json(['message' => 'Geen gebruikers gevonden'], 404);
        }

        // Mapbox API sleutel
        $mapboxApiKey = env('MAPBOX_API_KEY');

        $client = new Client();

        $locations = $users->map(function($user) use ($client, $city, $country, $mapboxApiKey) {
            $response = $client->get("https://api.mapbox.com/geocoding/v5/mapbox.places/{$city},{$country}.json", [
                'query' => [
                    'access_token' => $mapboxApiKey,
                    'limit' => 1
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            if (empty($data['features'])) {
                return null;
            }

            $coordinates = $data['features'][0]['center'];
            return [
                'user' => $user,
                'location' => [
                    'longitude' => $coordinates[0],
                    'latitude' => $coordinates[1]
                ]
            ];
        })->filter(); // Filter resultaten zonder locatie

        return response()->json($locations);
    }
}