<?php
namespace lib\app\plan\feature;

class support extends featurePreapre
{

	private $mode = null;
	private $access = null;


	public function __construct($_init)
	{
		if($_init)
		{
			$this->access = true;
		}

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
		return T_("Support");
	}


	public function value() 
	{
		if(!$this->access)
		{
			return false;
		}

		if($this->mode === 'top_priority')
		{
			return T_("Top priority");
		}
		else
		{
			return true;
		}

	}




}