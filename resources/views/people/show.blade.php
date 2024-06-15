@extends('layouts.app')

@section('content')
<div class="detail max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="detail--back mt-4">
        <a href="{{ route('people.index') }}" class="bg-orange-500 text-white hover:bg-orange-400 hover:text-white p-2 rounded">Back</a>
    </div>
    <div class="detail--img my-4">
        <img src="{{$people->img}}" alt="" class="h-80  rounded">
    </div>

    <div class="detail--info my-4">
        <h1>
            {{ $people->name }}
            {{ $people->last_name}}
        </h1>


        <ul class="flex p-1 gap-1">
            <li>
                <span>
                    Country:
                    {{ $people->country }},
                    {{ $people->city }},
                    {{ $people->address }},
                </span>
            </li>
            <li>
                <span>
                    Brith and Death:
                    {{ $people->birth_date }} and {{ $people->death_date }}
                </span>
            </li>
        </ul>

        <h2 class="my-4">
            History
        </h2>

        <a href="{{route('people.history.create', ['people' => $people->id]) }}" class="bg-blue-500 text-white p-2 rounded mt-4 hover:bg-blue-400 hover:text-white"> Voeg History</a>
        <ul class="my-4 space-y-4">
            @foreach ($people->histories as $history)
            <li class="flex items-center justify-between space-x-2">
                <div class="flex items-center space-x-2">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h12M6 4v16M6 4H5m13 0v16m0-16h1m-1 16H6m12 0h1M6 20H5M9 7h1v1H9V7Zm5 0h1v1h-1V7Zm-5 4h1v1H9v-1Zm5 0h1v1h-1v-1Zm-3 4h2a1 1 0 0 1 1 1v4h-4v-4a1 1 0 0 1 1-1Z" />
                    </svg>
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300">School</h3>
                </div>
                <span class="text-gray-600 dark:text-gray-400">{{ $history->school }}</span>
            </li>
            <li class="flex items-center justify-between space-x-2">
                <div class="flex items-center space-x-2">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h12M6 4v16M6 4H5m13 0v16m0-16h1m-1 16H6m12 0h1M6 20H5M9 7h1v1H9V7Zm5 0h1v1h-1V7Zm-5 4h1v1H9v-1Zm5 0h1v1h-1v-1Zm-3 4h2a1 1 0 0 1 1 1v4h-4v-4a1 1 0 0 1 1-1Z" />
                    </svg>
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300">University</h3>
                </div>
                <span class="text-gray-600 dark:text-gray-400">{{ $history->university }}</span>
            </li>
            <li class="flex items-center justify-between space-x-2">
                <div class="flex items-center space-x-2">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 4h12M6 4v16M6 4H5m13 0v16m0-16h1m-1 16H6m12 0h1M6 20H5M9 7h1v1H9V7Zm5 0h1v1h-1V7Zm-5 4h1v1H9v-1Zm5 0h1v1h-1v-1Zm-3 4h2a1 1 0 0 1 1 1v4h-4v-4a1 1 0 0 1 1-1Z" />
                    </svg>
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300">Work</h3>
                </div>
                <span class="text-gray-600 dark:text-gray-400">{{ $history->work }}</span>
            </li>
            <li class="flex items-center justify-between space-x-2">
                <div class="flex items-center space-x-2">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M10.915 2.345a2 2 0 0 1 2.17 0l7 4.52A2 2 0 0 1 21 8.544V9.5a1.5 1.5 0 0 1-1.5 1.5H19v6h1a1 1 0 1 1 0 2H4a1 1 0 1 1 0-2h1v-6h-.5A1.5 1.5 0 0 1 3 9.5v-.955a2 2 0 0 1 .915-1.68l7-4.52ZM17 17v-6h-2v6h2Zm-6-6h2v6h-2v-6Zm-2 6v-6H7v6h2Z" clip-rule="evenodd" />
                        <path d="M2 21a1 1 0 0 1 1-1h18a1 1 0 1 1 0 2H3a1 1 0 0 1-1-1Z" />
                    </svg>
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300">Married</h3>
                </div>
                <span class="text-gray-600 dark:text-gray-400">{{ $history->married  }}</span>
            </li>
            <li class="flex items-center justify-between space-x-2">
                <div class="flex items-center space-x-2">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M3 21h18M4 18h16M6 10v8m4-8v8m4-8v8m4-8v8M4 9.5v-.955a1 1 0 0 1 .458-.84l7-4.52a1 1 0 0 1 1.084 0l7 4.52a1 1 0 0 1 .458.84V9.5a.5.5 0 0 1-.5.5h-15a.5.5 0 0 1-.5-.5Z" />
                    </svg>
                    <h3 class="font-semibold text-gray-700 dark:text-gray-300">Divorce</h3>
                </div>
                <span class="text-gray-600 dark:text-gray-400">{{ $history->divorce  }}</span>
            </li>
            @endforeach
        </ul>

    </div>

    <div class="detail__gallery">
        <h2 class="py-4 text-xl	">
            Gallery
        </h2>

        <div class="gallery__buttom">
            <ul class="gallery py-4">
                @foreach ($people->galleries as $image)
                <li>
                    <img src="{{ $image->images }}" alt="" class="h-40 w-40 p-2 rounded-xl">
                </li>
                @endforeach
            </ul>
            <div class="flex justify-end py-4">
                <a href="{{ route('people.gallery.create', ['people' => $people->id]) }}" class="bg-blue-500 text-white p-4 rounded mt-4 hover:bg-blue-400 hover:text-white">Create Gallery</a>
            </div>
        </div>
    </div>



</div>




@endsection