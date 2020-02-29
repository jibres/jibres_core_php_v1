<?php
namespace content_my\domain\transfer;


class model
{
	public static function post()
	{
		$post =
		[
			'domain'    => \dash\request::post('domain'),
			'nic_id'    => \dash\request::post('irnicid'),
			'irnic_new' => \dash\request::post('irnicid-new'),
			'pin'       => \dash\request::post('pin'),
		];

		if(!\dash\request::post('agree'))
		{
			\dash\notif::warn(T_("Please view the privacy policy and check 'I agree' check box"), 'agree');
			return false;
		}


		$result = \lib\app\nic_domain\transfer::transfer($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this());
		}
	}
}
?>