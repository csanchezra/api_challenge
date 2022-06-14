<?php

namespace App\Lib;

class SpotifyHelper
{

    private $clientId;
    private $clientSecret;
    private $clientToken;
    private $urlSpotify;
    public $genreMusic;

    public function __construct()
    {
        $this->clientId = env('SPOTIFY_CLIENT_ID');
        $this->clientSecret = env('SPOTIFY_CLIENT_SECRET');
        $this->urlSpotify = env('SPOTIFY_URL');
        $this->_get_token();
    }


    private function _get_token(): void
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,            'https://accounts.spotify.com/api/token');
        curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Authorization: Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret)));
        curl_setopt($ch, CURLOPT_POSTFIELDS,     'grant_type=client_credentials');
        curl_setopt($ch, CURLOPT_POST,           1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:x.x.x) Gecko/20041107 Firefox/x.x");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $json = curl_exec($ch);

        $json = json_decode($json);

        $this->clientToken = $json->access_token;
    }

    function get_playlist(): object
    {
        $authorization = "Authorization: Bearer " . $this->clientToken;

        // $genreMusic = 'rock';

        $spotifyURL = $this->urlSpotify . 'search?q=genre:' . urlencode($this->genreMusic) . '&type=track&offset=0&limit=10';

        $ch2 = curl_init();

        curl_setopt($ch2, CURLOPT_URL, $spotifyURL);
        curl_setopt($ch2,  CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:x.x.x) Gecko/20041107 Firefox/x.x");
        curl_setopt($ch2, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);
        $json2 = curl_exec($ch2);
        $json2 = json_decode($json2);
        curl_close($ch2);

        return ($json2);
    }








    //
}
