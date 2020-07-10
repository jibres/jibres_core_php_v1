<?php
namespace lib\app\factor;


class action
{
	public static function get_by_factor_id($_id)
	{
		$result = \lib\db\factoraction\get::all_by_factor_id($_id);
		if($result && is_array($result))
		{
			$result = array_map(['\\dash\\app', 'fix_avatar'], $result);
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
			'user_id'     => \dash\user::id(),
			'datecreated' => date("Y-m-d H:i:s")
		];

		$result = \lib\db\factoraction\insert::new_record($insert);
		\dash\notif::ok(T_("Action successfully added"));
		return true;
	}
}
?>