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

		$require = [];

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
		\dash\notif::ok(T_("Action successfully added"));

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