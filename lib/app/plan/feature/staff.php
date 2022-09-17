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
		return T_("Staff count");
	}


	public function value() 
	{
		return \dash\fit::number($this->count) . ' ' . T_("Staff");

	}

	public function access_message()
	{
		return T_("To add new staff you must upgrade your plan");
	}


	public function access() : bool
	{
		$currentCount = $this->currentCountStaff();

		if($currentCount >= $this->count)
		{
			return false;
		}
		else
		{
			return true;
		}

	}


	private function currentCountStaff() : int
	{
		$countHavePermission = \dash\db\users::count_users_have_permission();
		if(!is_numeric($countHavePermission))
		{
			$countHavePermission = 0;
		}

		return intval($countHavePermission);
	}


}