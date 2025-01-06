<?php

namespace App\Http\Controllers;

use App\Models\Passport\Client;
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
            'new_client_id' => $client->id,
        ]);
    }

    public function edit(string $id)
    {
        $client = Client::findOrFail($id);

        return Inertia::render('Client/Edit', [
            'client' => $client,
        ]);
    }

    public function newUpdate(Request $request, string $id) {
        $client = $this->update($request, $id);

        return redirect()->route('index')->with([
            'edit_client_id' => $id,
        ]);
    }

    public function delete(Request $request, string $id) {
        $client = Client::findOrFail($id);

        $client->delete();

        return redirect()->route('index')->with([
            'delete_client' => $client->name,
        ]);
    }
}
