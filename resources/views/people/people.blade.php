@if(Auth::check())
<ul>
   
    @foreach ($people as $member)
        <li class="">
            <a href="{{ route('people.show', $member->id) }}" class="relative {{ $member->gender == 'M' ? 'M' : 'F' }}">
                <img src="{{ $member->img }}" alt="" class="h-40 w-40 p-2 rounded-xl">
                <h1 class="font-sans text-lg">
                    {{ $member->name }} {{ $member->last_name }}
                </h1>
                <p>Birth Date: {{ $member->birth_date }}</p>
            </a>
            <?php $marriages = $member->marriages; ?>
            @if ($marriages->count())
                <ul class="createUser--mariad">
                    @foreach ($marriages as $marriage)
                        <li class="m-4">
                            <a href="{{ route('people.show', $marriage->id) }}"> 
                                <img src="{{$marriage->img}}" alt="" class="h-24 w-30 p-2 rounded-xl">
                                Married to: {{ $marriage->name }} {{ $marriage->last_name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
            @if ($member->children->count())
                {{ View::make('people.people', ['people' => $member->children]) }}
            @endif

            <div class="flex items-center gap-0 absolute createUser">
                <a class="p-2 m-1 rounded border-solid border-2 border-indigo-600 hover:bg-blue-400 hover:text-white" href="{{ route('people.create', ['parent_id' => $member->id]) }}">+</a>
                <a class="p-2 m-1 rounded border-solid border-2 border-indigo-600 hover:bg-blue-400 hover:text-white" href="{{ route('people_marriage.create', $member->id) }}">Create marriage</a>
                
                <a class="p-2 m-1 rounded border-solid border-2 border-indigo-600 hover:bg-blue-400 hover:text-white" href="{{ route('people.edit', $member->id) }}">Edit</a>
                <form method="post" action="{{ route('people.destroy', $member->id) }}">
                    @csrf
                    @method('delete')
                    <input type="submit" value="X" class="cursor-pointer bg-red-500 hover:bg-red-700 text-white font-bold p-1 m-0 rounded">
                </form>
            </div>
        </li>
    @endforeach
</ul>
@endif
