<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller {
  public function getWeather(Request $request) {
    $city = $request->query('city', 'Quezon City');
    $apiKey = env('WEATHER_API');
    $url = "http://api.weatherapi.com/v1/current.json";
    $response = Http::get($url, [
      'key' => $apiKey,
      'q' => $city,
      'aqi' => 'no'
    ]);
    if ($response->failed()) return response ()->json(['error' => 'Failed to fetch weather data'], 500);
    return $response->json();
  }
  public function getForecast(Request $request) {
    $city = $request->query('city', 'Quezon City');
    $apiKey = env('WEATHER_API');
    $url = "http://api.weatherapi.com/v1/forecast.json";
    $response = Http::get($url, [
      'key' => $apiKey,
      'q'   => $city,
      'days' => 7,
      'aqi' => 'no',
      'alerts' => 'no'
    ]);
    if ($response->failed()) return response ()->json(['error' => 'Failed to fetch weather data'], 500);
    return $response->json();
  }
}