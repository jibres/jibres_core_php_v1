<?php
namespace lib\app\product;


class cat
{
	private static function check()
	{
		$title = \dash\app::request('title');
		if(!$title && $title !== '0')
		{
			\dash\notif::error(T_("Plese fill the cat name"), 'cat');
			return false;
		}

		if(mb_strlen($title) > 100)
		{
			\dash\notif::error(T_("Category name is too large!"), 'cat');
			return false;
		}

		$type = \dash\app::request('type');
		if($type && !in_array($type, ['decimal', 'integer']))
		{
			\dash\notif::error(T_("Invalid type of cat"), 'type');
			return false;
		}

		$default = \dash\app::request('catdefault') ? true : false;

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
			\dash\notif::error(T_("Duplicate cat founded"), 'cat');
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


	public static function update($_old_cat, $_new_cat, $_args = [])
	{

		\dash\app::variable($_args);

		$args = self::check();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$json = self::list();

		if(!isset($json[$_old_cat]))
		{
			\dash\notif::error(T_("Category not found in your store!"), 'cat');
			return false;
		}

		unset($json[$_old_cat]);

		if($args['default'])
		{
			foreach ($json as $key => $value)
			{
				$json[$key]['default'] = false;
			}
		}

		$json[$args['title']] = $args;

		$json = json_encode($json, JSON_UNESCAPED_UNICODE);
		\lib\db\stores::update(['cat' => $json], \lib\store::id());

		$msg = T_("Category successfully updated");
		if($_old_cat != $_new_cat)
		{
			// update products
			$count = \lib\db\products::get_count(['store_id' => \lib\store::id(), 'cat' => $_old_cat]);
			if($count)
			{
				\lib\db\products::update_where(['cat' => $_new_cat], ['store_id' => \lib\store::id(), 'cat' => $_old_cat]);
				$msg = T_("All products by category :old updated to :new", ['old' => $_old_cat, 'new' => $_new_cat]);
			}
		}

		\dash\notif::ok($msg);

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