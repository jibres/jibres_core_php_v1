<?php
namespace lib\app\plan\feature;

class permission extends featurePreapre
{

	private $mode = null;


	public function __construct($_init)
	{
		if(isset($_init['mode']))
		{
			$this->mode = $_init['mode'];
		}
	}


	public function access($_place)
	{
		if(!$this->mode)
		{
			return false;
		}
		elseif($this->mode === 'simple')
		{
			if($_place === 'simple')
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		elseif($this->mode === 'professional')
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	public function group() : string
	{
		return T_("Feature");
	}


	public function title() : string
	{
		return T_("Permission");
	}


	public function value() : string
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