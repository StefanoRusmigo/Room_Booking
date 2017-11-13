<?php

namespace App\Http\Controllers;
use App\Client;
use App\Room;

use Illuminate\Http\Request;

class RoomsController extends Controller
{
    //
    public function checkAvailableRooms($client_id, Request $request)
    {
    	$dateFrom = $request->input('dateFrom');
    	$dateTo = $request->input('dateTo');
    	$room = new Room();

    	$data = [];
    	$data['dateTo'] = $dateTo;
    	$data['dateFrom'] = $dateFrom;
    	$data['rooms'] = Room::getAvailablerooms($dateFrom,$dateTo);
    	$data['client'] = Client::find($client_id);

        return view('rooms/checkAvailableRooms',$data);
    }
}
