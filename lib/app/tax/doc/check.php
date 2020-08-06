<?php
namespace lib\app\tax\doc;


class check
{

	public static function variable($_args)
	{
		$condition =
		[
			'number' => 'bigint',
			'desc'   => 'string_300',
			'date'   => 'date',
		];

		$require = ['number', 'date'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;

	}

}
?>