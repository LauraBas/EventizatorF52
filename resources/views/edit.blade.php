<x-app-layout>
    <div class="container md:container md:mx-auto p-8 flex justify-center ">
        <div class="box-border p-4 bg-white h-128 w-96">
            <form action="{{route('update', $event)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="mt-4">
                    <h2 class="font-bold text-center tx-6xl">Edit Event</h2>
                </div>
                <div class="mt-4">
                    <label for="title" value="__('Title')"/>
                    <input id="title" class="block mt-1 w-full bg-gray-200 border-gray-200 rounded-lg" type="text" name="title" value="{{ $event->title }}"/>
                </div>
                <div class="mt-4">
                    <label for="date" value="__('Date')"/>
                    <input id="date" class="block mt-1 w-full bg-gray-200 border-gray-200 rounded-lg" type="date" name="date" value="{{ $event->date }}"/>
                </div>
                <div class="mt-4">
                    <label for="Time" value="__('Time')"/>

                    <input id="time" class="block mt-1 w-full bg-gray-200 border-gray-200 rounded-lg" type="time" name="time" value="{{ $event->time }}"/>
                </div>
                <div class="mt-4">
                    <label for="description" value="__('Description')"/>

                    <input id="description" class="block mt-1 w-full bg-gray-200 border-gray-200 rounded-lg" type="text" name="description"
                           value="{{ $event->description }}"/>
                </div>
                <div class="mt-4">
                    <label for="capcity" value="__('Capacity')"/>

                    <input id="capacity" class="block mt-1 w-full bg-gray-200 border-gray-200 rounded-lg" type="number" name="capacity"
                           value="{{ $event->capacity }}"/>
                </div>
                <div class="mt-4">
                    <label for="requirements" value="__('Requirements')"/>

                    <input id="requirements" class="block mt-1 w-full bg-gray-200 border-gray-200 rounded-lg" type="text" name="requirements"
                           value="{{ $event->requirements }}"/>
                </div>
                <div class="mt-4">
                    <label for="image" value="__('Image')"/>

                    <input id="image" class="block mt-1 w-full bg-gray-200 border-gray-200 rounded-lg" type="text" name="image" value="{{ $event->image }}"/>
                </div>
                <div class="mt-4">
                    <label for="link" value="__('Link')"/>

                    <input id="link" class="block mt-1 w-full bg-gray-200 border-gray-200 rounded-lg" type="text" name="link" value="{{ $event->link }}"/>
                </div>
                <div class="mt-4 flex justify-center" role="group">
                    <button class="h-12 px-6 m-2 text-lg text-yellow-600 transition-colors duration-150 bg-white rounded-lg focus:shadow-outline hover:bg-yellow-200" type="submit">
                        {{ __('Submit') }}
                    </button >
                    <a href="{{route('dashboard')}}">
                        <input class="h-12 px-6 m-2 text-lg text-red-600 transition-colors duration-150 bg-white rounded-lg focus:shadow-outline hover:bg-red-200" type="button" value="Cancel"/>
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
