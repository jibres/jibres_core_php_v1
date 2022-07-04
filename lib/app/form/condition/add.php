<?php
namespace lib\app\form\condition;


class add
{
	public static function add($_args, $_form_id)
	{

		$condition =
		[
			'if'        => 'id',
			'operation' => ['enum' => ['isequal', 'isnotequal']],
			'value'     => 'string_100',
			'then'      => 'id',
			'else'      => 'id',
		];

		$require = ['if', 'operation', 'value', 'then'];

		$meta =
		[
			'field_title' =>
			[

			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$load_form = \lib\app\form\form\get::by_id($_form_id);

		$condition = [];

		if(is_array(a($load_form, 'condition')))
		{
			$condition = $load_form['condition'];
		}

		$condition[] = $data;

		$condition = json_encode($condition);

		\lib\db\form\update::update(['condition' => $condition], $_form_id);

		\dash\notif::ok(T_("Condition added"));

		return true;


	}
}
?>