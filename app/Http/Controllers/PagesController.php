<?php

namespace App\Http\Controllers;

use Geocoder;
use Illuminate\Support\Facades\Log;


class PagesController extends Controller
{
    private $result;

    public function __construct()
    {
        $this->result = NULL;
    }

    public function index()
    {
        try {
            $geocode = Geocoder::getCoordinates();
            // The GoogleMapsProvider will return a result
            dd($geocode);
        } catch (\Exception $e) {
            // No exception will be thrown here
            dd($e->getMessage());
        }

        return view('welcome');
    }

    public function getLocation()
    {
        return view('get-location');
    }

    public function geolocateSubmit()
    {
        if(isset($_POST['lat'], $_POST['lng'])) {
            $lat = $_POST['lat'];
            $lng = $_POST['lng'];

            $url = sprintf("https://maps.googleapis.com/maps/api/geocode/json?latlng=%s,%s", $lat, $lng);

            $content = file_get_contents($url); // get json content

            $metadata = json_decode($content, true); //json decoder

            if(count($metadata['results']) > 0) {
                // for format example look at url
                // https://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452
                $result = $metadata['results'][0];

                $GeoJSON  = new \Geocoder\Dumper\GeoJsonDumper;
                $adapter  = new \Geocoder\HttpAdapter\CurlHttpAdapter();
                $geocoder = new \Geocoder\Geocoder();
                $geocoder->registerProvider(new \Geocoder\Provider\GoogleMapsProvider($adapter));

                $address = $geocoder->reverse($lat, $lng);
                $result = $this->locationFormatter($address);

                return view('result', $result);
            }
            else {
                // no results returned
            }
        }
    }

   public function locationFormatter($geocode)
   {
       $data = [
           'streetName' => $geocode['streetName'],
           'city' => $geocode['city'],
           'region' => $geocode['region'],
           'country' => $geocode['country'],
           'latitude' => $geocode['latitude'],
           'longitude' => $geocode['longitude']
       ];

       return $data;
   }
}
