<?php
namespace lib\app\nic_domain;


class edit
{
	public static function edit($_args, $_id)
	{
		$load_domain = \lib\app\nic_domain\get::by_id($_id);
		if(!$load_domain || !isset($load_domain['id']))
		{
			return false;
		}

		\dash\app::variable($_args);

		$args = \lib\app\nic_domain\check::variable();

		if(!$args || !\dash\engine\process::status())
		{
			return false;
		}


		if(!\dash\app::isset_request('autorenew')) unset($args['autorenew']);

		if(!empty($args))
		{
			\lib\db\nic_domain\update::update($args, $load_domain['id']);
		}

		\dash\notif::ok(T_("Detail updated"));
		return true;

	}
}
?>