<x-app-layout>
Events page


<div class= "container my-12 mx-auto px-4 md:px-12">
<div class="flex flex-wrap -mx-1 lg:-mx-4">
        
        @foreach ($events as $event)
        <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">

            <article class="overflow-hidden rounded-lg shadow-lg">

                <a href="#">
                    <img alt="Placeholder" class="block h-auto w-full" src="https://picsum.photos/600/400/?random">
                </a>

                <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                    <p class="text-grey-darker text-sm inset-y-0 right-0">
                        {{$event->date}} {{$event->time}}
                    </p>
                </header>

                <div class="px-4 py-4 md:px-10">

                    <h1 class="text-lg">{{$event->title}}</h1>

                    <p class="py-4"> {{$event->description}} </p>

                    <div class="flex flex-wrap pt-8">

                        <div class="w-full md:w-1/3 text-sm font-medium">
                            {{$event->participants}} / {{$event->capacity}}
                            <p>current participants</p>
                        </div>
                    </div>
                        <button class="uppercase bg-yellow-dark text-grey-darkest font-bold p-2 text-xs shadow rounded">JOIN</button>

                </div>

            </article>
        </div>
        @endforeach
</div>
</div>

</x-app-layout>
