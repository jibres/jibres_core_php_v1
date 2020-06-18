<?php
namespace lib\app\domains;


class transfer
{
	public static function transfer($_args)
	{
		if(!isset($_args['domain']))
		{
			\dash\notif::error(T_("Please set the domain"));
			return false;
		}

		if(\dash\validate::ir_domain($_args['domain'], false))
		{
			return \lib\app\nic_domain\transfer::transfer($_args);
		}
		else
		{
			return \lib\app\onlinenic\transfer::transfer($_args);
		}

	}
}
?>
