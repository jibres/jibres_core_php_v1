<?php
namespace lib\app\category;


class quickaccess
{

	public static function add($_id)
	{
		$load = \lib\app\category\get::inline_get($_id);
		if($load)
		{
			self::setting_record($load['id'], 'add');
		}
	}



	public static function remove($_id)
	{
		$load = \lib\app\category\get::inline_get($_id);
		if($load)
		{
			self::setting_record($load['id'], 'remove');
		}
	}



	public static function set_sort($_args)
	{
		$list = self::get_list_raw();

		$new_list = [];


		if(!is_array($_args))
		{
			$_args = [];
		}

		foreach ($_args as $key => $value)
		{
			if(is_numeric($value) && in_array($value, $list))
			{
				$new_list[] = floatval($value);
			}
		}

		if(count($_args) === count($list))
		{
			\lib\app\setting\tools::update('sale_page', 'category', json_encode($new_list));
		}

		\dash\notif::complete();

	}


	public static function get_list()
	{
		$list = self::get_list_raw();

		$result = [];
		if($list)
		{
			$result = \lib\db\productcategory\get::quickaccess_list($list);
		}

		return $result;

	}


	private static function get_list_raw()
	{
		$list = \lib\app\setting\tools::get('sale_page', 'category');

		$list = a($list, 'value');

		if(is_string($list))
		{
			$list = json_decode($list, true);
		}

		if(!is_array($list))
		{
			$list = [];
		}

		return $list;

	}


	private static function setting_record($_id, $_type)
	{
		$list = self::get_list_raw();

		if($_type === 'add')
		{
			if(!in_array($_id, $list))
			{
				$list[] = $_id;
			}
		}
		else
		{
			if(in_array($_id, $list))
			{
				unset($list[array_search($_id, $list)]);
			}
		}

		\lib\app\setting\tools::update('sale_page', 'category', json_encode($list));


	}

}
?>
