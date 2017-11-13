<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Title as Title;
use App\Client;

class ClientController extends Controller
{
    //
    public function __construct( Title $titles, Client $client )
    {
        $this->titles = $titles->all();
        $this->client = $client->all();
    }

    public function di()
    {
        dd($this->titles);
    }

    public function index()
    {
        $data = [];

       $data['clients'] = $this->client;
        return view('client/index', $data);
    }

    public function newClient(Request $request, Client $client)
    {
        $data = [];

        $data['title'] =     $request->input('title');
        $data['name'] =      $request->input('name');
        $data['last_name'] = $request->input('last_name');
        $data['address'] =   $request->input('address');
        $data['zip_code'] =  $request->input('zip_code');
        $data['city'] =      $request->input('city');
        $data['state'] =     $request->input('state');
        $data['email'] =     $request->input('email');


        
        if($request->isMethod('POST')){
        //dd($data);

            $this->validate($request,
                [
                    'name' => 'required',
                    'email' => 'required'
                ]
            );

        $client->insert($data);     
        return redirect('clients');

        }
        $data['titles'] = $this->titles;
        $data['modify'] = 0;
        return view('client/form',$data);
    }

    public function create()
    {
            return view('client/create');
    }

    public function show($client_id)
    {
       $data = [];
        $data['titles'] = $this->titles;
        $data['modify'] = 1;

        $client =  $this->client->find($client_id);
        return view('client/form',$data,compact('client'));
    }

    public function modify($client_id,Request $request)
    {
         $data = [];

        $data['title'] =     $request->input('title');
        $data['name'] =      $request->input('name');
        $data['last_name'] = $request->input('last_name');
        $data['address'] =   $request->input('address');
        $data['zip_code'] =  $request->input('zip_code');
        $data['city'] =      $request->input('city');
        $data['state'] =     $request->input('state');
        $data['email'] =     $request->input('email');


        
        if($request->isMethod('POST')){
        //dd($data);

            $this->validate($request,
                [
                    'name' => 'required',
                    'email' => 'required'
                ]
            );
        $client = $this->client->find($client_id);
        $client->title =     $request->input('title');
        $client->name =      $request->input('name');
        $client->last_name = $request->input('last_name');
        $client->address =   $request->input('address');
        $client->zip_code =  $request->input('zip_code');
        $client->city =      $request->input('city');
        $client->state =     $request->input('state');
        $client->email =     $request->input('email');

        $client->save();


        return redirect('clients');

        }
        $data['titles'] = $this->titles;
        $data['modify'] = 0;
        return view('client/form',$data);
    }
}
