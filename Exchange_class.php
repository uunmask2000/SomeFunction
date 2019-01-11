<?php

// Exchange_class  匯率

class Exchange_class
{

    private $api_url;
    public function __construct($data = array())
    {
        if (!empty($data)) {
            ### $data['api_key'] 範例 :  TWDJPY
            $this->api_url = 'https://partner-query.finance.yahoo.com/v8/finance/chart/' . $data['api_key'] . '=X?range=1d&corsDomain=tw.money.yahoo.com&interval=5m&includePrePost=false&.tsrc=yahoo-tw';
        }
    }

    /**
     * main
     *
     * @return void
     */
    public function main()
    {
        ## 送出服務
        $response = json_decode(file_get_contents($this->api_url), true);

        if ($response == false) {
            return false;
        }

        return $this->sub($response);
    }

    /**
     * sub
     *
     * @param  mixed $response
     *
     * @return void
     */
    public function sub($response)
    {
        $new_array = array();
        $new_array = array(
            "title" => $response['chart']['result'][0]['meta']['symbol'],
            "chartPreviousClose" => $response['chart']['result'][0]['meta']['chartPreviousClose'],
            "previousClose" => $response['chart']['result'][0]['meta']['previousClose'],
            "timestamp" => $response['chart']['result'][0]['timestamp'],
            "low" => $response['chart']['result'][0]['indicators']['quote'][0]['low'],
            "close" => $response['chart']['result'][0]['indicators']['quote'][0]['close'],
            "open" => $response['chart']['result'][0]['indicators']['quote'][0]['open'],
            "volume" => $response['chart']['result'][0]['indicators']['quote'][0]['volume'],
        );

        return $new_array;
    }
}
