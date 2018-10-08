<?php
namespace lib\app\product;


class unit
{

	public static function add($_new_unit)
	{
		if(!$_new_unit && $_new_unit !== '0')
		{
			\dash\notif::error(T_("Plese fill the unit name"), 'unit');
			return false;
		}

		if(mb_strlen($_new_unit) > 100)
		{
			\dash\notif::error(T_("Category name is too large!"), 'unit');
			return false;
		}

		$json = self::list();

		if(isset($json[$_new_unit]))
		{
			\dash\notif::error(T_("Dupliunite unit founded"), 'unit');
			return false;
		}

		$json[$_new_unit] = ['title' => $_new_unit];

		$json = json_encode($json, JSON_UNESCAPED_UNICODE);
		\lib\db\stores::update(['unit' => $json], \lib\store::id());

		\dash\notif::ok(T_("Category successfully added"));
		\lib\store::refresh();

		return true;

	}

	public static function remove($_old_unit)
	{
		$json = self::list();

		if(!isset($json[$_old_unit]))
		{
			\dash\notif::error(T_("Category not found in your store!"), 'unit');
			return false;
		}

		unset($json[$_old_unit]);

		$json = json_encode($json, JSON_UNESCAPED_UNICODE);
		\lib\db\stores::update(['unit' => $json], \lib\store::id());

		\dash\notif::warn(T_("Category successfully removed"));
		\lib\store::refresh();

		return true;

	}


	public static function update($_old_unit, $_new_unit)
	{

		if($_old_unit == $_new_unit)
		{
			\dash\notif::info(T_("No change"));
			return true;
		}

		if(!$_new_unit)
		{
			\dash\notif::error(T_("Please fill the unit"));
			return true;
		}

		if(mb_strlen($_new_unit) > 100)
		{
			\dash\notif::error(T_("Category name is too large!"), 'unit');
			return false;
		}

		$json = self::list();

		if(!isset($json[$_old_unit]))
		{
			\dash\notif::error(T_("Category not found in your store!"), 'unit');
			return false;
		}

		unset($json[$_old_unit]);

		$json[$_new_unit] = ['title' => $_new_unit];

		$json = json_encode($json, JSON_UNESCAPED_UNICODE);
		\lib\db\stores::update(['unit' => $json], \lib\store::id());

		// update products
		$count = \lib\db\products::get_count(['store_id' => \lib\store::id(), 'unit' => $_old_unit]);
		if($count)
		{
			\lib\db\products::update_where(['unit' => $_new_unit], ['store_id' => \lib\store::id(), 'unit' => $_old_unit]);
		}

		\dash\notif::ok(T_("All product by unit :old updated to :new", ['old' => $_old_unit, 'new' => $_new_unit]));

		\lib\store::refresh();

		return true;

	}


	public static function list()
	{
		$list = \lib\db\products::field_group_count('unit', \lib\store::id());

		$json = \lib\store::detail('unit');
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
				$result[$key] = $value;
			}
		}
		krsort($result);
		return $result;
	}

}
?>