<?php
namespace lib\app\plan\feature;

class staff extends featurePreapre
{

	private $count = null;


	public function __construct($_init)
	{
		if(isset($_init['count']))
		{
			$this->count = $_init['count'];
		}
	}


	public function group() : string
	{
		return T_("Feature");
	}


	public function title() : string
	{
		return T_("Staff");
	}


	public function value() : string
	{
		return \dash\fit::number($this->count) . ' ' . T_("Staff");

	}




}