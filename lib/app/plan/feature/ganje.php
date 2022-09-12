<?php
namespace lib\app\plan\feature;

class ganje
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
		return T_("Ganje");
	}


	public function value()
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