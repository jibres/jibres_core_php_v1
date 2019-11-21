<?php
namespace lib\app\user;


class user
{


	public static function lates_user($_args = [])
	{
		if(!isset($_args['limit']))
		{
			$_args['limit'] = 5;
		}

		$_args['order_raw'] = 'users.id DESC';
		$_args['pagenation'] = false;

		$list = \lib\db\users\users::search(null, $_args);

		if(is_array($list))
		{
			$list = array_map(['\\lib\\app\\user\\ready', 'row'], $list);
		}

		return $list;
	}

	public static function chart_gender()
	{
		$result     = \lib\db\users\users::get_gender_chart();
		$hi_chart   = [];

		if(!is_array($result))
		{
			$result = [];
		}

		foreach ($result as $key => $value)
		{
			$name  = null;
			$count = 0;

			if(is_array($value) && array_key_exists('gender', $value))
			{
				$name = $value['gender'] ? T_($value['gender']) : T_("Unknown");
			}

			if(is_array($value) && array_key_exists('count', $value))
			{
				$count = intval($value['count']);
			}
			$newValue = ['name' => $name, 'y' => $count];
			if(is_array($value) && array_key_exists('gender', $value) && !$value['gender'])
			{
				$newValue['visible'] = false;
			}
			$hi_chart[] = $newValue;
		}

		$hi_chart = json_encode($hi_chart, JSON_UNESCAPED_UNICODE);

		return $hi_chart;

	}

	public static function chart_status()
	{
		$result = \lib\db\users\users::get_status_chart();
			$hi_chart   = [];

		if(!is_array($result))
		{
			$result = [];
		}

		foreach ($result as $key => $value)
		{
			if(!is_array($value))
			{
				$value = [];
			}
			$name  = null;
			$count = 0;

			if(array_key_exists('status', $value))
			{
				$name = $value['status'] ? T_($value['status']) : T_("Unknown");
			}

			if(array_key_exists('count', $value))
			{
				$count = intval($value['count']);
			}

			$hi_chart[] = ['name' => $name, 'y' => $count];
		}

		$hi_chart      = json_encode($hi_chart, JSON_UNESCAPED_UNICODE);

		return $hi_chart;


	}


	public static function chart_identify($_args = [], $_get_raw = false)
	{

		$result = \lib\db\users\users::get_identify_chart();

		$hi_chart   = [];
		$categories = [];
		$values     = [];
		$raw        = [];

		if(!is_array($result))
		{
			$result = [];
		}

		$all = \lib\db\users\users::get_count();
		$all = intval($all);
		if($all === 0)
		{
			$all = 1;
		}


		foreach ($result as $key => $value)
		{
			$temp     = 0;
			$type     = null;
			$type_raw = null;

			if(array_key_exists('type', $value))
			{
				$type = $value['type'] ? T_($value['type']) : T_("Unknown");
				$categories[] = $type;
				$type_raw = $value['type'];
			}

			if(array_key_exists('count', $value))
			{
				$temp = intval($value['count']);
				$values[] = intval($temp);
			}

			$raw[$type_raw] = round(($temp * 100) / $all, 1);
		}

		$hi_chart['categories'] = json_encode($categories, JSON_UNESCAPED_UNICODE);
		$hi_chart['value']      = json_encode($values, JSON_UNESCAPED_UNICODE);

		$return                 = [];
		$return['chart']        = $hi_chart;
		$return['raw']          = $raw;
		return $return;

	}
}
?>