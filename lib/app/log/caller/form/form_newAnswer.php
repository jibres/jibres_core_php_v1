<?php
namespace lib\app\log\caller\form;



class form_newAnswer
{

	public static function site($_args = [])
	{
		$result              = [];

		$result['title']     = T_("New answer");

		$result['icon']      = 'list';
		$result['cat']       = T_("Forms");
		$result['iconClass'] = 'fc-blue';
		$result['txt']       = self::get_msg($_args, false);

		return $result;

	}



	public static function get_msg($_args = [], $_link = true)
	{
		$msg         = '';
		$my_form_id       = isset($_args['data']['my_form_id']) ? $_args['data']['my_form_id'] : null;
		$my_answer_id   = isset($_args['data']['my_answer_id']) ? \dash\fit::number($_args['data']['my_answer_id']) : null;

		//  the link is
		// a/form/answer/detail?id=$my_form_id&aid=$my_answer_id
		$msg .= "  ". T_("A new response to the form was registered");

		return $msg;
	}


	public static function expire()
	{
		// 7 days
		return date("Y-m-d H:i:s", time() + (60*60*24*3));
	}


	public static function is_notif()
	{
		return true;
	}


	public static function send_to()
	{
		return ['admin', 'orderNotificationReceiver'];
	}



	public static function telegram()
	{
		return true;
	}


	public static function sms()
	{
		return false;
	}


	public static function email()
	{
		return true;
	}


	public static function email_text($_args, $_email)
	{
		$title = self::get_msg($_args);

		$email =
		[
			'email'   => $_email,
			'body'    => $title,
			'subject' => T_("New answer to form"),
		];

		return json_encode($email, JSON_UNESCAPED_UNICODE);
	}



	public static function sms_text($_args, $_mobile)
	{
		$title = self::get_msg($_args);

		$sms =
		[
			'mobile' => $_mobile,
			'text'   => $title,
			'meta'   =>
			[
				'header' => false,
				'footer' => false
			]
		];

		return json_encode($sms, JSON_UNESCAPED_UNICODE);
	}


	public static function telegram_text($_args, $_chat_id)
	{
		$tg_msg = '';
		$tg_msg .= "#New_Order  ";

		$tg_msg .= " 🛒 \n";

		$tg_msg .= self::get_msg($_args);

		$tg                 = [];
		$tg['chat_id']      = $_chat_id;
		$tg['text']         = $tg_msg;

		return $tg;

	}
}
?>