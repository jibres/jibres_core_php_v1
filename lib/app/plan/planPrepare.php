<?php
namespace lib\app\plan;

abstract class planPrepare implements plan
{
    private $period;
    private planPrice $planPrice;
    private $days = 0;

    public function prepare()
    {
        $this->planPrice = new planPrice($this);
    }

    public function period()
    {
        return $this->period;
    }

    public function setPeriod($_period)
    {
        $this->period = $_period;

    }


    public function setDays($_days)
    {
        $this->days = $_days;
    }

    public function price()
    {
        return $this->planPrice->calculatePrice($this->period);
    }

    public function currency()
    {
        return $this->planPrice->getCurrency();
    }


    public function setBy()
    {
        if(in_array(\dash\url::content(), ['love']))
        {
            $setBy = 'admin';
        }
        else
        {
            $setBy = 'customer';
        }
        // if is cronjob
        // return 'system'

        return $setBy;
    }


    public function calculateDays() : int
    {
        // skipp check period for free plan
        if($this->name() === 'free')
        {
            return 0;
        }

        if($this->period === 'monthly')
        {
            $days = 31;
        }
        elseif($this->period === 'yearly')
        {
            $days = 366;
        }
        elseif($this->period === 'custom')
        {
            $days = $this->days;
        }
        else
        {
            $days = 0;
        }

        return $days;
    }

    public function getArrayDetail() : array
    {
        $detail           = [];
        $detail['name']   = $this->name();
        $detail['title']  = $this->title();
        $detail['type']   = $this->type();
        $detail['period'] = $this->period();
        $detail['days']   = $this->calculateDays();


        return $detail;
    }


}
