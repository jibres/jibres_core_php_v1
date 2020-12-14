<?php
namespace dash\app\terms;


class get
{
	public static function get($_id)
	{
		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			return false;
		}

		$args = ['id' => $id, 'limit' => 1];

		$result = \dash\db\terms::get($args);
		$temp = [];
		if(is_array($result))
		{
			$temp = \dash\app\terms\ready::row($result);
		}
		return $temp;
	}
}
?>