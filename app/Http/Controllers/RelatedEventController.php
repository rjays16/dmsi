<?php

namespace App\Http\Controllers;

use App\Models\RelatedEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RelatedEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllEvents()
    {
        $data = RelatedEvent::all();
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RelatedEvent  $relatedEvent
     * @return \Illuminate\Http\Response
     */
    public function show(RelatedEvent $relatedEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RelatedEvent  $relatedEvent
     * @return \Illuminate\Http\Response
     */
    public function updateEvent(Request $request, $id)
    {
        $room = RelatedEvent::find($id);
        if ($request->hasFile('link_photo')) {
            Storage::delete($room->link_photo);
            $file = $request->file('link_photo');
            $path = $file->store('public/event');
            $name = $file->getClientOriginalName();

            $room->link_text = $request->input('link_text');
            $room->link_photo = $path;
            $room->link_url = $request->input('link_url');
            $room->event_type = $request->input('event_type');

            $room->save();
        }
        else {
            $room->update($request->all());
        }

        return response()->json([
            'status_code' => 202,
            'room' => $room
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RelatedEvent  $relatedEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(RelatedEvent $relatedEvent)
    {
        //
    }
}
