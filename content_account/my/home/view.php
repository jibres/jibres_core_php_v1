<?php
namespace content_account\my\home;


class view
{

	public static function config()
	{
		\dash\face::title(T_('Personal info'));

		// back
		\dash\data::back_text(T_('Account'));
		\dash\data::back_link(\dash\url::here());


		\dash\data::myMasterEmail(\dash\user::primary_email());

		\dash\data::isLtr(\dash\language::dir() === 'ltr' ? true : false);

		if(\dash\data::dataRow_permission())
		{
			$myPermName = \dash\data::dataRow_permission();
			$perm_list = \dash\permission::groups();
			if(isset($perm_list[$myPermName]['title']))
			{
				\dash\data::permName(T_($perm_list[$myPermName]['title']));
			}
			else
			{
				\dash\data::permName(T_(ucfirst($myPermName)));
			}
		}
	}


}
?>
