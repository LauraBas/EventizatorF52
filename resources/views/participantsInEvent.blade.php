<x-app-layout>

    <div class="md:container md:mx-auto p-8 flex justify-center text-6l">
       Participants in event {{$event->title}}
    </div>          
    @foreach($participantsInEvent as $participant)
        
        <li class=" pl-3 list-decimal">{{ $participant }}</li>
        
    @endforeach
        
   
</x-app-layout>