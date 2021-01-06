<x-app-layout>
    <div class="container md:container md:mx-auto p-8 flex justify-center">
        <div class="box-border p-4 bg-white h-128 w-96">
            <form action="{{route('store')}}" method="POST">
                @method('POST')
                @csrf
                <div class="mt-4">
                    <h2 class="font-bold text-center tx-6xl">Create Event</h2>
                </div>
                <div class="mt-4">
                    <label for="title" value="__('Title')"/>
                    <input id="title" class="block mt-1 w-full bg-gray-200 border-gray-200 rounded-lg" type="text" name="title" placeholder="title"/>
                </div>
                <div class="mt-4">
                    <label for="date" value="__('Date')"/>
                    <input id="date" class="block mt-1 w-full bg-gray-200 border-gray-200 rounded-lg" type="date" name="date" placeholder="date"/>
                </div>
                <div class="mt-4">
                    <label for="Time" value="__('Time')"/>

                    <input id="time" class="block mt-1 w-full bg-gray-200 border-gray-200 rounded-lg" type="time" name="time" placeholder="time"/>
                </div>
                <div class="mt-4">
                    <label for="description" value="__('Description')"/>

                    <input id="description" class="block mt-1 w-full bg-gray-200 border-gray-200 rounded-lg" type="text" name="description"
                           placeholder="description"/>
                </div>
                <div class="mt-4">
                    <label for="capacity" value="__('Capacity')"/>

                    <input id="capacity" class="block mt-1 w-full bg-gray-200 border-gray-200 rounded-lg" type="number" name="capacity"
                    placeholder="capacity"/>
                </div>
                <div class="mt-4">
                    <label for="requirements" value="__('Requirements')"/>

                    <input id="requirements" class="block mt-1 w-full bg-gray-200 border-gray-200 rounded-lg" type="text" name="requirements"
                    placeholder="requirements"/>
                </div>
                <div class="mt-4">
                    <label for="image" value="__('Image')"/>

                    <input id="image" class="block mt-1 w-full bg-gray-200 border-gray-200 rounded-lg" type="text" name="image" placeholder="image"/>
                </div>
                <div class="mt-4">
                    <label for="link" value="__('Link')"/>

                    <input id="link" class="block mt-1 w-full bg-gray-200 border-gray-200 rounded-lg" type="text" name="link" placeholder="link"/>
                </div>
                <div class=" mt-4">
                    <label for="isHighlighted">Highlighted Event</label>
                    <select id="isHighlighted" name="isHighlighted" class="focus:ring-indigo-500 focus:border-indigo-500 h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm rounded-md">
                        <option value="0">false</option>                   
                        <option value="1">true</option>
                    </select>                    
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
