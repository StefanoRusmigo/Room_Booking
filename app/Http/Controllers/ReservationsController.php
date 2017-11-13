<?php


namespace App\Http\Controllers;

use App\Client;
use App\Room;
use App\Reservation;
use Illuminate\Http\Request;


class ReservationsController extends Controller
{
    //
    public function bookRoom($client_id, $room_id,$date_in, $date_out)
    {
    	$reservation = new Reservation;
    	$client = Client::find($client_id);
    	$room = Room::find($room_id);

    	$reservation->date_in = $date_in;
    	$reservation->date_out = $date_out;

    	$reservation->room()->associate($room);
    	$reservation->client()->associate($client);

    	if($room->isRoomBooked($date_in,$date_out)){
    		abort(405,'This room is already booked by someone else');
    	   
    	}

    	$reservation->save();


    	return redirect()->route('clients');
       // return view('reservations/bookRoom');
    }
}
