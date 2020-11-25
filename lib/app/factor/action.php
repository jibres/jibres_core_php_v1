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
						case 'notes': 						$t_action = T_('Notes'); break;
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


	/**
	 * Quick add new action
	 *
	 * @param      <type>  $_action     The action
	 * @param      <type>  $_factor_id  The factor identifier
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function set($_action, $_factor_id)
	{
		$args = [];
		$args['action'] = $_action;
		return self::add($args, $_factor_id);
	}


	/**
	 * Remove an action
	 *
	 * @param      <type>   $_id         The identifier
	 * @param      <type>   $_factor_id  The factor identifier
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
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
					'notes',
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
					'complete',
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
			'category' => ['enum' => ['notes', 'status', 'paystatus', 'tracking']],
			'desc'       => 'desc',
			'file'       => 'desc',
		];

		$require = ['action'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if($data['action'] === 'notes')
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

		$load_factor = \lib\app\factor\get::inline_get((string) $factor_id);
		if(!$load_factor)
		{
			\dash\notif::error(T_("Order not found!"));
			return false;
		}

		$check_count_action = \lib\db\factoraction\get::count_by_factor_id($factor_id);
		if(floatval($check_count_action) > 100)
		{
			\dash\notif::error(T_("Maximum capacity of order action is full!"));
			return false;
		}


		$category = null;
		switch ($data['action'])
		{
			case 'tracking':
			case 'notes':
				$category = 'notes';
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
				if(isset($load_factor['status']) && $load_factor['status'] === $data['action'])
				{
					// \dash\notif::info(T_("Current status of this order is :status", ['status' => T_(ucfirst($data['action']))]));
					return true;
				}
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

				if(isset($load_factor['paystatus']) && $load_factor['paystatus'] === $data['action'])
				{
					\dash\notif::info(T_("No change in order payment status"));
					return true;
				}
				break;
		}

		$insert_new_record = true;

		if($data['action'] === 'tracking')
		{
			$data['desc'] = \dash\validate::bigint($data['desc']);

			$check_exist_tracking = \lib\db\factoraction\get::by_action_factor_id($factor_id, 'tracking');
			if(isset($check_exist_tracking['id']))
			{
				$insert_new_record = false;
				\lib\db\factoraction\update::record(['desc' => $data['desc'], 'datemodified' => date("Y-m-d H:i:s")], $check_exist_tracking['id']);
			}

			// if need to send alert to customer
			if(isset($load_factor['customer']))
			{
				\dash\log::set('order_customerTrackingNumber', ['to' => $load_factor['customer'], 'my_id' => $factor_id, 'my_tackingnumber' => $data['desc']]);
			}

			\dash\notif::ok(T_("Operation accomplished"));

		}
		if($insert_new_record)
		{
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

			\lib\db\factoraction\insert::new_record($insert);
		}



		// \dash\notif::ok(T_("Operation accomplished"));

		$update_factor = [];

		switch ($data['action'])
		{
			case 'tracking':
			case 'notes':
				// nothing
				break;

			case 'cancel':
				$update_factor['type']      = 'saleorder';
				$update_factor['status']    = 'cancel';
				break;

			case 'draft':
			case 'registered':
			case 'awaiting':
			case 'confirmed':
			case 'expire':
			case 'preparing':
			case 'delivered':
			case 'revert':
			case 'success':
			case 'archive':
			case 'deleted':
			case 'spam':
				$update_factor['status']    = $data['action'];

				break;

			case 'sending':
				$update_factor['status']    = 'sending';
				// if need to send alert to customer
				if(isset($load_factor['customer']))
				{
					\dash\log::set('order_customerSendingOrder', ['to' => $load_factor['customer'], 'my_id' => $factor_id]);
				}

				break;

			case 'successful_payment':
				$update_factor['type']      = 'sale';
				$update_factor['status']    = 'preparing';
				$update_factor['paystatus'] = 'successful_payment';
				break;

			case 'pay_error':
			case 'pay_cancel':
			case 'go_to_bank':
				break;

			case 'awaiting_payment':
			case 'awaiting_verify_payment':
			case 'unsuccessful_payment':
			case 'payment_unverified':
				$update_factor['paystatus'] = $data['action'];
				break;
		}

		if(!empty($update_factor))
		{
			$update_factor['datemodified'] = date("Y-m-d H:i:s");
			\lib\db\factors\update::record($update_factor, $factor_id);
		}


		return true;
	}
}
?>