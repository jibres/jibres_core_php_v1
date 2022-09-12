<?php
namespace lib\app\plan\feature;

class permission
{

	private $mode = null;


	public function __construct($_init)
	{
		if(isset($_init['mode']))
		{
			$this->mode = $_init['mode'];
		}
	}

	public function group()
	{
		return T_("Feature");
	}


	public function title()
	{
		return T_("Permission");
	}


	public function value()
	{
		if(!$this->mode)
		{
			return false;
		}
		elseif($this->mode === 'simple')
		{
			return T_("Simple");
		}
		elseif($this->mode === 'professional')
		{
			return T_("Professional");
		}
		else
		{
			return false;
		}

	}


}