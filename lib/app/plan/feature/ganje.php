<?php
namespace lib\app\plan\feature;

class ganje extends featurePreapre
{

	private $access = false;


	public function __construct($_init)
	{
		if($_init)
		{
			$this->access = true;
		}
	}


	public function group() : string
	{
		return T_("Feature");
	}


	public function title() : string
	{
		return T_("Ganje");
	}


	public function value() : string
	{
		if($this->access)
		{
			return true;
		}
		else
		{
			return T_("10 request for test");
		}

	}


}