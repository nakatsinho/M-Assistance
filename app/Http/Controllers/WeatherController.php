<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Weather  $weather
     * @return \Illuminate\Http\Response
     */
    public function show($weather)
    {
        $city = 'Maputo';
        $apiKey = '2f26f4026a31178c80d27a7b501e15a9';

        $client = new Client();
        $response = $client->get("https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}");

        $data = json_decode($response->getBody(), true);

        $temperature = $data['main']['temp'];
        $weather_description = $data['weather'][0]['description'] ?? null;
        $humidity = $data['main']['humidity'];
        $wind_speed = $data['wind']['speed'];
        $wind_direction = $data['wind']['deg'];
        $sunrise = date('H:i', $data['sys']['sunrise']);
        $sunset = date('H:i', $data['sys']['sunset']);
        $uv_index = $data['uv_index'] ?? null;

        return [
            $city,
            $temperature,
            $weather_description,
            $humidity,
            $wind_speed,
            $wind_direction,
            $sunrise,
            $sunset,
            $uv_index
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Weather  $weather
     * @return \Illuminate\Http\Response
     */
    public function edit(Weather $weather)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Weather  $weather
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Weather $weather)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Weather  $weather
     * @return \Illuminate\Http\Response
     */
    public function destroy(Weather $weather)
    {
        //
    }
}
