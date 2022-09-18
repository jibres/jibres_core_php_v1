<?php
namespace lib\app\plan\feature;

class sms extends featurePreapre
{

	private $fa_cost = null;

	private $en_cost = null;


	public function __construct($_init)
	{
		if(isset($_init['fa_cost']))
		{
			$this->fa_cost = $_init['fa_cost'];
		}

		if(isset($_init['en_cost']))
		{
			$this->en_cost = $_init['en_cost'];
		}
	}


	public function group() : string
	{
		return T_("Feature");
	}


	public function title() : string
	{
		return T_("SMS Cost");
	}


	public function value() 
	{
		$value = '';
		$value .= T_("Persian") . ' '. \dash\fit::number($this->fa_cost) . ' <small class="text-gray-400">' . T_("Toman"). '</small>';
		$value .= '<br>';
		$value .= T_("English") . ' '. \dash\fit::number($this->en_cost) . ' <small class="text-gray-400">' . T_("Toman"). '</small>';
		return $value;
	}

	public function access() : bool
	{
		// check have charge or not
		$charge = \lib\app\sms_charge\charge::getDetail();

		if(isset($charge['charge']) && $charge['charge'])
		{
			if(intval($charge['charge']) > 0)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	public function cost($_lang = null)
	{
		if($_lang === 'fa')

		{
			return $this->fa_cost;
		}
		else
		{
			return $this->en_cost;
		}
	}



}