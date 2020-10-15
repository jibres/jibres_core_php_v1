<?php
namespace lib\app\tag;


class get
{



	public static function load_product_by_tag($_tag)
	{
		$_tag = \dash\validate::string($_tag);
		if(!$_tag)
		{
			return false;
		}

		$_tag     = urldecode($_tag);
		$load_tag = \lib\db\producttag\get::by_slug($_tag);
		return $load_tag;
	}


	public static function all_tag()
	{
		$result = \lib\db\producttag\get::all_tag();
		return $result;
	}



	public static function product_tag($_product_id)
	{
		$detail = \lib\app\product\get::inline_get($_product_id);
		if(!$detail)
		{
			return false;
		}

		$get_usage = \lib\db\producttagusage\get::usage($_product_id);

		return $get_usage;
	}


	public static function inline_get($_id)
	{
		$_id = \dash\validate::id($_id);

		if(!$_id)
		{
			\dash\notif::error(T_("Invalid tag id"));
			return false;
		}

		$load = \lib\db\producttag\get::one($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid tag id"));
			return false;
		}

		return $load;
	}


	public static function get($_id)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		\dash\permission::access('productTagListView');

		$_id = \dash\validate::id($_id);

		if(!$_id)
		{
			\dash\notif::error(T_("Invalid tag id"));
			return false;
		}

		$load = \lib\db\producttag\get::one($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid tag id"));
			return false;
		}

		$load['count'] = \lib\db\producttag\get::get_count_product($_id);

		$load = \lib\app\tag\ready::row($load);
		return $load;
	}

}
?>