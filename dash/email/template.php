<?php
namespace dash\email;

class template
{
	private static function globalEmailData()
	{
		$defaultSender =
		[
			'from'      => 'no-reply@jibres.com',
			'fromTitle' => T_('Jibres'),
		];

		return $defaultSender;
	}


	public static function verify($_send, $_email, $_name, $_verifyLink)
	{
		// set this template variables
		$body =
		[
			T_("Hey :val!", ['val' => $_name]),
			T_("Thanks for joining Jibres. We got a request to add this email address to your Jibres account. Tap below to go ahead."),
			[
				'element' => 'btn.green',
				'text'    => T_('Verify my Email'),
				'link'    => $_verifyLink,
			],
		];

		$footer = "If you did not sign up for Jibres, there is nothing to worry about, just disregard this email.";


		$args = self::globalEmailData();
		$args['to']      = $_email;
		$args['toTitle'] = $_name;
		$args['subject'] = T_("[Jibres] Verify Your Account");
		$args['body']    = '123';
		$args['altbody'] = 'Html is not loaded on this email';

		if($_send)
		{
			return \dash\email\mail::sendPHPMailer($args);
		}
		// show preview
		return $args;
	}

}
?>