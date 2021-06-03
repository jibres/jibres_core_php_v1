<?php
namespace content_love\email;


class controller
{
	public static function routing()
	{
		if(\dash\url::child())
		{
			self::loadTemplate(\dash\url::child());
		}
	}


	private static function loadTemplate($_name)
	{
		$templatePath = core. 'email/'.$_name. '.php';

		if(!is_file($templatePath))
		{
			return null;
		}

		// set direction
		$direction = \dash\language::dir();
		$language = \dash\language::current();

		switch ($_name)
		{
			case 'verify':
				$from = 'no-reply@jibres.com';
				$fromTitle = T_('Jibres');
				$to = 'you@email.com';
				$subject = "[Jibres] Verify Your Account";
				// code...
				break;

			default:
				// code...
				break;
		}

		// require file and show it
		require_once $templatePath;
		\dash\code::boom();
	}

}
?>
