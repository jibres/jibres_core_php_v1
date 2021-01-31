<?php
namespace dash\app\log;


class add
{


	public static function notif_once($_args)
	{

		$condition =
		[
			'user' => 'code',
			'text' => 'desc',
		];

		$require = ['user', 'text'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$log = [];

		$log['to']          = \dash\coding::decode($data['user']);

		$title = a($data, 'title');
		if(!$title)
		{
			$title = T_("Notifation");
		}

		$log['notif_title'] = $title;
		$log['notif_text']  = a($data, 'text');
		$log['notif_group'] = a($data, 'group');

		$log_id = \dash\log::set('notif_text', $log);

		\dash\notif::ok(T_("Notifation sended"));

		$result = [];
		$result['id'] = $log_id;

		return $result;


	}




}
?>