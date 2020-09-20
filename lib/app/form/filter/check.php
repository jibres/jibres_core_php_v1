<?php
namespace lib\app\form\filter;


class check
{
	public static function variable($_args, $_id = null)
	{
		$condition =
		[
			'title'     => 'title',

		];

		$require = ['title'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;
	}


	public static function variable_where($_args, $_fields = [])
	{




		$condition =
		[
			'condition' => ['enum' => ['IS NULL', 'IS NOT NULL', '>=', '<=', '=', '!=',]],
			'operator'  => ['enum' => ['and', 'or']],
			'field'     => ['enum' => array_column($_fields, 'field')],
			'value'     => 'string_100',
		];

		$require = ['field', 'condition'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;
	}
}
?>