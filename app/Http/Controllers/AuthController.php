<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Passport\Client;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (!$request->client_id || !$request->redirect_url) {
            Log::info(__METHOD__ . ':' . __LINE__, [
                'message' => 'Missing Params',
                'data' => $request->all(),
            ]);
            abort(404);
        }

        Client::where('id', $request->client_id)
            ->where('redirect', $request->redirect_url)
            ->firstOrFail();

        $request->session()->put('client', $request->client_id);

        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        $client = $this->checkSessionClient($request);

        $ggUser = Socialite::driver('google')->user();

        if ($ggUser->email !== 'nguyenvannhan0810@gmail.com') {
            Log::info(__METHOD__ . ':' . __LINE__, [
                'message' => 'This email not authorize',
            ]);
            abort(403);
        }

        $dbUser = User::where('email', $ggUser->email)->first();

        if (!$dbUser) {
            $dbUser = User::create([
                'name' => $ggUser->name,
                'email' => $ggUser->email,
            ]);
        } else {
            if ($ggUser->avatar !== $dbUser->avatar) {
                $dbUser->avatar = $ggUser->avatar;

                $dbUser->save();
            }
        }

        Auth::login($dbUser, true);

        $query = http_build_query([
            'client_id' => $client->id,
            'redirect_uri' => $client->redirect,
            'response_type' => 'code',
            'scope' => '',
            'prompt' => '',
        ]);

        return redirect('/oauth/authorize?' . $query);
    }

    private function checkSessionClient(Request $request)
    {
        $clientId = $request->session()->get('client');

        if (!$clientId) {
            Log::info(__METHOD__ . ':' . __LINE__, [
                'message' => 'Missing ClientID in Session',
            ]);
            abort(404);
        }

        $client = Client::findOrFail($clientId);

        if (!$client) {
            Log::info(__METHOD__ . ':' . __LINE__, [
                'message' => 'Can not find Client',
            ]);
            abort(404);
        }

        return $client;
    }
}
