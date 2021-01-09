<x-app-layout>  
    <div class="md:container md:mx-auto p-8 flex justify-center text-6l">
       <h2 class="text-yellow-600 pt-4 lg:text-2xl">Your Coming Events</h2>
    </div>                
    <div class= "container my-12 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap -mx-1 lg:-mx-4">
                @foreach ($commingEvents as $commingEvent)
                <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">

                    <article class="overflow-hidden rounded-lg shadow-lg">

                        <a href="#">
                            <img alt="Placeholder" class="block h-auto w-full" src="{{$commingEvent->image}}">
                        </a>

                        <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                            <div class=" font-light text-grey-darker text-base inset-y-0 right-0">
                                {{$commingEvent->date}}
                            </div>
                            <div class=" font-extra-light text-grey-darker text-base inset-y-0 right-0">
                                {{$commingEvent->time}}
                            </div>
                        </header>

                        <div class="px-4 py-4 md:px-10">

                            <h1 class="text-6x1 font-bold text-yellow-600">{{$commingEvent->title}}</h1>

                            <p class="py-4"> {{$commingEvent->description}} </p>

                            <div class="flex flex-wrap pt-8 justify-around">

                                <div class="w-full md:w-1/3 text-sm font-medium text-yellow-600">
                                    {{$commingEvent->participants}} / {{$commingEvent->capacity}}
                                    <p class="text-black">current participants</p>
                                </div>                                                                                  
                                <form action="{{ route('unenroll', ['id' => $commingEvent->id]) }}" method="post">
                                    @csrf
                                    <button class="h-10 px-6 text-base text-yellow-600 transition-colors duration-150 bg-white rounded-lg focus:shadow-outline hover:bg-yellow-200" type="submit">UNSUSCRIBE</button>
                                </form>                                                                                
                            </div>
                        </div>

                    </article>
                </div>
                @endforeach
        </div>
    </div>
    <div class="md:container md:mx-auto p-8 flex justify-center text-6l">
        <p class="text-yellow-600 lg:text-2xl"> Your Past Events</p>
    </div>  
    <div class= "container my-12 mx-auto px-4 md:px-12">
        <div class="flex flex-wrap -mx-1 lg:-mx-4">               
                @foreach ($pastEvents as $pastEvent)
                <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">

                    <article class="overflow-hidden rounded-lg shadow-lg">

                        <a href="#">
                            <img alt="Placeholder" class="block h-auto w-full" src="{{$pastEvent->image}}">
                        </a>

                        <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                            <div class=" font-light text-grey-darker text-base inset-y-0 right-0">
                                {{$pastEvent->date}}
                            </div>
                            <div class=" font-extra-light text-grey-darker text-base inset-y-0 right-0">
                                {{$pastEvent->time}}
                            </div>
                        </header>

                        <div class="px-4 py-4 md:px-10">

                            <h1 class="text-6x1 font-bold text-yellow-600">{{$pastEvent->title}}</h1>

                            <p class="py-4"> {{$pastEvent->description}} </p>
                        </div>

                    </article>
                </div>
                @endforeach
        </div>
    </div>
    
</x-app-layout>
