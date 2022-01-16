<?php
namespace dash\app\permission;


class check
{

	public static function variable($_args)
	{
		$condition =
		[
			'title'      => 'string_50',
		];

		$require = ['title'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(\dash\str::mb_strtolower($data['title']) === 'admin' || \dash\str::mb_strtolower($data['title']) === 'supervisor' || \dash\str::strpos(\dash\str::mb_strtolower($data['title']), 'supervisor') !== false)
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