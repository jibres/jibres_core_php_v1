<?php
namespace content_hook\ig;

class controller
{
	/**
	 * allow telegram to access to this location
	 * to send response to our server
	 * @return [type] [description]
	 */
	public static function routing()
	{
		$code  = \dash\request::get('code');
		$state = \dash\request::get('state');

		$redirect_url = \lib\app\instagram\check::login_callback($code, $state);

		if($redirect_url)
		{
			\dash\redirect::to($redirect_url);
			return;
		}

		// log access to this url
		\dash\log::set('InstagramAPIInvalidCallbackDetail');
		\dash\header::status(404);
	}
}
?>