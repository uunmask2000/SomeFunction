<?php
class bit_api_class
{

    ## API 登入帳號
    private $login;
    ## API key
    private $appkey;
    private $bitly_api_url = 'http://api.bit.ly/shorten';
    private $_name = 'http://bit.ly/';

    public function __construct($data = array())
    {
        if (!empty($data)) {
            $this->login = $data['login'];
            $this->appkey = $data['login'];
        }
    }

    /**
     * make_bitly_url  產生短網址
     *
     * @param  mixed $url
     * @param  mixed $login
     * @param  mixed $appkey
     * @param  mixed $format
     * @param  mixed $version
     *
     * @return void
     */
    public function make_bitly_url($url, $login, $appkey, $format = 'xml', $version = '2.0.1')
    {
        //create the URL
        $bitly = $this->bitly_api_url . '?version=' . $version . '&longUrl=' . urlencode($url) . '&login=' . $login . '&apiKey=' . $appkey . '&format=' . $format;

        ## 送出服務
        $response = file_get_contents($bitly);
        ##短網址
        $shortUrl = "";
        switch ($format) {
            case 'json':
                $json = @json_decode($response, true);
                $shortUrl = $json['results'][$url]['shortUrl'];
                break;
            default:
                $xml = simplexml_load_string($response);
                $shortUrl = $this->_name . $xml->results->nodeKeyVal->hash;
                break;
        }
        return $shortUrl;
    }

}
