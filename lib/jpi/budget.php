<?php
namespace lib\jpi;


class budget
{
	public static function me()
	{
		$budget = jpi::budget();

		if(isset($budget['budget']))
		{
			return $budget;
		}

		return false;

	}
}
?>