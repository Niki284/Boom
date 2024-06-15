@extends('layouts.app')

@section('content')
<div class="flex flex-col gap-4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-6 py-10">Stamboom</h1>
    <style>
        .tree ul {
            padding-top: 20px;
            position: relative;
            transition: all 0.5s;
        }

        .tree li {
            float: left;
            text-align: center;
            list-style-type: none;
            position: relative;
            padding: 40px 10px 0 10px;
            transition: all 0.5s;
        }

        .tree li::before, .tree li::after {
            content: '';
            position: absolute;
            top: 0;
            right: 50%;
            border-top: 1px solid #ccc;
            width: 50%;
            height: 40px;
        }

        .tree li::after {
            right: auto;
            left: 50%;
            border-left: 1px solid #ccc;
        }

        .tree li:only-child::after, .tree li:only-child::before {
            display: none;
        }

        .tree li:only-child {
            padding-top: 0;
        }

        .tree li:first-child::before, .tree li:last-child::after {
            border: 0 none;
        }

        .tree li:last-child::before {
            border-right: 1px solid #ccc;
            border-radius: 0 5px 0 0;
        }

        .tree li:first-child::after {
            border-radius: 5px 0 0 0;
        }

        .tree ul ul::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            border-left: 1px solid #ccc;
            width: 0;
            height: 40px;
        }

        .tree li a {
            border: 1px solid #ccc;
            padding: 10px 15px;
            text-decoration: none;
            color: #666;
            font-family: arial, verdana, tahoma;
            font-size: 14px;
            display: inline-block;
            border-radius: 5px;
            transition: all 0.5s;
        }

        .tree li a:hover {
            background: #c8e4f8;
            color: #000;
            border: 1px solid #94a0b4;
        }

        .M {
            background-color: lightblue;
            color: black;
        }

        .F {
            background-color: pink;
            color: black;
        }

        .createUser {
            /* margin:10px 60px; */
        }
         .createUser--mariad {
            /* margin: 4.5rem 60px; */
        } 
    </style>

    <div class="tree">

    <form method="GET" action="{{ route('people.index') }}">
        <div class="form-group">
            <input type="text" name="search" class="form-control" placeholder="Zoek op naam of achternaam" value="{{ request('search') }}">
        </div>
        <button type="submit" class="btn btn-primary">Zoeken</button>
    </form>
        {{ View::make('people.people', ['people' => $people]) }}
    </div>
    <div class="flex justify-end">
        <a class="p-2 m-4 rounded border-solid border-2 border-indigo-600 hover:bg-blue-400 hover:text-white" href="{{ route('people.create') }}">Create people</a>
    </div>
</div>
@endsection
