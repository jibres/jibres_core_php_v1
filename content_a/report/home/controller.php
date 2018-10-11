<?php
namespace content_a\report\home;


class controller
{
	public static function routing()
	{
		\dash\permission::access('aReportView');

		$redirect_enter = false;
		if(\dash\user::detail('logintime'))
		{
			if((time() - intval(\dash\user::detail('logintime')) ) > (60*10))
			{
				if(!isset($_SESSION['try_load_report']))
				{
					$_SESSION['try_load_report'] = 1;
					\dash\notif::warn(T_("You must login again to view this page"));
					\dash\header::status(403, ' ');
				}
				else
				{
					$redirect_enter = true;
				}
			}
			else
			{
				$redirect_enter = false;
			}
		}
		else
		{
			$redirect_enter = true;
		}

		if($redirect_enter)
		{
			\dash\redirect::to(\dash\url::kingdom(). '/logout?mobile='. \dash\user::detail('mobile'). '&referer='. \dash\url::pwd());
		}
	}
}
?>
