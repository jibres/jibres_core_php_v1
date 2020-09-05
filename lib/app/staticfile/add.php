<?php
namespace lib\app\staticfile;


class add
{

	public static function add($_args)
	{

		$condition =
		[
			'filename'    => 'string_50',
			'filecontent' => 'string_500',
		];

		$data = \dash\cleanse::input($_args, $condition, ['filename'], []);

		$args = \dash\cleanse::patch_mode($_args, $data);

		$cat  = 'staticfile_verify';

		$list = \lib\app\staticfile\get::get_list();

		if(is_array($list) && count($list) > 10)
		{
			\dash\notif::error(T_("Maximum capacity of static file is full!"));
			return false;
		}

		\lib\app\setting\tools::update($cat, $data['filename'], $data['filecontent']);

		\dash\notif::ok(T_("Static file added"));
		return true;

	}
}
?>