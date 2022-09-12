<?php
namespace lib\app\plan\feature;

class sms extends featurePreapre
{

	private $cost = null;


	public function __construct($_init)
	{
		if(isset($_init['cost']))
		{
			$this->cost = $_init['cost'];
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


	public function value() : string
	{
		return \dash\fit::number($this->cost) . ' ' . T_("Toman");

	}


}