<?php
namespace lib\app\menu;


class update
{
	public static function product($_id, $_set = false)
	{
		$is_used = self::is_used('products', $_id);

		if(!$_set)
		{
			return $is_used;
		}

		if($is_used)
		{
			$load = \lib\app\product\get::get($_id);

			if(isset($load['url']))
			{
				return self::fix_update('products', $_id, $load['url']);
			}
		}

		return null;
	}



	private static function fix_update($_pointer, $_relate_id, $_url)
	{
		if($_pointer && $_relate_id && is_string($_pointer) && is_numeric($_relate_id) && $_url)
		{
			\lib\db\menu\update::update_related_url($_pointer, $_relate_id, $_url);
		}
	}


	public static function is_used($_pointer, $_relate_id)
	{
		if($_pointer && $_relate_id && is_string($_pointer) && is_numeric($_relate_id))
		{
			$used = \lib\db\menu\get::get_used($_pointer, $_relate_id);
			if($used && is_array($used))
			{
				return $used;
			}
			else
			{
				return false;
			}
		}

		return false;
	}
}
?>