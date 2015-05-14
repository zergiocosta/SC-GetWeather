<?php

class Weather {

    private $apiKey = '3e3eb3ab0fc7f4f4119b63e8e990d';


    public function getWeatherForCity($cityName)
    {
        $json = $this->performCurl($cityName);
        $json = json_decode($json);


        $iconUrl = parse_url($json->data->current_condition[0]->weatherIconUrl[0]->value);
        $iconUrl = explode('/', $iconUrl['path']);
        $iconUrl = $iconUrl[count($iconUrl)-1];


        return (object) [
            'tempMin' => $json->data->weather[0]->mintempC,
            'tempMax' => $json->data->weather[0]->maxtempC,
            'currentTemp' => $json->data->current_condition[0]->temp_C,
            'observationTime' => $json->data->current_condition[0]->observation_time,
            'iconName' => $iconUrl

        ];
    }


    private function performCurl($cityName) {

        $url = "http://api.worldweatheronline.com/free/v2/weather.ashx?q=".urlencode($cityName)."&format=json&num_of_days=1&show_comments=no&lang=pt-BR&key={$this->apiKey}";

        // create a new cURL resource
        $ch = curl_init();

        // set URL and other appropriate options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        // grab URL and pass it to the browser
        $pageContent = curl_exec($ch);

        // close cURL resource, and free up system resources
        curl_close($ch);

        return $pageContent;
    }

}