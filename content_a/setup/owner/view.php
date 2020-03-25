<?php
namespace content_a\setup\owner;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Complete your profile'));
		$user_data = \dash\user::detail();
		if(isset($user_data['birthday']) && $user_data['birthday'])
		{
			$user_data['jalali_birthday'] = \dash\utility\jdate::date("Y/m/d", $user_data['birthday'], false);
		}
		\dash\data::dataRow($user_data);

	}
}
?>
