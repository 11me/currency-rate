<?php

class Currency
{
    private $url = "http://cbr.ru/scripts/XML_daily.asp?date_req=";
    private $currency_codes = ["EUR", "USD"];


    public function getCurrentCurrency(string $date=null, bool $compare=false): array
    {
        return $this->makeRequest($date, $compare);
    }


    private function makeRequest(string $date=null, bool $compare): array
    {
        $yesterdayDate = date("d/m/Y", (time() - (24*60*60)));
        $todayDate = $date or date("d/m/Y");
        $reqYesterday = $this->url . $yesterdayDate;
        $reqToday = $this->url . $todayDate;

        $yesterdayCurrency = $this->parseFromXML(simplexml_load_file($reqYesterday));
        $todayCurrency = $this->parseFromXML(simplexml_load_file($reqToday));

        $result["USD"] = $todayCurrency["USD"][0];
        $result["EUR"] = $todayCurrency["EUR"][0];

        $result["USD_Yesterday"] = $yesterdayCurrency["USD"][0];
        $result["EUR_Yesterday"] = $yesterdayCurrency["EUR"][0];

        // Default rates
        $result["USD_Rate"] = "";
        $result["EUR_Rate"] = "";

        // Compare with yesterday currency

        if ($compare)
        {

            if (floatval($result["USD_Yesterday"]) < floatval($result["USD"]))
            {
                $result["USD_Rate"] = "↑"; // means today currency is higher
            }
            elseif (floatval($result["USD_Yesterday"]) > floatval($result["USD"]))
            {
                $result["USD_Rate"] = "↓"; // means today currency is lower
            }


            if (floatval($result["EUR_Yesterday"]) < floatval($result["EUR"]))
            {
                $result["EUR_Rate"] = "↑"; // means today currency is higher
            }
            elseif (floatval($result["EUR_Yesterday"]) > floatval($result["EUR"]))
            {
                $result["EUR_Rate"] = "↓"; // means today currency is lower
            }

        }

        return $result;

    }


    private function parseFromXML(SimpleXMLElement $xmlObj): array
    {
        $resultArray = [];

        if ($xmlObj instanceof SimpleXMLElement)
        {
            foreach($xmlObj->Valute as $item)
            {
                if ($item->CharCode == $this->currency_codes[0])
                {
                    $resultArray["EUR"] = $item->Value;
                }
                elseif ($item->CharCode == $this->currency_codes[1])
                {
                    $resultArray["USD"] = $item->Value;
                }
            }
            return json_decode( json_encode($resultArray) , 1);
        }
    }


}
