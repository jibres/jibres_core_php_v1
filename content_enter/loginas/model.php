<?php
namespace content_enter\loginas;


class model
{
	public static function post()
	{
		if(\dash\request::post('myActionLogin') === 'login')
		{
			$result = \lib\app\customer\loginas::user(\dash\user::jibres_user(), \dash\data::logitToSubdomain());

			unset($_SESSION['login_as'][\dash\data::logitToSubdomain()]);

			if($result)
			{
				$referer = \dash\data::logiToReferer();

				if(!$referer)
				{
					$referer = \dash\url::protocol(). '://'. \dash\data::logitToSubdomain(). '.'. \dash\url::domain(). '/'.\dash\url::lang();
				}

				\dash\redirect::to($referer);
			}
			else
			{
				\dash\redirect::to(\dash\url::kingdom());
			}
		}
		else
		{
			\dash\redirect::to(\dash\url::kingdom());
		}
	}
}
?>