<x-app-layout>
    <div class="md:container md:mx-auto p-8 flex justify-center text-6xl">
            Admin Dashboard
    </div>

    <div class="md:container md:mx-auto p-8 flex justify-center text-6xl">
        <form action="{{'/event/create'}}" method="get">
            <button class="h-10 px-6 text-base text-yellow-600 transition-colors duration-150 bg-white rounded-lg focus:shadow-outline hover:bg-yellow-200" type="submit">Create a new event</button>                                  
        </form>
    </div>

    <div class= "container my-12 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
                
                @foreach ($events as $event)
                <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">

                    <article class="overflow-hidden rounded-lg shadow-lg">

                        <a href="#">
                            <img alt="Placeholder" class="block h-auto w-full" src="{{$event->image}}">
                        </a>

                        <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                            <div class=" font-light text-grey-darker text-base inset-y-0 right-0">
                                {{$event->date}}
                            </div>
                            <div class=" font-extra-light text-grey-darker text-base inset-y-0 right-0">
                                {{$event->time}}
                            </div>
                        </header>

                        <div class="px-4 py-4 md:px-10">

                            <h1 class="text-6x1 font-bold text-yellow-600">{{$event->title}}</h1>

                            <p class="py-4"> {{$event->description}} </p>

                            <div class="flex flex-wrap pt-8 justify-around">

                                <div class="w-full md:w-1/3 text-sm font-medium text-yellow-600">
                                    {{$event->participants}} / {{$event->capacity}}
                                    <p class="text-black">current participants</p>
                                </div>
                       
                                <form action="{{ route('edit', ['id' => $event->id]) }}" method="get">
                                    <button class="h-10 px-6 text-base text-yellow-600 transition-colors duration-150 bg-white rounded-lg focus:shadow-outline hover:bg-yellow-200" type="submit">EDIT</button>
                                </form> 
                                <form action="{{ route('delete', ['id' => $event->id]) }}" method="POST">
                                    <button class="h-10 px-6 text-base text-yellow-600 transition-colors duration-150 bg-white rounded-lg focus:shadow-outline hover:bg-yellow-200" type="submit">DELETE</button>
                                    @method('DELETE')
                                    {{ csrf_field() }} 
                                </form> 
                                <form action="{{ route('participants', ['id' => $event->id]) }}" method="get">
                                    <button class="h-8 px-4 text-base text-yellow-600 transition-colors duration-150 bg-white rounded-lg focus:shadow-outline hover:bg-yellow-200" type="submit">SEE</button>
                                </form>              

                            </div>
                        </div>

                    </article>
                </div>
                @endforeach
        </div>
        {!! $events->links() !!}
    </div>

</x-app-layout>
