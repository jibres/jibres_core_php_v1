<?php
namespace lib\app\plan\feature;

class professionalReport extends featurePreapre
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
		return T_("Professional Report");
	}


	public function value() : string
	{
		return $this->access;

	}

	public function access() : bool
	{
		return $this->access;
	}


}