<?php
namespace lib\app\form\choice;


class check
{
	public static function variable($_args, $_id = null, $_current_detail = [])
	{
		$condition =
		[
			'title'        => 'title',
			'desc'         => 'desc',
		];

		$require = ['title'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;
	}
}
?>