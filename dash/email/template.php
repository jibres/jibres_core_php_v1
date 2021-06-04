<?php
namespace dash\email;

class template
{
	private static $templatePath = core.'/email/design/design1.php';
	private static function globalEmailData()
	{
		$defaultSender =
		[
			'from'      => 'no-reply@jibres.store',
			'fromTitle' => T_('Jibres'),
		];

		return $defaultSender;
	}


	private static function getHTML($args, $dataLines, $dataLinesFooter)
	{
		$html = null;

		ob_start();
		include(self::$templatePath);
		$html = ob_get_contents(); // data is now in here
		ob_end_clean();

		// remove css comments
		$html = str_replace("/*","_COMSTART",$html);
		$html = str_replace("*/","COMEND_",$html);
		$html = preg_replace("/_COMSTART.*?COMEND_/s","",$html);
		// remove newlines
		$html = str_replace(["\n", "\r"], ' ', $html);
		// remove more than one space
		$html = trim(preg_replace('/\s+/', ' ', $html));
		// remove space between tags
		$html = str_replace('> <', '><', $html);
		// remove space after comma
		$html = str_replace(', ', ',', $html);

		return $html;
	}


	public static function verify($_send, $_email, $_name, $_verifyLink)
	{
		// set this template variables
		$dataLines =
		[
			T_("Hey :val!", ['val' => $_name]),
			T_("Thanks for joining Jibres. We got a request to add this email address to your Jibres account. Tap below to go ahead."),
			[
				'element' => 'btn.green',
				'text'    => T_('Verify my Email'),
				'link'    => $_verifyLink,
			],
		];

		$dataLinesFooter = T_("If you did not sign up for Jibres, there is nothing to worry about, just disregard this email.");


		$args = self::globalEmailData();
		$args['from']    = 'verify@jibres.store';
		$args['to']      = $_email;
		$args['toTitle'] = $_name;
		$args['subject'] = '['. T_('Jibres').']'. ' '. T_("Verify Your Email");
		if(\dash\language::current() === 'fa')
		{
			$args['subject'] = '[ '. T_('Jibres').' ]'. ' '. T_("Verify Your Email");
		}

		$args['body']    = self::getHTML($args, $dataLines, $dataLinesFooter);
		// $args['altbody'] = T_('Html is not loaded on this email');

		if($_send)
		{
			return \dash\email\mail::send($args);
		}
		// show preview
		return $args;
	}

}
?>