<?php
namespace content_enter\loginas;


class model
{
	public static function post()
	{
		if(\dash\request::post('myActionLogin') === 'login')
		{
			$result = \lib\app\customer\loginas::user(\dash\user::is_init_jibres_user(), \dash\data::logitToSubdomain());

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