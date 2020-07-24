<?php
namespace lib\app\factor;


class action
{


	public static function get_by_factor_id_public($_id)
	{
		$result = \lib\db\factoraction\get::all_by_factor_id_public($_id);
		if($result && is_array($result))
		{
			$result = array_map(['self', 'ready'], $result);
		}

		return $result;
	}


	public static function get_by_factor_id($_id)
	{
		$result = \lib\db\factoraction\get::all_by_factor_id($_id);
		if($result && is_array($result))
		{
			$result = array_map(['self', 'ready'], $result);
		}

		return $result;
	}


	public static function ready($_data)
	{
		$_data = \dash\app::fix_avatar($_data);

		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'file':
					if($value)
					{
						$value = \lib\filepath::fix($value);
					}
					$result[$key] = $value;
					break;


				case 'action':
					$result[$key] = $value;
					switch ($value)
					{
						case 'enable': 				$t_status = T_("Enable");				break;
						case 'disable': 			$t_status = T_("Disable");				break;
						case 'draft': 				$t_status = T_("Draft");				break;
						case 'order': 				$t_status = T_("Order");				break;
						case 'expire': 				$t_status = T_("Expire");				break;
						case 'cancel': 				$t_status = T_("Cancel");				break;
						case 'pending_pay': 		$t_status = T_("Pending pay");			break;
						case 'pending_verify': 		$t_status = T_("Pending verify");		break;
						case 'pending_prepare': 	$t_status = T_("Pending prepare");		break;
						case 'pending_send': 		$t_status = T_("Pending send");			break;
						case 'sending': 			$t_status = T_("Sending");				break;
						case 'deliver': 			$t_status = T_("Deliver");				break;
						case 'reject': 				$t_status = T_("Reject");				break;
						case 'spam': 				$t_status = T_("Spam");					break;
						case 'deleted': 			$t_status = T_("Deleted");				break;
						default:					$t_status = T_("Unknown");				break;
					}
					$result['t_action'] = $t_status;
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}

	public static function set($_action, $_factor_id)
	{
		$factor_id = \lib\app\factor\get::fix_id($_factor_id);

		if(!$_action || !$factor_id)
		{
			return false;
		}

		$insert =
		[
			'factor_id'   => $factor_id,
			'action'      => $_action,
			'user_id'     => \dash\user::id(),
			'datecreated' => date("Y-m-d H:i:s")
		];

		return \lib\db\factoraction\insert::new_record($insert);
	}


	public static function add($_args, $_factor_id)
	{
		$condition =
		[
			'action'     => ['enum' => ['comment','order','expire','cancel','go_to_bank','pay_successfull','pay_error','pay_cancel','pay_verified','pay_unverified','sending','pending_pay','pending_verify','pending_prepare','pending_send','deliver','reject','spam','deleted']],
			'desc'       => 'desc',
			'file'       => 'desc',
		];

		$require = ['action'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$factor_id = \lib\app\factor\get::fix_id($_factor_id);

		if(!$factor_id)
		{
			return false;
		}

		$insert =
		[
			'factor_id'   => $factor_id,
			'action'      => $data['action'],
			'desc'        => $data['desc'],
			'file'        => $data['file'],
			'user_id'     => \dash\user::id(),
			'datecreated' => date("Y-m-d H:i:s")
		];

		$result = \lib\db\factoraction\insert::new_record($insert);
		\dash\notif::ok(T_("Operation accomplished"));

		// the status of factor : 'enable','disable','draft','order','expire','cancel','pending_pay','pending_verify','pending_prepare','pending_send','sending','deliver','reject','spam','deleted'

		switch ($data['action'])
		{
			case 'pay_successfull':
			case 'pay_verified':
				\lib\db\factors\update::record(['type' => 'sale', 'pay' => 1, 'status' => 'pending_prepare', 'datemodified' => date("Y-m-d H:i:s")], $factor_id);
				break;

			case 'pay_error':
			case 'pay_cancel':
			case 'pay_unverified':
				\lib\db\factors\update::record(['type' => 'saleorder', 'pay' => 0, 'status' => 'reject', 'datemodified' => date("Y-m-d H:i:s")], $factor_id);
				break;

			case 'cancel':
				\lib\db\factors\update::record(['type' => 'saleorder', 'status' => 'cancel', 'datemodified' => date("Y-m-d H:i:s")], $factor_id);
				break;

			case 'expire':
			case 'order':
			case 'sending':
			case 'pending_pay':
			case 'pending_verify':
			case 'pending_prepare':
			case 'pending_send':
			case 'deliver':
			case 'reject':
			case 'spam':
				\lib\app\factor\edit::status($data['action'], $factor_id);
				break;

			case 'comment':
			case 'go_to_bank':
			default:
				// nothing
				break;
		}
		return true;
	}
}
?>