<?php
namespace lib\app\plan\feature;

class adminOnDomain
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
		return T_("Admin on your domain");
	}


	public function value()
	{
		return $this->access;

	}


}