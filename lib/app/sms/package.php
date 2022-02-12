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


		// var_dump($store_id);exit;
		// $sms_detail['status'] = 'moneylow';

		return false;

	}

}
?>