<form action="{{route('updateEvent', $event)}}" method="POST">
    @method('put')
    @csrf
            <div>
                <x-label for="title" :value="__('Title')" />

                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="{{ $event->title }}" required autofocus />
            </div>
            <div>
                <x-label for="date" :value="__('Date')" />

                <x-input id="date" class="block mt-1 w-full" type="date" name="date" :value="{{ $event->date }}"  required autofocus />
            </div>
            <div>
                <x-label for="Time" :value="__('Time')" />

                <x-input id="time" class="block mt-1 w-full" type="time" name="time" :value="{{ $event->time }}"  required autofocus />
            </div>
            <div>
                <x-label for="description" :value="__('Description')" />

                <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="{{ $event->time }}" required autofocus />
            </div>
            <div>
                <x-label for="capcity" :value="__('Capacity')" />

                <x-input id="capacity" class="block mt-1 w-full" type="number" name="capacity" :value="{{ $event->requirements }}" required autofocus />
            </div>
            <div>
                <x-label for="requirements" :value="__('Requirements')" />

                <x-input id="requirements" class="block mt-1 w-full" type="text" name="requirements" :value="{{ $event->requirements }}" required autofocus />
            </div>
            <div>
                <x-label for="image" :value="__('Image')" />

                <x-input id="image" class="block mt-1 w-full" type="image" name="image" :value="{{ $event->image }}" required autofocus />
            </div>
            <!-- <div>
                <x-label for="highlighted" :value="__('Highlighted')" />

                <x-input id="highlighted" class="block mt-1 w-full" type="bool" name="highlighted" :value="{{ $event->isHighlighted }}"required autofocus />
            </div> -->
            <div>
                <x-label for="link" :value="__('Link')" />

                <x-input id="link" class="block mt-1 w-full" type="text" name="link" :value="old('link')" required autofocus />
            </div>
            <div>
                <x-button class="ml-3" type = "submit">
                    {{ __('Submit') }}
                </x-button>
                <a href= "{{route('admin')}}">
                    <input type="button"  value= "Cancel"/>
                </a>
            </div>
        </form>