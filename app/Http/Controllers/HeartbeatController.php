<?php

namespace App\Http\Controllers;

use App\Models\Heartbeat;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HeartbeatController extends Controller
{
    private function validateApiKey(Request $request)
    {
        $apiKey = env('CREATE_API_KEY');

        if ($apiKey && $request->query('api_key') !== $apiKey) {
            abort(401);
        } elseif (!$apiKey && $request->has('api_key')) {
            abort(401);
        }
    }

    public function create(Request $request)
    {
        $this->validateApiKey($request);

        $this->validate($request, [
            'name' => 'required|max:161',
            'description' => 'nullable|max:161',
            'max_minutes' => 'required|integer',
        ]);

        return response()->json(Heartbeat::create([
            'name' => $request->query('name'),
            'description' => $request->query('description'),
            'max_minutes' => $request->query('max_minutes'),
            'last_pinged_at' => Carbon::now(),
        ]));
    }

    public function delete(Request $request)
    {
        $this->validateApiKey($request);

        $this->validate($request, [
            'uuid' => 'required|references:heartbeats',
        ]);

        Heartbeat::findOrFail($requst->query('uuid'))->delete();

        return response()->json();
    }
}
