<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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
        $today = date('Y-m-d');
        $commingEvents = DB::table('events')
                    ->select(DB::raw('*'))
                    ->whereDate('date', '> ', $today)
                    ->orderByDesc('date')
                    ->paginate(3);
                                       
        $pastEvents = DB::table('events')
                ->select(DB::raw('*'))
                ->whereDate('date', '<', $today)
                ->orderByDesc('date')
                ->paginate(3);

        return view('events', compact('commingEvents', 'pastEvents'));
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

        return redirect('dashboard');

    }

    public function highlighted()
    {
        $today = date('Y-m-d');
        $highlightedEvents = DB::table('events')
                    ->select(DB::raw('*'))
                    ->where('isHighlighted', 1)
                    ->whereDate('date', '> ', $today)
                    ->orderByDesc('date')
                    ->paginate(3);

        return view('welcome', compact('highlightedEvents'));
    }
}
