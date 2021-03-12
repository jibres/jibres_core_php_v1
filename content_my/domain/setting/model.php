<?php
namespace content_my\domain\setting;


class model
{
	public static function post()
	{
		if(\dash\request::post('clean') == 'lastfetch' && \dash\permission::supervisor())
		{
			$result = \lib\app\nic_domain\edit::remove_last_fetch(\dash\data::domainDetail_id());
			\dash\notif::ok(T_("Last fetch removed"));
			\dash\redirect::pwd();
			return;
		}


		if(\dash\request::post('runaction_autorenew'))
		{
			$autorenew = \dash\request::post('autorenew');
			if($autorenew === 'enable')
			{
				$autorenew = 1;
			}
			elseif($autorenew === 'disable')
			{
				$autorenew = 0;
			}
			else
			{
				$autorenew = null;
			}

			$result = \lib\app\nic_domain\edit::edit(['autorenew' => $autorenew], \dash\data::domainDetail_id());

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}

		if(\dash\request::post('status') == 'remove')
		{
			$result = \lib\app\nic_domain\remove::remove(\dash\data::domainDetail_id());

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this());
			}
			return;
		}
	}
}
?>