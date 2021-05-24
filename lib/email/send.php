<?php
namespace lib\email;


class send
{

	public static function send($_args)
	{
		return \lib\email\sendgrid::send($_args);
	}


	public static function test($_to)
	{
		$url = \dash\url::kingdom(). '/enter/verifyemail/'. 123;
		$body = '';
		$body .= '<p>';
		$body .= T_("To confirm your email in Jibres"). ' ';
		$body .= '<a href="'.$url.'" target="_blank" clicktracking=off >'. T_("Click here"). '</a>';
		$body .= '</p>';

		$email =
		[
			'to'       => $_to,
			'body'     => $body,
			'template' => 'html',
			'subject'  => T_("Verify your mail"),
		];

		$send = \lib\email\send::send($email);

		return $send;
	}
}
?>