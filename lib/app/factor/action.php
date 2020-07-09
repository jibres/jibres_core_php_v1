<?php
namespace lib\app\factor;


class action
{

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
}
?>