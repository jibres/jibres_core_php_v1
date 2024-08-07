<?php
namespace lib\app\plan\feature;

class removeBrand extends featurePreapre
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
		return T_("Remove Jibres brand");
	}


	public function value() 
	{
		return $this->access;

	}

	public function access() : bool
	{
		return $this->access;
	}


}