<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CognitiveHatController extends Controller
{
    public function index()
    {
        return view('cognitive-hat.index', [
            'result' => null,
        ]);
    }

    public function analyze(Request $request)
    {
        $payload = [
            'idea' => $request->input('idea'),
        ];

        $apiUrl = rtrim(config('services.cognitive_hat.url'), '/') . '/analyze';

        try {
            $response = Http::timeout(600)->post($apiUrl, $payload);

            if (! $response->successful()) {
                return back()
                    ->withInput()
                    ->with('error', 'The engine returned an error: ' . $response->body());
            }

            return view('cognitive-hat.index', [
                'result' => $response->json(),
            ]);
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->with('error', 'Connection error with the engine: ' . $e->getMessage());
        }
    }
}
