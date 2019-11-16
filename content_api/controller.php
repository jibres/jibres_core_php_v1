<?php
namespace content_api;


class controller
{
	public static function routing()
	{
		// $x   = [];
		// $x[] = sha1("reza");
		// $x[] = md5("reza");
		// $x[] = hash('sha256', 'reza');
		// $x[] = hash('ripemd160', 'reza');
		// $x[] = bin2hex(random_bytes(100));
		// $x[] = password_hash(':~-:~reza:,.[]', PASSWORD_BCRYPT, ['cost' => 7]);
		// $x[] = uniqid("reza");
		// j($x);exit();

		$module = \dash\url::module();

		if(!$module || ($module === 'doc' && !\dash\url::child()) || (in_array($module, ['v2'])))
		{
			// nothing
		}
		else
		{
			\dash\header::status(404, T_("Invalid url"));
		}

		if($module === 'v2')
		{
			\content_api\v2::master_check();
		}
		else
		{
			\dash\header::status(404);
		}

		// save api log
		\dash\app\apilog::start();
	}
}
?>