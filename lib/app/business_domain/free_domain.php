<?php
namespace lib\app\business_domain;

class free_domain
{

	public static function check($_id)
	{
		$load = \lib\app\business_domain\get::get($_id);

		if(!$load || !isset($load['domain']))
		{
			return false;
		}

		$result = \lib\app\business_domain\enterprise_check::is_connected_to_jibres($load['domain']);

		if(strpos($result, 'x-powered-by: jibres') !== false)
		{
			$is_connected_to_jibres = true;
		}
		else
		{
			$is_connected_to_jibres = false;
		}

		if($is_connected_to_jibres)
		{
			\lib\app\business_domain\edit::edit_raw(['status' => 'ok'], $_id);
			\lib\app\business_domain\action::new_action($_id, 'enterprise_connected', ['meta' => $result]);
		}
		else
		{
			\dash\notif::error(T_("This domain was not connected to Jibres"));
			\lib\app\business_domain\action::new_action($_id, 'enterprise_not_connected', ['meta' => $result]);
			return false;
		}

	}
}
?>