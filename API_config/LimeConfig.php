<?php

require_once 'API_config/ConfigInterface.php';

class LimeConfig implements ConfigInterface
{
    private const headers = array(
        'http'=>array(
            'method'=>"GET",
            'header'=> "accept: */*\r\n" .
                "x-session-id: 1638444583652\r\n" .
                "authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJ1c2VyX3Rva2VuIjoiNEJXNlVUWFZWNVU2WSIsImxvZ2luX2NvdW50IjozfQ.2FlACTJ4JXC0yeAQkI_U7NaJtId1tt0BRv7cXFU8Huo\r\n" .
                "app-version: 3.34.0\r\n" .
                "x-amplitude-device-id: C4CFA1F0-A608-496C-B52C-4E7971E9A913R\r\n" .
                "mobile-registration-id: d775bc6d474f1d7169cce58cf73f43ef035cc56fca56bbca7df58fe199e41c7c\r\n" .
                "accept-language: pl-US;q=1.0, en-US;q=0.9\r\n" .
                "platform: iOS\r\n" .
                "x-device-token: 6EAAC083-2AE2-4677-98B5-FF31C70421C8\r\n" .
                "user-agent: Lime/3.34.0 (com.limebike; build:1; iOS 15.0.0) Alamofire/4.9.1\r\n" .
                "cookie: _limebike-web_session=6qrvaQTuAUisfl3LdTd0GVGn6GpVcb6kWI%2FqI0onVDlmKWJt8cOdWaqNKit3Qdtm6L15fCUBBsburpKFecABZzpMJ63AyGeutp3Ff34vspPhTirnC4DzDkjQAYvS7S%2FhkzKVs1mdeBM7eetq%2FZXNEbjftPmjen4wKU96C38yD835oDIANxTrYSfzbvf%2BprEypL0OL4FGGIx%2FUpdZaMt1c7sn3%2F64oK%2B8hxjgyrUI8qjaiHYoNx6I0jRUBMuDUXIh%2BW3yctCxJvT39%2B4DOO3qNKUDsLv2N5QrGh5jY0hIZQv7xGTZcP8vtjbEbPQpOkhiP1DqlVLx0OgBeq2T0XBc7ym0sUkk%2FSpQupECMArdxdH1iH3SSBlC3K8TkrbhtoWo9gyljR86ZAr6jsF1QjTC9O5NmoZxrBgw13WJZkt6%2Fw28JJ8u5mC3Ia5eImYwPOEZJ07VsjF7COOM8XpdTsMKDh9zXqITyTkleLAVBjJnDtB%2B2YdG9tnPeZb3e%2BmT8rBTBbEZzFM3BWHA9TxshxJOJraxQhOsVO9HncTQQa74BAOSGFaAgGNiYTdwkCjTO2DzPk4hQBHxxGPOxC0wglnkPhA%2F0gdEDkNl8399Hr2N0yZ0HgUs58WG7TBppov%2By4vQBISGZNSdaXPF5TAJeOewa5Qral%2Fr4NL9O6zFDXqN7ApYX07rKSn9Yt5c1LBHb6OkCNvNhVKwaTgU--4T2Af8anSIu4TiDJ--VNGX7YjU2%2B134fWijG%2FoPA%3D%3D\r\n" .
                "cookie: _mkra_stck=mysql%3A1638444599.989352\r\n" .
                "cookie: amplitude_id_2456dc2a49db21e05033fb152c047892lime.bike=eyJkZXZpY2VJZCI6ImEyMjUwN2UwLTQ1NTgtNDU3Yi04ZWI0LWQ2NWZlOGY0YmY0YVIiLCJ1c2VySWQiOiI0Qlc2VVRYVlY1VTZZIiwib3B0T3V0IjpmYWxzZSwic2Vzc2lvbklkIjoxNjM3OTI0NDQ0MzEyLCJsYXN0RXZlbnRUaW1lIjoxNjM3OTI0NDk5Mzc3LCJldmVudElkIjo3LCJpZGVudGlmeUlkIjoxLCJzZXF1ZW5jZU51bWJlciI6OH0=\r\n"

        )
    );

    private const url = "https://web-production.lime.bike/api/rider/v2/map/bike_pins?accuracy=10.63905566840573&ne_lat=50.09418945143848&ne_lng=19.94043365120888&sw_lat=50.08313411603204&sw_lng=19.93302471935749&user_gps_time=2021-10-19T11%3A48%3A49Z&user_latitude=50.08914679290804&user_longitude=19.93433380756294&zoom=16.17569";


    public static function get_headers(): array
    {
        return self::headers;
    }

    public static function get_url(): string
    {
        return self::url;
    }
}