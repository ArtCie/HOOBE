<?php

require_once 'API_config/ConfigInterface.php';

class TierConfig implements ConfigInterface
{
    private const headers = array(
        'http'=>array(
            'protocol_version'=>'1.1',
            'method'=>"GET",
            'header'=> "X-Api-Key: bpEUTJEBTf74oGRWxaIcW7aeZMzDDODe1yBoSxi2"
        )
    );

    private const url = "https://platform.tier-services.io/v1/vehicle?lat=LATITUDE&lng=LONGITUDE&radius=5000";

    public static function get_headers(): array
    {
        return self::headers;
    }

    public static function get_url(): string
    {
        return self::url;
    }
}