@extends('layouts.app')

@section('content')
<div class="creare  max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-6 py-10" >Create Gallery</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{route('people.history.store', ['people' => $people_id]) }}" multiple enctype="multipart/form-data" method="POST">
        @csrf
         <input type="hidden" name="people_id" value="{{$people_id}}">
        <div class="mb-4">
           
            <label for="school"class="block text-gray-700 font-medium">School</label> 
            <input type="date"class="w-full p-2 border border-gray-300 rounded mt-1" id="school" name="school" require>
        </div>
        <div class="mb-4">
            <label for="university"class="block text-gray-700 font-medium">University</label>
            <input type="date"class="w-full p-2 border border-gray-300 rounded mt-1" id="name" name="university" require>
        </div>
        <div class="mb-4">
            <label for="work"class="block text-gray-700 font-medium">Work</label>
            <input type="date"class="w-full p-2 border border-gray-300 rounded mt-1" id="work" name="work" require>
        </div>
        <div class="mb-4">
            <label for="married"class="block text-gray-700 font-medium">Married</label>
            <input type="date"class="w-full p-2 border border-gray-300 rounded mt-1" id="married" name="married" require>
        </div>

        <div class="mb-4">
            <label for="divorce"class="block text-gray-700 font-medium">Divorce</label>
            <input type="date"class="w-full p-2 border border-gray-300 rounded mt-1" id="divorce" name="divorce" require>



        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded mt-4">Create</button>
    </form>
</div>
@endsection
