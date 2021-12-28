<?php

require_once 'API_config/ConfigInterface.php';

class BoltConfig implements ConfigInterface
{
    private const headers = array(
        'http'=>array(
            'method'=>"GET",
            'header'=> "accept: /*\r\n" .
                "user-agent: Bolt/60099272 CFNetwork/1312 Darwin/21.0.0\r\n" .
                "accept-language: pl-pl\r\n" .
                "authorization: Basic KzQ4NzkyNTMxNDkzOkU5MjhCNUEzLTQ5QUItNEQ4RS1CQzM5LTIyQzBGMTY2QzQyNQ==\r\n"
        )
    );

    private const url = "https://node.bolt.eu/rental-search/categoriesOverview?lng=LONGITUDE&session_id=27203452u1634635439&country=us&lat=LATITUDE&device_os_version=iOS15.0&select_all=true&version=CI.34.0&gps_lng=LONGITUDE&language=pl&deviceId=B9887B54-A798-43CF-8E18-0AD88B07810A&device_name=iPhone13,2&user_id=27203452&gps_lat=LATITUDE&deviceType=iphone";


    public static function get_headers(): array
    {
        return self::headers;
    }

    public static function get_url(): string
    {
        return self::url;
    }
}