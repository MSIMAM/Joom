<?php

namespace App\Http\Controllers;


use App\Http\Requests\EventAndTourStoreRequest;
use App\Http\Requests\EventAndTourUpdateRequest;
use App\Models\EventAndTour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Symfony\Component\HttpFoundation\Response;

class EventAndTourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $eventAndTour = EventAndTour::with("artist")
                                    ->get()
                                    ->transform(fn($data) => [
                                        'id' => Crypt::encrypt($data->id) ?? null,    
                                        'artist_id' => $data->artist->id ?? null,    
                                        'artis_name'    => $data->artist->user->username ?? null, 
                                        'event_cover_photo' => $data->event_cover_photo ?? null,
                                        'venue'             => $data->venue ?? null,
                                        'ticket_availability'   => ($data->ticket_availability == 1) ? "Not free" :  "Free ticket",
                                        'event_tour_date'       => $data->event_tour_date ?? null,
                                        'event_date'            => $data->event_date ?? null

                                        
                                    ]);

        if($eventAndTour->isNotEmpty()){
            return response()->json([
                'status'    => Response::HTTP_OK,
                'event_and_tour'   => $eventAndTour
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventAndTourStoreRequest $request)
    {
        //

        $eventAndTour = EventAndTour::create([
            "artist_id" => $request->artist_id,
            "event_cover_photo" => $request->event_cover_photo,
            "venue" => $request->venue,
            "event_tour_date" => date("d-m-y"),
            "event_date" => time(),
        ]);

        if($eventAndTour){
            return response()->json([
                'status'    => Response::HTTP_OK,
                'message'   => 'Sucessfully created your event tour'
            ]);
        }
        return response()->json([
            'status'    => Response::HTTP_NOT_FOUND,
            'message'   => 'Somthing went wrong'
        ]);

    }
    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EventAndTour $eventAndTour)
    {
        //
        if($eventAndTour){
            return response()->json([
                'status'    => Response::HTTP_OK,
                'event_and_tour'   => $eventAndTour
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventAndTourUpdateRequest $request, EventAndTour $eventAndTour)
    {
        //
        $eventAndTourUpdate = $eventAndTour->update([
            "event_cover_photo" => $request->event_cover_photo,
            "venue" => $request->venue,
            "event_tour_date" => date("d-m-y"),
        ]);
        if($eventAndTourUpdate){
            return response()->json([
                'status'    => Response::HTTP_OK,
                'message'   => 'Sucessfully updated your event tour'
            ]);
        }
        return response()->json([
            'status'    => Response::HTTP_NOT_FOUND,
            'message'   => 'Somthing went wrong'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventAndTour $eventAndTour)
    {

        $eventAndTourDelete = $eventAndTour->delete();
        
        if($eventAndTourDelete){
            return response()->json([
                'status'    => Response::HTTP_OK,
                'message'   => 'Sucessfully deleted your event tour'
            ]);
        }
        return response()->json([
            'status'    => Response::HTTP_NOT_FOUND,
            'message'   => 'Somthing went wrong'
        ]);
    }
}
