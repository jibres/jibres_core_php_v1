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
				$domainLink = 'jibres.store';
				$supportLink = \dash\url::support();
				$from = 'no-reply@jibres.com';
				$fromTitle = T_('Jibres');
				$to = 'you@email.com';
				$subject = "[Jibres] Verify Your Account";
				$body =
				[
					T_("Hey :val!", ['val' => 'mradib']),
					T_("Thanks for joining Jibres. We got a request to add this email address to your Jibres account. Tap below to go ahead."),
					[
						'element' => 'btn.green',
						'text'    => T_('Verify my Email'),
						'link'    => \dash\url::kingdom().'/123',
					],
				];
				$footer = "If you did not sign up for Jibres, there is nothing to worry about, just disregard this email.";

				break;

			default:
				break;
		}

		// require file and show it
		require_once $templatePath;
		\dash\code::boom();
	}

}
?>
