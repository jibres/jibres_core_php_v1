<?php
namespace lib\app\sms;

class check
{
	public static function variable($_args)
	{
		$condition =
		[
			'mobile'   => 'mobile',
			'message'  => 'desc',
			'sender'   => ['enum' => ['system', 'admin', 'customer']],
			'provider' => 'string_50',
			'mode'     => ['enum' => ['sms','call','tts', 'verification', 'receive', 'lookup']],
			'type'     => ['enum' => ['signup','login','twostep','twostepset','twostepunset','deleteaccount','recovermobile','callback_signup','changepassword','notif','other']],
			'status'   => ['enum' => ['register','pending','sending','expired','moneylow','unknown','send','sended','delivered','queue','failed','undelivered','cancel','block','other']],
			'sender'   => ['enum' => ['system','admin','customer']],
			'template' => 'string_100',
			'token'    => 'string_100',
			'token2'   => 'string_100',
			'token3'   => 'string_100',
            'resendfrom' => 'id',
			'meta'     => 'json'
		];



		$require = ['mobile'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if($data['message'])
		{
			$data['len']      = mb_strlen($data['message']);
			// $data['smscount'] = ceil($data['len'] / 70);
			// $data['smscount'] = ceil($data['len'] / send::lengthOfOneSMSBaseOnContent($data['message']));
			$data['smscount'] = send::calculateSMSCount($data['message']);
		}

		return $data;
	}

}
?>