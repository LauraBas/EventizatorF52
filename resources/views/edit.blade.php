
<form action="{{route('update', $event)}}" method="POST">
    @method('PUT')
    @csrf
    <div>
        <label for="title" value="__('Title')"/>
        <input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $event->title }}"/>
    </div>
    <div>
        <label for="date" value="__('Date')"/>
        <input id="date" class="block mt-1 w-full" type="date" name="date" value="{{ $event->date }}" />
    </div>
    <div>
        <label for="Time" value="__('Time')"/>

        <input id="time" class="block mt-1 w-full" type="time" name="time" value="{{ $event->time }}" />
    </div>
    <div>
        <label for="description" value="__('Description')"/>

        <input id="description" class="block mt-1 w-full" type="text" name="description" value="{{ $event->description }}"/>
    </div>
    <div>
        <label for="capcity" value="__('Capacity')"/>

        <input id="capacity" class="block mt-1 w-full" type="number" name="capacity"
                 value="{{ $event->capacity }}" />
    </div>
    <div>
        <label for="requirements" value="__('Requirements')"/>

        <input id="requirements" class="block mt-1 w-full" type="text" name="requirements"
                 value="{{ $event->requirements }}" />
    </div>
    <div>
        <label for="image" value="__('Image')"/>

        <input id="image" class="block mt-1 w-full" type="text" name="image" value="{{ $event->image }}" />
    </div>
    <div>
        <label for="link" value="__('Link')"/>

        <input id="link" class="block mt-1 w-full" type="text" name="link" value="{{ $event->link }}" />
    </div>
    <div>
        <button class="ml-3" type="submit">
            {{ __('Submit') }}
        </button>
        <a href="{{route('dashboard')}}">
            <input type="button" value="Cancel"/>
        </a>
    </div>
</form>
