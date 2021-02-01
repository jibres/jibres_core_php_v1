<?php
namespace dash\app\files;


class get
{
	public static function get($_id)
	{
		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			return false;
		}

		$result = self::inline_get($id);

		if(!$result)
		{
			\dash\notif::error(T_("File not found"));
			return false;
		}

		$result = \dash\app\files\ready::row($result);

		return $result;
	}



	public static function inline_get($_id)
	{

		if(!$_id || !is_numeric($_id))
		{
			return false;
		}

		$result = \dash\db\files::by_id($_id);
		if(!$result || !is_array($result))
		{
			return false;
		}

		return $result;
	}

	public static function usage_count($_id)
	{
		$id = \dash\coding::decode($_id);

		if(!$id || !is_numeric($id))
		{
			return false;
		}

		$result = \dash\db\files::get_usages_count($id);

		return intval($result);
	}

	public static function usage_list($_id)
	{
		$id = \dash\coding::decode($_id);

		if(!$id || !is_numeric($id))
		{
			return false;
		}

		$result = \dash\db\files::get_usages($id);

		if(!$result || !is_array($result))
		{
			$result = [];
		}

		$result = array_map(['\\dash\\app\\files\\ready', 'row_usage'], $result);

		return $result;
	}
}
?>