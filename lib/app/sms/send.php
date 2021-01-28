<?php
namespace lib\app\sms;

class send
{
	public static function send_once($_args)
	{
		$args = \lib\app\sms\check::variable($_args);
		if(!$args)
		{
			return false;
		}

		$myIp   = \dash\server::ip();
		$ip_id  = \dash\utility\ip::id($myIp);

		$args['status']      = 'pending';
		$args['type']        = 'notif';
		$args['mode']        = 'sms';
		$args['sender']      = 'admin';
		$args['user_id']     = \dash\user::id();
		$args['url']         = \dash\url::pwd();
		$args['urlmd5']      = md5(\dash\url::pwd());
		$args['ip']          = $myIp;
		$args['ip_id']       = $ip_id;
		$args['agent_id']    = \dash\agent::get(true);
		$args['datecreated'] = date("Y-m-d H:i:s");

		$sms_id = \lib\db\sms_log\insert::new_record($args);

		if(!$sms_id)
		{
			\dash\notif::error(T_("Can not add your sms"));
			return false;
		}

		$result       = [];
		$result['id'] = $sms_id;

		\dash\notif::ok(T_("Sms successfully added"));
		return $result;
	}

}
?>