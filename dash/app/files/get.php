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
			\dash\notif::error(T_("Terms not founded"));
			return false;
		}

		$result = \dash\app\files\ready::row($result);

		return $result;
	}


	public static function dashboard_detail()
	{
		$result = [];
		$result['totalfiles'] = floatval(\dash\db\files::count_all());
		$result['totalsize'] = floatval(\dash\db\files::total_size());

		if(\dash\engine\store::inStore())
		{
			$result['storagelimit'] = floatval(\lib\store::detail('storage'));
			$div = $result['storagelimit'];
			if(intval($div) === 0)
			{
				$div = 1;
			}

			$result['usedpercent'] = round($result['totalsize'] * 100 / $div, 2);
			if($result['usedpercent'] > 100)
			{
				$result['usedpercent'] = 100;
			}
		}
		else
		{
			$result['storagelimit'] = '-';
			$result['usedpercent'] = '-';
		}

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