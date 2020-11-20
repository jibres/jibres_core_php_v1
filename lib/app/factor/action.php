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
					$t_action = null;

					switch ($value)
					{
						case 'tracking': 					$t_action = T_('Tracking'); break;
						case 'notes': 					$t_action = T_('Notes'); break;
						case 'draft': 						$t_action = T_('Draft'); break;
						case 'registered': 					$t_action = T_('Registered'); break;
						case 'awaiting': 					$t_action = T_('Awaiting'); break;
						case 'confirmed': 					$t_action = T_('Confirmed'); break;
						case 'cancel': 						$t_action = T_('Cancel'); break;
						case 'expire': 						$t_action = T_('Expire'); break;
						case 'preparing': 					$t_action = T_('Preparing'); break;
						case 'sending': 					$t_action = T_('Sending'); break;
						case 'delivered': 					$t_action = T_('Delivered'); break;
						case 'revert': 						$t_action = T_('Revert'); break;
						case 'success': 					$t_action = T_('Success'); break;
						case 'archive': 					$t_action = T_('Archive'); break;
						case 'deleted': 					$t_action = T_('Deleted'); break;
						case 'spam': 						$t_action = T_('Spam'); break;
						case 'go_to_bank': 					$t_action = T_('Go to bank'); break;
						case 'pay_error': 					$t_action = T_('Pay error'); break;
						case 'pay_cancel': 					$t_action = T_('Pay cancel'); break;
						case 'awaiting_payment': 			$t_action = T_('Awaiting payment'); break;
						case 'awaiting_verify_payment': 	$t_action = T_('Awaiting verify payment'); break;
						case 'unsuccessful_payment': 		$t_action = T_('Unsuccessful payment'); break;
						case 'payment_unverified': 			$t_action = T_('Payment unverified'); break;
						case 'successful_payment': 			$t_action = T_('Successful payment'); break;
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

		if(isset($load['category']) && in_array($load['category'], ['status', 'paystatus']))
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
			'action'     =>
			[
				'enum' =>
				[
					'tracking',
					'comment',
					'draft',
					'registered',
					'awaiting',
					'confirmed',
					'cancel',
					'expire',
					'preparing',
					'sending',
					'delivered',
					'revert',
					'success',
					'archive',
					'deleted',
					'spam',
					'go_to_bank',
					'pay_error',
					'pay_cancel',
					'awaiting_payment',
					'awaiting_verify_payment',
					'unsuccessful_payment',
					'payment_unverified',
					'successful_payment'
				]
			],
			'category' => ['enum' => ['comment', 'status', 'paystatus', 'tracking']],
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

		$category = null;
		switch ($data['action'])
		{
			case 'tracking':
			case 'comment':
				$category = 'comment';
				break;

			case 'draft':
			case 'registered':
			case 'awaiting':
			case 'confirmed':
			case 'cancel':
			case 'expire':
			case 'preparing':
			case 'sending':
			case 'delivered':
			case 'revert':
			case 'success':
			case 'archive':
			case 'deleted':
			case 'spam':
				$category = 'status';
				break;

			case 'go_to_bank':
			case 'pay_error':
			case 'pay_cancel':
			case 'awaiting_payment':
			case 'awaiting_verify_payment':
			case 'unsuccessful_payment':
			case 'payment_unverified':
			case 'successful_payment':
				$category = 'paystatus';
				break;
		}

		$insert =
		[
			'factor_id'   => $factor_id,
			'action'      => $data['action'],
			'category'    => $category,
			'desc'        => $data['desc'],
			'file'        => $data['file'],
			'user_id'     => \dash\user::id(),
			'datecreated' => date("Y-m-d H:i:s")
		];

		$result = \lib\db\factoraction\insert::new_record($insert);
		\dash\notif::ok(T_("Operation accomplished"));

		// the status of factor : 'enable','disable','draft','order','expire','cancel','pending_pay','pending_verify','pending_prepare','pending_send','sending','deliver','reject','spam','deleted'

		// switch ($data['action'])
		// {
		// 	case 'pay_successfull':
		// 	case 'pay_verified':
		// 		\lib\db\factors\update::record(['type' => 'sale', 'pay' => 1, 'status' => 'pending_prepare', 'datemodified' => date("Y-m-d H:i:s")], $factor_id);
		// 		break;

		// 	case 'pay_error':
		// 	case 'pay_cancel':
		// 	case 'pay_unverified':
		// 		\lib\db\factors\update::record(['type' => 'saleorder', 'pay' => 0, 'status' => 'reject', 'datemodified' => date("Y-m-d H:i:s")], $factor_id);
		// 		break;

		// 	case 'cancel':
		// 		\lib\db\factors\update::record(['type' => 'saleorder', 'status' => 'cancel', 'datemodified' => date("Y-m-d H:i:s")], $factor_id);
		// 		break;

		// 	case 'sending':
		// 		$load_factor = \lib\app\factor\get::inline_get((string) $factor_id);
		// 		if(isset($load_factor['customer']))
		// 		{
		// 			\dash\log::set('order_customerSendingOrder', ['to' => $load_factor['customer'], 'my_id' => $factor_id]);
		// 		}

		// 		\lib\app\factor\edit::status($data['action'], $factor_id);
		// 		break;

		// 	case 'expire':
		// 	case 'order':
		// 	case 'pending_pay':
		// 	case 'pending_verify':
		// 	case 'pending_prepare':
		// 	case 'pending_send':
		// 	case 'deliver':
		// 	case 'reject':
		// 	case 'spam':
		// 		\lib\app\factor\edit::status($data['action'], $factor_id);
		// 		break;

		// 	case 'comment':
		// 	case 'go_to_bank':
		// 	default:
		// 		// nothing
		// 		break;
		// }
		return true;
	}
}
?>