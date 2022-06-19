<?php
namespace lib\app\form\comment;


class edit
{
	public static function edit($_args, $_id)
	{
		\dash\permission::access('FormDescription');

		$condition =
		[
			'content'   => 'desc',
			'privacy'   => ['enum' => ['public', 'private']],
			'color'     => ['enum' => ['primary','secondary','success','danger','warning','info','light','dark',]],
			'file'      => 'bit',
		];

		$require = ['content', 'privacy'];

		$id = \dash\validate::id($_id);

		if(!$id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		unset($data['file']);

		\lib\db\form_comment\update::update($data, $id);

		\dash\notif::ok(T_("Saved"));

		return true;

	}
}
?>