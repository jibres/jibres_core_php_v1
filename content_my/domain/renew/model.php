<?php
namespace content_my\domain\renew;


class model
{
	public static function post()
	{

		$post =
		[
			'domain' => \dash\request::post('domain'),
			'period' => \dash\request::post('period'),
		];

		if(!\dash\request::post('agree'))
		{
			\dash\notif::warn(T_("Please view the privacy policy and check 'I agree' check box"), 'agree');
			return false;
		}


		$result = \lib\app\nic_domain\renew::renew($post);

		if(\dash\engine\process::status())
		{
			if(\dash\temp::get('need_show_domain_result') && \dash\temp::get('domain_code_url'))
			{
				\dash\redirect::to(\dash\url::this(). '/?resultid='. \dash\temp::get('domain_code_url'));
			}
			else
			{
				\dash\redirect::to(\dash\url::this());
			}
		}
	}
}
?>