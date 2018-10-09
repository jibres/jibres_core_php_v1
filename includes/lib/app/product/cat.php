<?php
namespace lib\app\product;


class cat
{

	public static function add($_new_cat)
	{
		if(!$_new_cat && $_new_cat !== '0')
		{
			\dash\notif::error(T_("Plese fill the category name"), 'cat');
			return false;
		}

		if(mb_strlen($_new_cat) > 100)
		{
			\dash\notif::error(T_("Category name is too large!"), 'cat');
			return false;
		}

		$json = self::list();

		if(isset($json[$_new_cat]))
		{
			\dash\notif::error(T_("Duplicate category founded"), 'cat');
			return false;
		}

		$json[$_new_cat] = ['title' => $_new_cat];

		$json = json_encode($json, JSON_UNESCAPED_UNICODE);
		\lib\db\stores::update(['cat' => $json], \lib\store::id());

		\dash\notif::ok(T_("Category successfully added"));
		\lib\store::refresh();

		return true;

	}

	public static function remove($_old_cat)
	{
		$json = self::list();

		if(!isset($json[$_old_cat]))
		{
			\dash\notif::error(T_("Category not found in your store!"), 'cat');
			return false;
		}

		unset($json[$_old_cat]);

		$json = json_encode($json, JSON_UNESCAPED_UNICODE);
		\lib\db\stores::update(['cat' => $json], \lib\store::id());

		\dash\notif::warn(T_("Category successfully removed"));
		\lib\store::refresh();

		return true;

	}


	public static function update($_old_cat, $_new_cat)
	{

		if($_old_cat == $_new_cat)
		{
			\dash\notif::info(T_("No change"));
			return true;
		}

		if(!$_new_cat)
		{
			\dash\notif::error(T_("Please fill the category"));
			return true;
		}

		if(mb_strlen($_new_cat) > 100)
		{
			\dash\notif::error(T_("Category name is too large!"), 'cat');
			return false;
		}

		$json = self::list();

		if(!isset($json[$_old_cat]))
		{
			\dash\notif::error(T_("Category not found in your store!"), 'cat');
			return false;
		}

		unset($json[$_old_cat]);

		$json[$_new_cat] = ['title' => $_new_cat];

		$json = json_encode($json, JSON_UNESCAPED_UNICODE);
		\lib\db\stores::update(['cat' => $json], \lib\store::id());

		// update products
		$count = \lib\db\products::get_count(['store_id' => \lib\store::id(), 'cat' => $_old_cat]);
		if($count)
		{
			\lib\db\products::update_where(['cat' => $_new_cat], ['store_id' => \lib\store::id(), 'cat' => $_old_cat]);
		}

		\dash\notif::ok(T_("All product by category :old updated to :new", ['old' => $_old_cat, 'new' => $_new_cat]));

		\lib\store::refresh();

		return true;

	}


	public static function list()
	{
		$list = \lib\db\products::field_group_count('cat', \lib\store::id());

		$json = \lib\store::detail('cat');
		if(is_string($json))
		{
			$json = json_decode($json, true);
		}

		if(!is_array($json))
		{
			$json = [];
		}

		$result = [];

		foreach ($list as $key => $value)
		{
			if(isset($json[$key]))
			{
				$result[$key] = array_merge($json[$key], ['count' => $value]);
			}
			else
			{
				$result[$key] = array_merge(['title' => $key], ['count' => $value]);
			}
		}

		foreach ($json as $key => $value)
		{
			if(!isset($result[$key]))
			{
				if(!isset($value['count']))
				{
					$result[$key] = array_merge($value, ['count' => 0]);
				}
				else
				{
					$result[$key] = $value;
				}
			}
		}

		$sort = array_column($result, 'count');
		$sort = array_map('intval', $sort);
		array_multisort($result, SORT_DESC, SORT_NUMERIC, $sort, SORT_DESC);

		return $result;
	}

}
?>