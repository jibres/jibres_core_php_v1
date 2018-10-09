<?php
namespace lib\app\product;


class unit
{
	private static function check()
	{
		$title = \dash\app::request('title');
		if(!$title && $title !== '0')
		{
			\dash\notif::error(T_("Plese fill the unit name"), 'unit');
			return false;
		}

		if(mb_strlen($title) > 100)
		{
			\dash\notif::error(T_("Unit name is too large!"), 'unit');
			return false;
		}

		$type = \dash\app::request('type');
		if($type && !in_array($type, ['decimal', 'integer']))
		{
			\dash\notif::error(T_("Invalid type of unit"), 'type');
			return false;
		}

		$default = \dash\app::request('unitdefault') ? true : false;

		$maxsale = \dash\app::request('maxsale');
		if($maxsale && !is_numeric($maxsale))
		{
			\dash\notif::error(T_("Plese set the max sale as a number"), 'maxsale');
			return false;
		}

		if($maxsale)
		{
			$maxsale = abs(intval($maxsale));
			if($maxsale > 1E+9)
			{
				\dash\notif::error(T_("Max sale is out of range"), 'maxsale');
				return false;
			}
		}

		$args            = [];
		$args['title']   = $title;
		$args['type']    = $type;
		$args['default'] = $default;
		$args['maxsale'] = $maxsale;
		return $args;

	}


	public static function add($_args)
	{
		\dash\app::variable($_args);

		$args = self::check();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$json = self::list();

		if(isset($json[$args['title']]))
		{
			\dash\notif::error(T_("Duplicate unit founded"), 'unit');
			return false;
		}

		if($args['default'])
		{
			foreach ($json as $key => $value)
			{
				$json[$key]['default'] = false;
			}
		}

		$json[$args['title']] = $args;


		$json = json_encode($json, JSON_UNESCAPED_UNICODE);
		\lib\db\stores::update(['unit' => $json], \lib\store::id());

		\dash\notif::ok(T_("Unit successfully added"));
		\lib\store::refresh();

		return true;

	}

	public static function remove($_old_unit)
	{
		$json = self::list();

		if(!isset($json[$_old_unit]))
		{
			\dash\notif::error(T_("Unit not found in your store!"), 'unit');
			return false;
		}

		unset($json[$_old_unit]);

		$json = json_encode($json, JSON_UNESCAPED_UNICODE);
		\lib\db\stores::update(['unit' => $json], \lib\store::id());

		\dash\notif::warn(T_("Unit successfully removed"));
		\lib\store::refresh();

		return true;

	}


	public static function update($_old_unit, $_new_unit, $_args = [])
	{

		\dash\app::variable($_args);

		$args = self::check();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$json = self::list();

		if(!isset($json[$_old_unit]))
		{
			\dash\notif::error(T_("Unit not found in your store!"), 'unit');
			return false;
		}

		unset($json[$_old_unit]);

		if($args['default'])
		{
			foreach ($json as $key => $value)
			{
				$json[$key]['default'] = false;
			}
		}

		$json[$args['title']] = $args;

		$json = json_encode($json, JSON_UNESCAPED_UNICODE);
		\lib\db\stores::update(['unit' => $json], \lib\store::id());


		$msg = T_("Unit successfully updated");
		if($_old_unit != $_new_unit)
		{
			// update products
			$count = \lib\db\products::get_count(['store_id' => \lib\store::id(), 'unit' => $_old_unit]);
			if($count)
			{
				\lib\db\products::update_where(['unit' => $_new_unit], ['store_id' => \lib\store::id(), 'unit' => $_old_unit]);
				$msg = T_("All products by unit :old updated to :new", ['old' => $_old_unit, 'new' => $_new_unit]);
			}
		}

		\dash\notif::ok($msg);

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