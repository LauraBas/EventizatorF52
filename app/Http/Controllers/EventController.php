<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all(); 
        $pastEvents = [];
        $commingEvents = [];

        foreach($events as $event)
        {
            if (strtotime($event['date']) < strtotime('now')) 
            {
                array_push($pastEvents, $event);
            }
            else
            {                           
                array_push($commingEvents, $event);
            }             
        }

        return view('events', compact('commingEvents', 'pastEvents'));
    }

    public function indexDashboard()
    {
        $events= Event::all(); 

        return view('dashboard', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = Event::create([
            'title' => $request->title,
            'date' => $request->date,
            'time' => $request->time,
            'description' => $request->description,
            'capacity' => $request->capacity,
            'requirements' => $request->requirements,
            'image' => $request->image,
            'link' => $request->link,
            'isHighlighted' =>$request->isHighlighted,
        ]);

        $event->save();
        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        return view('edit', compact('event'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $event->title = $request->title;
        $event->date = $request->date;
        $event->time = $request->time;
        $event->description = $request->description;
        $event->capacity = $request->capacity;
        $event->requirements = $request->requirements;
        $event->image = $request->image;
        $event->isHighlighted = $request->isHighlighted;
        $event->link= $request->link;

        $event->save();
        
        return redirect('dashboard');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();
        
        $events = Event::all(); 

        return redirect('dashboard');

    }

    public function highlighted()
    {
        $highlightedEvents = Event::where('isHighlighted', 1)
                                    ->get(); 

        return view('welcome', compact('highlightedEvents'));
    }
}
