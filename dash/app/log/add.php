<?php
namespace dash\app\log;


class add
{


	public static function notif_once($_args)
	{

		$condition =
		[
			'user'         => 'code',
			'text'         => 'desc',
			'sendsms'      => 'bit',
			'sendtelegram' => 'bit',
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

		// in store or if not supervisor can not send notif by sms
		if(\dash\engine\store::inStore() || !\dash\permission::supervisor())
		{
			$data['sendsms']      = null;
			$data['sendtelegram'] = null;
		}


		$log['notif_sendsms']      = $data['sendsms'];
		$log['notif_sendtelegram'] = $data['sendtelegram'];


		$log_id = \dash\log::set('notif_text', $log);

		\dash\notif::ok(T_("Notifation sended"));

		$result = [];
		$result['id'] = $log_id;

		return $result;


	}


	public static function notif_group($_args)
	{

		$condition =
		[
			'group' => \dash\app\user\group::check_input(),
			'text'  => 'desc',
		];

		$require = ['group', 'text'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$title = a($data, 'title');
		if(!$title)
		{
			$title = T_("Notifation");
		}

		$log['notif_title']    = $title;
		$log['notif_text']     = a($data, 'text');
		$log['notif_group']    = a($data, 'group');
		$log['get_sql_string'] = true;

		$get_sql_string = \dash\log::set('notif_text', $log);

		$result = \dash\db\logs\insert::send_group($get_sql_string, $data['group']);

		if($result)
		{
			\dash\notif::ok(T_("Send notification successfully"));
			return true;
		}
		else
		{
			\dash\notif::error(T_("Can not send your notification"));
			return false;
		}

	}
}
?>