<?php

namespace Weather;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Weather
{
    private const API_BASE_URL = 'https://weather.visualcrossing.com/VisualCrossingWebServices/rest/services/timeline/';
    /**
     * @var
     */
    protected $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param string $location
     * @return mixed
     */
    public function getWeather(string $location): mixed
    {
        $url = self::API_BASE_URL . urlencode($location) . "?key={$this->apiKey}";
        return $this->makeRequest($url);
    }

    /**
     * @param string $latitude
     * @param string $longitude
     * @return mixed
     */
    public function getWeatherWithLatAndLong(string $latitude, string $longitude): mixed
    {
        $url = self::API_BASE_URL . urlencode("$latitude,$longitude") . "?key={$this->apiKey}";
        return $this->makeRequest($url);
    }

    /**
     * @param string $location
     * @param string $startDate
     * @param string $endDate
     * @return mixed
     */
    public function getWeatherWithDates(string $location, string $startDate, string $endDate): mixed
    {
        $url = self::API_BASE_URL . urlencode("$location/$startDate/$endDate") . "?key={$this->apiKey}";
        return $this->makeRequest($url);
    }

    /**
     * @param string $url
     * @return array
     */
    private function makeRequest(string $url): array
    {
        try {
            $response = Http::get($url);
            return json_decode($response->json());
        } catch (\Exception $exception) {
            Log::info("https://weather.visualcrossing.com Error: " . $exception->getMessage());
        }
        return [];
    }
}
