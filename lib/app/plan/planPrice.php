<?php

namespace lib\app\plan;


class planPrice
{
    private $plan;


    public function __construct(plan $_plan)
    {
        $this->plan = $_plan;
    }


    public function calculatePrice(int $_month)
    {
        $month = $this->getRealMonth($_month);
        $price = $this->getPriceInCurrentCurrency();
        return $price * $month;
    }


    public function getCurrency() : string
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
            $price = $this->plan->priceRial();
        }
        else
        {
            $price = $this->plan->priceDollar();
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