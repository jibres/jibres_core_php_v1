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
		if(\dash\request::get('run'))
		{
			$url = \lib\api\instagram\api::getLoginUrl();
			var_dump($url);
		}
		var_dump($_REQUEST);
		exit;

		$myhook = \dash\social\telegram\tg::setting('hookFolder');

		if(\dash\url::child() === $myhook)
		{
			// \dash\temp::set('clesnse_not_end_with_error', true);

			// fire telegram api
			\dash\social\telegram\tg::fire();

			// bobooom :)
			\dash\code::boom();
		}

		// log access to this url
		\dash\log::set('tgUnauthorizedAccess');
		\dash\header::status(404);
	}
}
?>