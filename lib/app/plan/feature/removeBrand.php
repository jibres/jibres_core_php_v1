<?php
namespace lib\app\plan\feature;

class removeBrand
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
		return T_("Remove Jibres brand");
	}


	public function value()
	{
		return $this->access;

	}


}