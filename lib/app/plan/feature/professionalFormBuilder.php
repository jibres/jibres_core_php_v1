<?php
namespace lib\app\plan\feature;

class professionalFormBuilder extends featurePreapre
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
		return T_("Professional form builder");
	}


	public function value() 
	{
		return $this->access;

	}


}