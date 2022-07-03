<?php
namespace content_love\domain\setting;


class model
{
	public static function post()
	{
		if(\dash\request::post('removeHolder') === 'removeHolder')
		{
			if(\dash\data::domainDetail_registrar() === 'onlinenic')
			{
				$update =
				[
					'holder' => null,
					'admin'  => null,
					'tech'   => null,
					'bill'   => null,
					'reseller'   => null,

				];

				$result = \lib\app\nic_domain\edit::edit_holder($update, \dash\data::domainDetail_id(), true);

			}
			else
			{
				\dash\notif::error(T_("This action work only in onlinenic domains"));
				return false;
			}

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}

		}

		 if(\dash\request::post('whois') == 'fetch' && \dash\permission::supervisor())
	    {
	      \lib\app\domains\owner::fetch_domain_owner(\dash\data::domainDetail_name());
	      \dash\notif::ok(T_("Domain owner fetched"));
	      \dash\redirect::pwd();
	      return;
	    }
		if(\dash\request::post('clean') == 'lastfetch' && \dash\permission::supervisor())
		{
			$result = \lib\app\nic_domain\edit::remove_last_fetch(\dash\data::domainDetail_id());
			\dash\notif::ok(T_("Last fetch removed"));
			\dash\redirect::pwd();
			return;
		}


		if(\dash\request::post('myaction') == 'autorenew')
		{
			$autorenew = \dash\request::post('op') == 'set' ? 1 : 0;
			$result = \lib\app\nic_domain\edit::edit(['autorenew' => $autorenew], \dash\data::domainDetail_id(), true);
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}

		if(\dash\request::post('myaction') == 'verify')
		{
			$verify = \dash\request::post('op') == 'set' ? 1 : 0;
			$result = \lib\app\nic_domain\edit::edit(['verify' => $verify], \dash\data::domainDetail_id(), true);
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}

		if(\dash\request::post('myaction') == 'status')
		{
			$status = \dash\request::post('status');
			$result = \lib\app\nic_domain\edit::edit(['status' => $status], \dash\data::domainDetail_id(), true);
			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}

		\dash\notif::error("This action needs to work!");

	}
}
?>