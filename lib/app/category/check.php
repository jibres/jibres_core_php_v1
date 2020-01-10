<?php
namespace lib\app\category;


class check
{

	public static function variable($_id = null)
	{
		$title = \dash\app::request('title');
		if(!is_string($title))
		{
			\dash\notif::error(T_("Format error!"));
			return false;
		}

		if(!$title && $title !== '0')
		{
			\dash\notif::error(T_("Plese fill the category name"), 'category');
			return false;
		}

		if(mb_strlen($title) > 100)
		{
			\dash\notif::error(T_("Category name is too large!"), 'category');
			return false;
		}

		$desc = \dash\app::request('desc');
		if(\dash\app::isset_request('desc') && !is_string($desc))
		{
			\dash\notif::error(T_("Format error!"));
			return false;
		}

		if(mb_strlen($desc) > 10000)
		{
			\dash\notif::error(T_("Category description is too large!"), 'category');
			return false;
		}

		$file = \dash\app::request('file');

		$args          = [];
		$args['title'] = $title;
		$args['desc']  = $desc;
		$args['file']  = $file;

		return $args;

	}

}
?>