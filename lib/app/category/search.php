<?php
namespace lib\app\category;


class search
{
	public static function list_child($_category_id, $_string = null, $_args = [])
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if($_string)
		{
			$_string = \dash\safe::forQueryString($_string);
			if(mb_strlen($_string) > 50)
			{
				$_string = null;
			}
		}

		if(!$_category_id || !is_numeric($_category_id))
		{
			\dash\notif::error(T_("Invalid category id"));
			return false;
		}

		$meta = [];

		$load_category = \lib\app\category\get::inline_get($_category_id);

		$parent_field = null;

		if(!isset($load_category['parent1']))
		{
			$parent_field    = 'parent1';
			$meta['parent2'] = null;
			$meta['parent3'] = null;
		}

		if(isset($load_category['parent1']) && $load_category['parent1'])
		{
			$parent_field    = 'parent2';
			$meta['parent3'] = null;
		}

		if(isset($load_category['parent2']) && $load_category['parent2'])
		{
			$parent_field = 'parent3';
		}

		if(isset($load_category['parent3']) && $load_category['parent3'])
		{
			\dash\notif::error(T_("This record is not childable"));
			return false;
		}

		if(!$parent_field)
		{
			\dash\notif::error(T_("This record have not child"));
			return false;
		}

		$result = \lib\db\productcategory\get::list_child($_category_id, $parent_field, $_string, $meta);

		$temp            = [];


		foreach ($result as $key => $value)
		{
			$check = \lib\app\category\ready::row($value);
			if($check)
			{
				$temp[] = $check;
			}
		}
		// j($temp);
		return $temp;
	}


	public static function list($_string = null, $_args = [])
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if($_string)
		{
			$_string = \dash\safe::forQueryString($_string);
			if(mb_strlen($_string) > 50)
			{
				$_string = null;
			}
		}

		unset($_args['sort']);
		unset($_args['order']);

		$result = \lib\db\productcategory\get::list($_string, $_args);

		$temp            = [];


		foreach ($result as $key => $value)
		{
			$check = \lib\app\category\ready::row($value);
			if($check)
			{
				$temp[] = $check;
			}
		}
		// j($temp);
		return $temp;
	}




}
?>