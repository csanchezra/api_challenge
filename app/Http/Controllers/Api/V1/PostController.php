<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\RequestException;
use App\Http\Requests\V1\PostRequest;
use Spotify;

class PostController extends Controller
{

    /*
    Index el cual especifica los campos para el uso del API
    */

    public function index()
    {
        $data_response = [
            'city' => 'Requerido si no se proporciona latitud y longitud',
            'lat' => 'Requerido si no se proporciona city',
            'long' => 'Requerido si no se proporciona city',
        ];
        return response()->json(
            $data_response
        );
    }

    /*
    Endpoint que se encarga de despachar la información 
    al cliente
    */
    public function show(PostRequest $request)
    {
        /* Validaciones de datos ingresados de acuerdo a lo especificado  en el index*/
        $request->validated();

        $store_data = [
            'status' => 0
        ];

        $request = $request->all();

        /* Se obtienen los datos del request por los cuales se va a realizar la busqueda del clima*/
        $city = isset($request['city']) ? $request['city'] : NULL;
        $lat = isset($request['lat']) ? $request['lat'] : NULL;
        $lon = isset($request['lon']) ? $request['lon'] : NULL;

        /* Se valida que se haya ingresado una búsqueda correcta*/
        if ($city != NULL || ($lat != NULL && $lon != NULL))
        {
            /* Se invoca el metodo para obtener la temperatura actual*/
            $response = $this->_get_temperature_api($city, $lat, $lon);

            /* Se valida que la solicitud tenga el campo necesario*/
            if (isset($response->main->temp))
            {
                $degrees_k = $response->main->temp;

                /* Se convierte a grados c de grados kelvin, el api siempre reponde en kelvin no importando los datos enviados*/
                $degrees_c = $this->convert_far_cel($degrees_k);

                /* Se obtiene el genero musical correspondiente*/
                $genre = $this->_get_genre($degrees_c);

                /* Se obtiene el playlist de acuerdo al genero correspondiente*/
                $tracks = $this->_get_playlist($genre);

                /* Se crea un array para la insercion de datos en la bd*/
                $store_data = [
                    'city' => $city,
                    'lat' => $lat,
                    'long' => $lon,
                    'musical_genre' => $genre,
                    'degrees' => $degrees_c,
                    'play_list' => json_encode($tracks),
                    'status' => 1
                ];


                $data_response =
                    [
                        'status' => 1,
                        'details' => 'Consulta satisfactoria',
                        'tracks' => $tracks,
                    ];
            }

            else
            {
                $data_response =
                    [
                        'status' => 0,
                        'details' => 'No se encontró información con los datos proporcionados',
                    ];
            }
        }
        else
        {
            $data_response =
                [
                    'status' => 0,
                    'details' => 'No se encontró información con los datos proporcionados',
                ];
        }

        $this->_store($store_data);

        return response()->json(
            $data_response
        );
    }

    /*
    Funcion que se conecta al api de openweathermap para obtener la temperatura actual
    */
    private function _get_temperature_api($city = NULL, $lat = NULL, $lon = NULL)
    {
        try
        {
            $url = ($city != NULL) ?
                "https://api.openweathermap.org/data/2.5/weather?q={$city}&APPID=11bd8cf0a4117a93d4d12a00711a1567&lang=es"
                : "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&APPID=11bd8cf0a4117a93d4d12a00711a1567&lang=es";
            $client = new Client(); //GuzzleHttp\Client

            $response = $client->request('GET', $url, []);

            $responseBody = json_decode($response->getBody());

            return $responseBody;
        }
        catch (RequestException $e)
        {
            return $e;
        }
    }


    /*
    metodo que convierte de grados kelvin a centigrados
    */
    private function convert_far_cel($degrees_k)
    {
        // Kelvin a Celsius   C = degrees_k - 273.15
        $celcius = ($degrees_k - 273.15);

        return (int)$celcius;
    }


    /*
    metodo que obtiene el genero musical dependiendo de la temperatura
    */
    private function _get_genre($degrees_c)
    {

        if ($degrees_c > 30)
        {
            $genre = "party";
        }
        elseif ($degrees_c >= 15 && $degrees_c <= 30)
        {
            $genre = "pop";
        }
        elseif ($degrees_c >= 10 && $degrees_c <= 14)
        {
            $genre = "rock";
        }

        else
        {
            $genre = "classical";
        }

        return $genre;
    }

    /*
    metodo que obtiene la playlist del api de spotify
    */

    private function _get_playlist($genre)
    {
        $status = Spotify::searchTracks($genre)->limit(10)->get();

        $array_songs = [];

        foreach ($status['tracks']['items'] as $value)
        {
            array_push($array_songs, $value['album']['name']);
        }

        return $array_songs;
    }

    /*
    metodo para guardar en bd los datos de la peticion
    */
    private function _store($store_data)
    {
        Post::create($store_data);
    }
}
