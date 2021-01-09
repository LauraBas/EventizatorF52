<x-app-layout>
    <div class="md:container md:mx-auto p-8 flex justify-center text-yellow-600 pt-4 lg:text-2xl">
       Participants in event: {{$event->title}}
    </div>          
    @foreach($participantsInEvent as $participant)       
        <li class=" pl-3 list-decimal lg:text-2xl font-bold text-yellow-600">
            {{ $participant }}
        </li>       
    @endforeach  
</x-app-layout>