<?php
namespace lib\app\store;


class setting
{
	public static function set($_args)
	{
		if(!\lib\store::id())
		{
			return false;
		}

		\dash\app::variable($_args);


		$maxbuyprice = \dash\app::request('maxbuyprice');
		$maxbuyprice = \dash\utility\convert::to_en_number($maxbuyprice);

		if($maxbuyprice && !is_numeric($maxbuyprice))
		{
			\dash\notif::error(T_("Please set maxbuyprice as a number"), 'maxbuyprice');
			return false;
		}

		if(intval($maxbuyprice) > 1E+20 || intval($maxbuyprice) < 0)
		{
			\dash\notif::error(T_("maxbuyprice is out of range"), 'maxbuyprice');
			return false;
		}


		$maxprice = \dash\app::request('maxprice');
		$maxprice = \dash\utility\convert::to_en_number($maxprice);

		if($maxprice && !is_numeric($maxprice))
		{
			\dash\notif::error(T_("Please set maxprice as a number"), 'maxprice');
			return false;
		}

		if(intval($maxprice) > 1E+20 || intval($maxprice) < 0)
		{
			\dash\notif::error(T_("maxprice is out of range"), 'maxprice');
			return false;
		}


		$maxdiscount = \dash\app::request('maxdiscount');
		$maxdiscount = \dash\utility\convert::to_en_number($maxdiscount);

		if($maxdiscount && !is_numeric($maxdiscount))
		{
			\dash\notif::error(T_("Please set maxdiscount as a number"), 'maxdiscount');
			return false;
		}

		if(intval($maxdiscount) > 100 || intval($maxdiscount) < 0)
		{
			\dash\notif::error(T_("maxdiscount is out of range"), 'maxdiscount');
			return false;
		}


		$maxproductcount = \dash\app::request('maxproductcount');
		$maxproductcount = \dash\utility\convert::to_en_number($maxproductcount);

		if($maxproductcount && !is_numeric($maxproductcount))
		{
			\dash\notif::error(T_("Please set maxproductcount as a number"), 'maxproductcount');
			return false;
		}

		if(intval($maxproductcount) > 1E+20 || intval($maxproductcount) < 0)
		{
			\dash\notif::error(T_("maxproductcount is out of range"), 'maxproductcount');
			return false;
		}

		$new                    = [];
		$new['maxbuyprice']     = $maxbuyprice;
		$new['maxprice']        = $maxprice;
		$new['maxdiscount']     = $maxdiscount;
		$new['maxproductcount'] = $maxproductcount;

		$old = \lib\app\store::get_my_store('setting');

		if(is_string($old))
		{
			$old = json_decode($old, true);
		}

		if(!is_array($old))
		{
			$old = [];
		}

		$setting = array_merge($old, $new);

		$setting = json_encode($setting, JSON_UNESCAPED_UNICODE);

		$result = \lib\db\stores::update(['setting' => $setting], \lib\store::id());

		\dash\notif::ok(T_("Seetting saved"));

		\lib\store::refresh();

		return true;
	}


}
?>