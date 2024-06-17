@extends('layouts.app')

@section('content')
<div class="creare  max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1>Edit Person</h1>
    <form method="POST" action="{{ route('people.update', ['people'=> $people->id]) }}" multiple enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    
        <div class="mb-4">
            <label for="name"class="block text-gray-700 font-medium">Name</label>
            <input type="text"class="w-full p-2 border border-gray-300 rounded mt-1" id="name" name="name" value="{{$people->name}}" placeholder="name" require>
        </div>
        
        <div class="mb-4">
            <label for="lastname"class="block text-gray-700 font-medium">Last Name</label>
            <input type="text"class="w-full p-2 border border-gray-300 rounded mt-1" id="lastname" name="last_name" value="{{$people->last_name}}" placeholder="last_name"require>
        </div>
        <div class="mb-4">
            <label for="img"class="block text-gray-700 font-medium">foto</label>
            <input type="file"class="w-full p-2 border border-gray-300 rounded mt-1" id="img" name="img"value="{{$people->img}}" placeholder="img"require>
        </div>

        <div class="mb-4">
            <label for="birth_date"class="block text-gray-700 font-medium">Birth Date</label>
            <input type="date"class="w-full p-2 border border-gray-300 rounded mt-1" id="birth_date" name="birth_date"value="{{$people->birth_date}}" placeholder="birth_date"require>
        </div>
        <div class="mb-4">
            <label for="birth_place"class="block text-gray-700 font-medium">Birth Place</label>
            <input type="text"class="w-full p-2 border border-gray-300 rounded mt-1" id="birth_place" name="birth_place" value="{{$people->birth_place}}" placeholder="birth_place"require>
        </div>

        <div class="mb-4">
            <label for=" death_date"class="block text-gray-700 font-medium">Death Date</label>
            <input type="date"class="w-full p-2 border border-gray-300 rounded mt-1" id=" death_date" name=" death_date" value="{{$people->death_date}}" placeholder=" death_date"require>
        </div>
        <div class="mb-4">
            <label for="death_place"class="block text-gray-700 font-medium">Death Place</label>
            <input type="text"class="w-full p-2 border border-gray-300 rounded mt-1" id="death_place" name="death_place" value="{{$people->death_place}}" placeholder="death_place"require>
        </div>

        <div class="mb-4">
            <select name="gender" id="gender" aria-valuemax="{{$people->gender}}">
                <option value="F">Female</option>
                <option value="M">Male</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="city"class="block text-gray-700 font-medium">City</label>
            <input type="text"class="w-full p-2 border border-gray-300 rounded mt-1"id="city" name="city" value="{{$people->city}}" placeholder="city"require>
        </div>
        <div class="mb-4">
            <label for="country"class="block text-gray-700 font-medium">Contry</label>
            <input type="text" class="w-full p-2 border border-gray-300 rounded mt-1"id="country" value="{{$people->country}}" name="country" placeholder="country"require>
        </div>


        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded mt-4">Save</button>


    </form>
</div>
@endsection