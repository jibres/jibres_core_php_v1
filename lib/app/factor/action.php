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
					$result['lock'] = true;
					switch ($value)
					{
						case 'comment': 			$t_action = T_('Notes'); 			$result['lock'] = false; break;
						case 'order': 				$t_action = T_('Order register');	break;
						case 'expire': 				$t_action = T_('Expired'); 			break;
						case 'cancel': 				$t_action = T_('Canceled'); 		break;
						case 'go_to_bank': 			$t_action = T_('Go to bank'); 		break;
						case 'pay_successfull': 	$t_action = T_('pay successfull'); 	break;
						case 'pay_error': 			$t_action = T_('pay error'); 		break;
						case 'pay_cancel': 			$t_action = T_('pay cancel'); 		break;
						case 'pay_verified': 		$t_action = T_('pay verified'); 	break;
						case 'pay_unverified': 		$t_action = T_('pay unverified'); 	break;
						case 'sending': 			$t_action = T_('sending'); 			break;
						case 'pending_pay': 		$t_action = T_('pending pay'); 		break;
						case 'pending_verify': 		$t_action = T_('pending verify'); 	break;
						case 'pending_prepare': 	$t_action = T_('pending prepare'); 	break;
						case 'pending_send': 		$t_action = T_('pending send'); 	break;
						case 'deliver': 			$t_action = T_('deliver'); 			break;
						case 'reject': 				$t_action = T_('reject'); 			break;
						case 'spam': 				$t_action = T_('spam'); 			break;
						case 'deleted': 			$t_action = T_('deleted'); 			break;
						default:					$t_action = T_("Unknown");			break;
					}
					$result['t_action'] = $t_action;
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


	public static function remove($_id, $_factor_id)
	{
		$id        = \dash\validate::id($_id);
		$factor_id = \dash\validate::id($_factor_id);

		if(!$id || !$factor_id)
		{
			\dash\notif::error(T_("Id is required"));
			return false;
		}

		$load = \lib\db\factoraction\get::by_id_factor_id($id, $factor_id);
		if(!isset($load['id']) || !isset($load['action']))
		{
			\dash\notif::error(T_("Invalid factor action detail"));
			return false;
		}

		$load = self::ready($load);

		if(isset($load['lock']) && $load['lock'])
		{
			\dash\notif::error(T_("Can not remove system action"));
			return false;
		}


		$remove = \lib\db\factoraction\delete::by_id_factor_id($id, $factor_id);

		\dash\notif::ok(T_("Data removed"));

		return true;
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

		if($data['action'] === 'comment')
		{
			if(!$data['desc'] && !$data['file'])
			{
				\dash\notif::error(T_("Please enter the description or attach a file"), 'cdesc');
				return false;
			}
		}

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

			case 'sending':
				$load_factor = \lib\app\factor\get::inline_get((string) $factor_id);
				if(isset($load_factor['customer']))
				{
					\dash\log::set('order_customerSendingOrder', ['to' => $load_factor['customer'], 'my_id' => $factor_id]);
				}

				\lib\app\factor\edit::status($data['action'], $factor_id);
				break;

			case 'expire':
			case 'order':
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