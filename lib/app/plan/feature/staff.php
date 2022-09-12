<?php
namespace lib\app\plan\feature;

class staff
{

	private $count = null;


	public function __construct($_init)
	{
		if(isset($_init['count']))
		{
			$this->count = $_init['count'];
		}
	}

	public function group()
	{
		return T_("Feature");
	}


	public function title()
	{
		return T_("Staff");
	}


	public function value()
	{
		return \dash\fit::number($this->count). ' '. T_("Staff");

	}


}