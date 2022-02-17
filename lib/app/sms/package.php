<?php
namespace lib\app\sms;

class package
{
	public static function check(&$sms_detail)
	{
		if(!\dash\url::isLocal())
		{
			return true;
		}

		$store_id = a($sms_detail, 'store_id');

		if(!is_numeric($store_id))
		{
			// jibres sms send anyway
			return true;
		}


		/**

			TODO:
			- Check store sms package active
			- check is currently active this package
			- if current package have not money disable package and check again to next package
			- check count used sms in current package
			- if have capacity return true
			- else return false

		 */

		$get_store_package_list = \lib\db\store_plugin\get::active_by_business_id_plugin($store_id, 'sms_pack');

		if(!is_array($get_store_package_list))
		{
			$get_store_package_list = [];
		}

		foreach ($get_store_package_list as $key => $value)
		{
			/**
			 * $value['id'] = package_id
			 */

			$usage_count = \lib\db\sms\get::sum_sms_sended_by_package_id($store_id, $value['id']);


			if(!is_numeric($usage_count))
			{
				$usage_count = 0;
			}
			else
			{
				$usage_count = floatval($usage_count);
			}

			if($usage_count + floatval(a($sms_detail, 'smscount')) > floatval(a($value, 'packagecount')))
			{
				// todo
				// check remain sms count
				// if have 1 sms and this sms count is 2 we lost 1 sms!
				// need to deactive this package
				\lib\db\store_plugin\update::record(['status' => 'expired'], $value['id']);
			}
			else
			{
				$sms_detail['package_id'] = $value['id'];
				break;
			}
		}

		if(a($sms_detail, 'package_id'))
		{
			$sms_detail['status'] = 'pending';
			return true;
		}
		else
		{
			if($get_store_package_list)
			{

			}
			else
			{

			}

			$sms_detail['status'] = 'moneylow';
			return false;
		}
	}
}
?>