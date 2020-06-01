<?php
namespace lib\app\fund;


class check
{

	public static function variable($_args, $_id = null)
	{
		$condition =
		[
			'title'          => 'title',
			'desc'           => 'desc',
			'slug'           => 'slug',

		];

		$require = ['title'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if(!$data['slug'])
		{
			$data['slug'] = \dash\validate::slug($data['title'], false);
		}

		return $data;

	}

}
?>