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




	public function group() : string
	{
		return T_("Feature");
	}


	public function title() : string
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


	public function access_message()
	{
		return T_("You must upgrade your plan to add or edit permission");
	}



	public function access($_place = null) : bool
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
			elseif(!$_place)
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


}