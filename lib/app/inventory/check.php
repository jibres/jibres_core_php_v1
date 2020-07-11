<?php
namespace lib\app\inventory;


class check
{

	public static function variable($_args, $_id = null)
	{
		$condition =
		[
			'name'             => 'string_200',
		];

		$require = ['name'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);



		return $data;

	}

}
?>