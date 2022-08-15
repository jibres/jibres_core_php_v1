<?php

namespace lib\app\plan;


abstract class planPrice
{
    public function calculatePrice(int $_month)
    {
        $month = $this->getRealMonth($_month);
        $price = $this->getPriceInCurrentCurrency();
        return $price * $month;
    }


    public function getCurrency()
    {
        if(\dash\language::current() === 'fa')
        {
            $currency = 'IRT';
        }
        else
        {
            $currency = 'USD';
        }

        return $currency;
    }


    private function getPriceInCurrentCurrency()
    {
        if($this->getCurrency() === 'IRT')
        {
            $price = $this->priceRial();
        }
        else
        {
            $price = $this->priceDollar();
        }

        return $price;
    }


    private function getRealMonth(int $_month) : int
    {
        $month = $_month;

        if($_month === 12)
        {
            $month = 10;
        }

        if(!$month || $month < 0)
        {
            $month = 1;
        }

        return $month;
    }
}