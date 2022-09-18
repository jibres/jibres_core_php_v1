<?php
namespace content_love\plugin\who;


class model
{

	public static function post()
	{
		if($store_id = \dash\request::post('store_id'))
		{
			$package_id =\dash\request::post('pid');
			$package_count =\dash\request::post('pc');

			$count_usage = \lib\db\sms\get::sum_sms_sended_by_package_id($store_id, $package_id);

			$remain = floatval($package_count) - floatval($count_usage);

			if($remain)
			{
				$charge = $remain * 100;
				$x = "SELECT * FROM sms_charge where sms_charge.store_id = $store_id and sms_charge.`desc` like '%#$package_id%' limit 1";
				$checkDuplicate = \dash\pdo::get($x, [], null, true, 'api_log');

				if($checkDuplicate)
				{
					\dash\notif::error('duplicate');
					return false;
				}

				$args =
					[
						'store_id' => $store_id,
						'amount'   => $charge,
						'desc'     => T_("Move from sms package system"). ' #'. $package_id,
						'type'     => 'plus',
					];
				\lib\app\sms_charge\charge::setManual($args);

			}


		}


	}

}

?>
