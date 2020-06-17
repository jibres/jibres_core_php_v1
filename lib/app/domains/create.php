<?php
namespace lib\app\domains;


class create
{
	public static function new_domain($_args)
	{
		if(!isset($_args['domain']))
		{
			\dash\notif::error(T_("Please set the domain"));
			return false;
		}

		if(\dash\validate::ir_domain($_args['domain'], false))
		{
			return \lib\app\nic_domain\create::new_domain($_args);
		}
		else
		{
			return \lib\app\onlinenic\create::new_domain($_args);
		}

	}
}
?>
