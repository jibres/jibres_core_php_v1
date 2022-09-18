<?php
namespace lib\app\plan\feature;

class instagram extends featurePreapre
{


	private $access = null;


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
		return T_("Instagram");
	}


	public function value() 
	{
		if(!$this->access)
		{
			return false;
		}

		if($this->access)
		{
			return T_("Soon");
		}


	}




}