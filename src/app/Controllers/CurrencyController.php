<?php
include_once ROOT . "/app/Models/Currency.php";

class CurrencyController
{
    public function index()
    {

        $currency = new Currency();

        $currencyArray = $currency->getCurrentCurrency(null, true);

        require_once(ROOT . "/app/views/index.php");

        return true;
    }


    public function find($date)
    {
        $currency = new Currency();

        $currencyArray = $currency->getCurrentCurrency($date);

        require_once(ROOT . "/app/views/index.php");

        return true;
    }
}
