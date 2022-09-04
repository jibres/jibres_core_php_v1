<?php

namespace lib\app\form\filter;


class check
{

	public static function variable($_args, $_id = null)
	{
		$condition =
			[
				'title' => 'title',

			];

		$require = ['title'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		return $data;
	}


	public static function variable_where($_args, $_form_id, $_fields = [],)
	{

		$condition =
			[
				'condition'     => [
					'enum' => [
						'isnull', 'isnotnull', 'larger', 'less', 'equal', 'notequal', 'like',
					],
				],
				'operator'      => ['enum' => ['and', 'or']],
				'field'         => ['enum' => array_column($_fields, 'field')],
				'value'         => 'string_100',
				'tagorquestion' => ['enum' => ['tag', 'question']],
				'tag'           => 'string_100',
				'tag_include'   => ['enum' => ['with', 'without']],
			];

		if(a($_args, 'tagorquestion') === 'tag')
		{
			$require = ['tag', 'tag_include'];
		}
		else
		{
			$require = ['field', 'condition'];
		}

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$data['tag_id'] = null;

		if ($data['tagorquestion'] === 'tag')
		{
			if (!$data['tag'])
			{
				\dash\notif::error(T_("Tag is required"));
				return false;
			}

			$loadTag = \lib\app\form\tag\get::by_title($data['tag'], $_form_id);

			if (isset($loadTag['id']))
			{
				$data['tag_id'] = $loadTag['id'];
			}
			else
			{
				\dash\notif::error(T_("Tag not found"));
				return false;
			}

		}

		unset($data['tagorquestion']);
		unset($data['tag']);

		return $data;
	}

}

?>