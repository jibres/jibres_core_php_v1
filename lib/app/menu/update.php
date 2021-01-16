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


	public static function hashtag($_id, $_set = false)
	{
		$is_used = self::is_used('hashtag', $_id);

		if(!$_set)
		{
			return $is_used;
		}

		if($is_used)
		{
			$load = \lib\app\tag\get::get($_id);

			if(isset($load['link']))
			{
				return self::fix_update('hashtag', $_id, $load['link']);
			}
		}

		return null;
	}


	public static function post($_id, $_set = false)
	{
		$is_used = self::is_used('posts', $_id);

		if(!$_set)
		{
			return $is_used;
		}

		if($is_used)
		{
			$load = \dash\app\posts\get::get(\dash\coding::encode($_id));

			if(isset($load['link']))
			{
				return self::fix_update('posts', $_id, $load['link']);
			}
		}

		return null;
	}

	public static function tag($_id, $_set = false)
	{
		$is_used = self::is_used('tags', $_id);

		if(!$_set)
		{
			return $is_used;
		}

		if($is_used)
		{
			$load = \dash\app\terms\get::get(\dash\coding::encode($_id));

			if(isset($load['link']))
			{
				return self::fix_update('tags', $_id, $load['link']);
			}
		}

		return null;
	}


	public static function form($_id, $_set = false)
	{
		$is_used = self::is_used('forms', $_id);

		if(!$_set)
		{
			return $is_used;
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