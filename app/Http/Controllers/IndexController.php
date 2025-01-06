<?php

namespace App\Http\Controllers;

use App\Models\Passport\Client;
use Inertia\Inertia;

class IndexController extends Controller
{
    public function index() {
        $clients = Client::orderBy('created_at', 'DESC')->get();

        $newClient = null;
        if($newClientId = request()->session()->get('client_id')) {
            $newClient = Client::find($newClientId);

            if ($newClient) {
                $newClient->makeVisible('secret');
            }
        }

        return Inertia::render('Dashboard/Index', [
            'clients' => $clients,
            'newClient' => $newClient,
        ]);
    }
}
