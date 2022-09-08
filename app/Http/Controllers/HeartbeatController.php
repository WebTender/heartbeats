<?php

namespace App\Http\Controllers;

use App\Models\Heartbeat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HeartbeatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(Request $request)
    {
        $apiKey = env('CREATE_API_KEY');

        if ($apiKey && $request->api_key !== $apiKey) {
            abort(401);
        } elseif (!$apiKey && $request->has('api_key')) {
            abort(401);
        }

        $this->validate($request, [
            'name' => 'required|max:161',
            'description' => 'nullable|max:161',
            'max_minutes' => 'required|integer',
        ]);

        return Heartbeat::create([
            'name' => $request->name,
            'description' => $request->description,
            'max_minutes' => $request->max_minutes,
            'last_pinged_at' => Carbon::now(),
        ]);
    }

    public function delete(Request $request, Heartbeat $heartbeat)
    {
        $apiKey = env('CREATE_API_KEY');

        if ($apiKey && $request->api_key !== $apiKey) {
            abort(401);
        } elseif (!$apiKey && $request->has('api_key')) {
            abort(401);
        }

        $heartbeat->delete();

        return 'OK';
    }
}
