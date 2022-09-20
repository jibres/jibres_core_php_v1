<?php
namespace lib\app\plan;

abstract class planPrepare implements plan
{

	private $period;

	private $days = 0;


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
		return $this->calculatePrice($this->period);
	}


	public function currency()
	{
		return $this->getCurrency();
	}


	public function currencyName()
	{
		return \lib\currency::name($this->currency());
	}


	public function calculatePrice($_period, $_calculate_discount = true)
	{
		$month = $this->getRealMonth($_period);
		$price = $this->priceIRT();
		$price = $price * $month;

		if($_calculate_discount)
		{
			$discount = $this->discount($_period);

			if($discount)
			{
				$price = $price - $discount;
				if($price < 0)
				{
					$price = 0;
				}
			}
		}

		return $price;
	}


	public function discount($_period = null) : int
	{
		$month = $this->getRealMonth($_period);
		if(false)
		{
			return 100000 * $month;
		}
		else
		{
			return 0;
		}
	}


	public function getCurrency() : string
	{
		return 'IRT';
	}


	private function getRealMonth($_period) : int
	{
		$month = 1;

		if($_period === 'yearly')
		{
			$month = 10;
		}

		if(!$month || $month < 0)
		{
			$month = 1;
		}

		return $month;
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


}
