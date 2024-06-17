@extends('layouts.app')


@section('content')


<link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />

<style>
    #map {
        position: absolute;
        top: 64px;
        /* Zorg dat het onder het zoekformulier begint */
        bottom: 0;
        width: 100%;
    }

    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        flex-direction: column;
    }

    #searchContainer {
        position: absolute;
        top: 60px;
        left: 0;
        width: 100%;
        z-index: 10;
        background-color: white;
        padding: 16px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
</style>


<div id="searchContainer">
    <div class="flex flex-col flex-auto items-start max-w-6xl mx-auto sm:px-6 lg:px-8	">
        <h1 class="text-2xl font-bold ml-4">Zoek gebruikers</h1>
    </div>

    <form id="searchForm" class="flex flex-wrap justify-center space-x-4">
        <div>
            <label for="lastname" class="block text-sm font-medium text-gray-700">Achternaam:</label>
            <input type="text" id="lastname" name="lastname" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="city" class="block text-sm font-medium text-gray-700">Stad:</label>
            <input type="text" id="city" name="city" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="country" class="block text-sm font-medium text-gray-700">Land:</label>
            <input type="text" id="country" name="country" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <button type="submit" class="mt-6 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Zoeken</button>
    </form>
</div>
<div id="map"></div>

<script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
<script>
    mapboxgl.accessToken = '{{ env("MAPBOX_API_KEY") }}';

    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [0, 0], // Beginpositie [lng, lat]
        zoom: 2
    });

    // Functie om markers aan de kaart toe te voegen
    function addMarkers(users) {
        users.forEach(function(user) {
            var el = document.createElement('div');
            el.className = 'marker';

            new mapboxgl.Marker(el)
                .setLngLat([user.location.longitude, user.location.latitude])
                .setPopup(new mapboxgl.Popup({
                        offset: 25
                    }) // Voeg popups toe
                    .setHTML('<h3>' + user.user.firstname + ' ' + user.user.lastname + '</h3><p>' + user.user.city + ', ' + user.user.country + '</p>'))
                .addTo(map);
        });
    }

    // Zoekopdracht uitvoeren bij indienen van formulier
    document.getElementById('searchForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var lastname = document.getElementById('lastname').value;
        var city = document.getElementById('city').value;
        var country = document.getElementById('country').value;

        fetch(`/search?lastname=${lastname}&city=${city}&country=${country}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    addMarkers(data);
                    // Verplaats kaart naar de eerste gebruiker
                    map.setCenter([data[0].location.longitude, data[0].location.latitude]);
                    map.setZoom(10);
                } else {
                    alert('Geen gebruikers gevonden.');
                }
            })
            .catch(error => console.error('Error:', error));
    });
</script>

@endsection