<?php
namespace lib\app\plan\feature;

class sms
{

	private $cost = null;


	public function __construct($_init)
	{
		if(isset($_init['cost']))
		{
			$this->cost = $_init['cost'];
		}
	}

	public function group()
	{
		return T_("Feature");
	}


	public function title()
	{
		return T_("SMS Cost");
	}


	public function value()
	{
		return \dash\fit::number($this->cost). ' '. T_("Toman");

	}


}