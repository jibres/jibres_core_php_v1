<?php
namespace content_domain\setting;


class model
{
	public static function post()
	{
		if(\dash\request::post('myaction') == 'autorenew')
		{
			$autorenew = \dash\request::post('op') == 'set' ? 1 : 0;
			$result = \lib\app\nic_domain\edit::edit(['autorenew' => $autorenew], \dash\data::domainDetail_id());

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}

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
			\dash\notif::warn(T_("Please view the privacy policy and check 'I agree' check box"), 'agree');
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