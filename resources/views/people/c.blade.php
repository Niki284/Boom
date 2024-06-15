@extends('layouts.app')

@section('content')
<div class="create max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-6 py-10">Create Marriage</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('people.storeMarriage', $person->id) }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label for="spouse_id" class="block text-gray-700 font-medium">Spouse (existing)</label>
            <select name="spouse_id" id="spouse_id" class="w-full p-2 border border-gray-300 rounded mt-1">
                <option value="">Select an existing spouse</option>
                @foreach ($people as $person)
                    <option value="{{ $person->id }}">{{ $person->name }} {{ $person->last_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="spouse_name" class="block text-gray-700 font-medium">Spouse Name (new)</label>
            <input type="text" name="spouse_name" id="spouse_name" class="w-full p-2 border border-gray-300 rounded mt-1">
        </div>

        

        <div class="mb-4">
            <label for="spouse_last_name" class="block text-gray-700 font-medium">Spouse Last Name (new)</label>
            <input type="text" name="spouse_last_name" id="spouse_last_name" class="w-full p-2 border border-gray-300 rounded mt-1">
        </div>

        <div class="mb-4">
            <label for="spouse_gender" class="block text-gray-700 font-medium">Spouse Gender (new)</label>
            <select name="spouse_gender" id="spouse_gender" class="w-full p-2 border border-gray-300 rounded mt-1">
                <option value="M">Male</option>
                <option value="F">Female</option>
            </select>
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded mt-4">Create Marriage</button>
    </form>
</div>
@endsection
