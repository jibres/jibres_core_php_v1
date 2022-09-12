<?php
namespace lib\app\plan\feature;

class professionalDiscount
{

	private $access = false;


	public function __construct($_init)
	{
		if($_init)
		{
			$this->access = true;
		}
	}

	public function group()
	{
		return T_("Feature");
	}


	public function title()
	{
		return T_("Professional Discount");
	}


	public function value()
	{
		return $this->access;

	}


}