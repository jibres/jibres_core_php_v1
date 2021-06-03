<?php
namespace dash\email;

class email_template
{
	public static function globalEmailVariables()
	{
		// set direction
		$direction = \dash\language::dir();
		$language = \dash\language::current();

		$domainLink = 'jibres.store';
		$supportLink = \dash\url::support();
		$from = 'no-reply@jibres.com';
		$fromTitle = T_('Jibres');
	}


	public static function verify($_email, $_name, $_verifyLink)
	{
		self::globalEmailVariables();

		// set this template variables
		$subject = "[Jibres] Verify Your Account";
		$to = $_email;
		$toTitle = $_email;

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
	}
}
?>