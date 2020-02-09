<?php
namespace content_domain\setting;


class model
{
	public static function post()
	{
		if(\dash\request::post('myaction') == 'lock')
		{
			$result = \lib\app\nic_domain\lock::lock(\dash\data::myDomain());

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}
		elseif(\dash\request::post('myaction') == 'unlock')
		{
			$result = \lib\app\nic_domain\lock::unlock(\dash\data::myDomain());

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}

		$post =
		[
			'domain' => \dash\data::myDomain(),
			'period' => \dash\request::post('period'),
		];

		if(!\dash\request::post('agree'))
		{
			\dash\notif::warn(T_("Please view the privacy polici and check 'I agree' check box"), 'agree');
			return false;
		}

		$result = \lib\app\nic_domain\renew::renew($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::here());
		}
	}
}
?>