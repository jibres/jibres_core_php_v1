<?php
namespace content_b1\business\verification;


class model
{

	public static function post()
	{
		$result             = [];

		if(\dash\request::input_body('mobile'))
		{
			$result = \content_enter\callback\model::check_sms_receive(\dash\request::input_body('mobile'), \dash\request::input_body('verification_code'));

		}

		\content_b1\tools::say($result);
	}

}
?>