<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Laravel\Passport\Http\Controllers\ClientController as BaseController;

class ClientController extends BaseController
{
    public function create() : Response {
        return Inertia::render('Client/Create');
    }

    public function newStore(Request $request) {
        $client = $this->store($request);

        return redirect()->route('index')->with([
            'client_id' => $client->id,
        ]);
    }
}
