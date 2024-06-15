<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 welcome">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                  


                    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
        <h1 class="text-4xl">Families</h1>
    </div>
    <div class="welcome__info flex items-center space-x-4">
        <img src="/famillie.jpg" alt="Family" class="h-40 w-40 rounded-xl shadow-lg">
        <p class="text-lg">
            The following map shows the language families of Europe (distinguished by colour) and languages within those families. Note that the terms “language” and “dialect” are not mutually exclusive, and some of the languages shown in the map may be considered dialects of others.
        </p>
    </div>
    <div class="welcome__buton">
         <a class="btn-primary mt-4" href="{{ route('people.index') }}">Create family</a>
    </div>
            </div>
        </div>
    </div>
</div>
                </div>

</x-app-layout>
