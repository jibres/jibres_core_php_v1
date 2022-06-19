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
			'date'      => 'date',
			'time'      => 'time',
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


		if(!$data['date'])
		{
			$data['date'] = date("Y-m-d");
		}

		if(!$data['time'])
		{
			$data['time'] = date("H:i:s");
		}

		$data['date'] = $data['date']. ' '. $data['time'];
		unset($data['time']);
		unset($data['file']);

		$data['datemodified'] = date("Y-m-d H:i:s");

		\lib\db\form_comment\update::update($data, $id);

		\dash\notif::ok(T_("Saved"));

		return true;

	}
}
?>