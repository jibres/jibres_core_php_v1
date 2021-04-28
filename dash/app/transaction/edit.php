<?php
namespace dash\app\transaction;

class edit
{


	public static function verify_again($_id)
	{

		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}

		$load = \dash\db\transactions\get::by_id($id);
		if(!$load || !is_array($load))
		{
			return false;
		}

		$load = \dash\app\transaction::ready($load);

		if(isset($load['verify_again']) && $load['verify_again'])
		{
			// ok. no problem
		}
		else
		{
			\dash\notif::error(T_("This request cannot be verified again!"));
			return false;
		}

		if(a($load, 'payment') === 'zarinpal')
		{
			$args =
			[
				'Authority' => a($load, 'banktoken'),
				'amount'    => a($load, 'plus'),
			];

			$verify = \dash\utility\pay\api\zarinpal\back::verify_again($args, $id);

			if($verify === false)
			{
				\dash\notif::error_once(T_("Can not verify this request"));
				return false;
			}

			$meta =
			[
				'verify_again' => date("Y-m-d H:i:s"),
				'user'         => \dash\user::id(),
			];

			$update                      = [];
			$update['payment_response3'] = json_encode($verify['payment_response3'], JSON_UNESCAPED_UNICODE);

			$update['meta'] = json_encode($meta, JSON_UNESCAPED_UNICODE);
			if(a($verify, 'ok') === true)
			{
				$update['condition'] = 'ok';
				$update['verify'] = 1;

				\dash\notif::ok(T_("Request successfully verified and the amount added to your budget"));
			}
			else
			{
				\dash\notif::warn(T_("This request is not verified"));

			}

			\dash\db\transactions\update::record($update, $id);

			return true;
		}
		else
		{
			\dash\notif::error(T_("Can not verify again this request! Please contact to administrator"));
			return false;
		}

		return $load;


	}
}
?>