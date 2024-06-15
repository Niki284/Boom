@extends('layouts.app')

@section('content')
<div class="creare max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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

    <form action="{{ route('people.storeMarriage', $people->id) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="spouse_id" class="block text-gray-700 font-medium">Spouse</label>
            <select name="spouse_id" id="spouse_id" class="w-full p-2 border border-gray-300 rounded mt-1">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} {{ $user->last_name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded mt-4">Create Marriage</button>
    </form>
</div>
@endsection
