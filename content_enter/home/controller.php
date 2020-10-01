<?php
namespace content_enter\home;


class controller
{
	public static function routing()
	{
		// if the user login redirect to base
		if(\dash\permission::check('EnterByAnother'))
		{
			// the admin can login by another session
			// never redirect to main
		}
		else
		{
			if(\dash\user::login())
			{
				\dash\notif::info(T_("You are login"));
				$url = \dash\url::kingdom();
				\dash\redirect::to($url);
				return;
			}
		}

		// save all param-* | param_* in $_GET | $_POST
		self::save_param();


		\dash\utility\hive::set(true);
	}


	/**
	 * Saves a parameter.
	 * save all param-* in url into the session
	 *
	 */
	public static function save_param()
	{
		// get safe request
		$post = \dash\request::post();
		$get  = \dash\request::get();

		$param = array_merge($get, $post);

		// no param to save
		if(!$param)
		{
			return;
		}

		$save_param = [];

		// check count of input
		$count      = 0;

		foreach ($param as $key => $value)
		{
			$count++;

			// check just string value can save in session
			if(is_string($key) && is_string($value) && mb_strlen($key) < 50 && mb_strlen($value) < 100)
			{
				if(substr($key, 0, 5) === 'param')
				{
					$save_param[substr($key, 6)] = $value;
				}
			}

			if($count > 10)
			{
				break;
			}
		}

		if(!empty($save_param))
		{
			$_SESSION['param'] = $save_param;
		}
	}
}
?>