<?php
namespace dash\app\permission;


class check
{

	public static function variable($_args)
	{
		$condition =
		[
			'title'      => 'title',
		];

		$require = ['title'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(mb_strtolower($data['title']) === 'admin' || mb_strtolower($data['title']) === 'supervisor' || strpos(mb_strtolower($data['title']), 'supervisor') !== false)
		{
			\dash\notif::error(T_("Can not choose this name in permission title, Try another title"), 'title');
			return false;
		}

		if(mb_strlen($data['title']) < 3)
		{
			\dash\notif::error(T_("Please fill permission title larger than 3 character"));
			return false;
		}

		return $data;
	}
}
?>