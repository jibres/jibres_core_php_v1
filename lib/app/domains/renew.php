<?php
namespace lib\app\domains;


class renew
{
	public static function renew($_args)
	{
		if(!isset($_args['domain']))
		{
			\dash\notif::error(T_("Please set the domain"));
			return false;
		}

		if(\dash\validate::ir_domain($_args['domain'], false))
		{
			return \lib\app\nic_domain\renew::renew($_args);
		}
		else
		{
			return \lib\app\onlinenic\renew::renew($_args);
		}

	}
}
?>
