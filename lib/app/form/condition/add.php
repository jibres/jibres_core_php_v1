<?php
namespace lib\app\form\condition;


class add
{
	public static function add($_args, $_form_id)
	{
		\dash\permission::access('ManageForm');

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

		if($data['if'] === $data['then'])
		{
			\dash\notif::error(T_("A question cannot be conditioned on itself"));
			return false;
		}

		if($data['if'] === $data['else'])
		{
			\dash\notif::error(T_("A question cannot be conditioned on itself"));
			return false;
		}

		if($data['then'] === $data['else'])
		{
			\dash\notif::error(T_("Both sides of the bet should not be equal"));
			return false;
		}



		$load_form = \lib\app\form\form\get::by_id($_form_id);

		$condition = [];

		if(is_array(a($load_form, 'condition')))
		{
			$condition = $load_form['condition'];
		}

		foreach ($condition as $key => $value)
		{
			$check = [a($value, 'then'), a($value, 'else')];

			if(
				($data['if'] && in_array($data['if'], $check) ) ||
				($data['else'] && in_array($data['else'], $check) ) ||
				($data['then'] && in_array($data['then'], $check) )
			  )
			{
				\dash\notif::error(T_("A side of condition exist in current condition"));
				return false;
			}
		}

		$condition[] = $data;

		$condition = json_encode($condition);

		\lib\db\form\update::update(['condition' => $condition], $_form_id);

		\dash\notif::ok(T_("Condition added"));

		return true;


	}
}
?>