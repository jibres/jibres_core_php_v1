<?php
namespace content_sudo\check;


class view
{
	public static function config()
	{
		\dash\face::title("Check");

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		$list =
		[
			'business_duplicate_setting_record' => "Find Business Duplicate setting records",
		];

		\dash\data::sudoCheckList($list);

		$check = \dash\request::get('check');
		$check = \dash\validate::string_100($check, false);
		if($check && isset($list[$check]))
		{
			$namespace = '\\content_sudo\\check\\part\\';
			if(is_callable([$namespace. $check, $check]))
			{
				call_user_func([$namespace. $check, $check]);
			}
		}

	}


}
?>