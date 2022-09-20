<?php
namespace dash\app\transaction;

class get
{


	public static function get($_id)
	{

		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}

		$load = \dash\db\transactions\get::by_id($id);
		if(!$load || !is_array($load))
		{
			return false;
		}

		$load = \dash\app\transaction::ready($load);

		return $load;


	}



	public static function getReadyFull($_id)
	{
		$load = self::get($_id);
		if($load)
		{
			$load = \dash\app\transaction::readyFull($load);
		}

		return $load;


	}
}
?>