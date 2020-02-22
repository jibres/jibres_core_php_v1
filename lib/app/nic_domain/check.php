<?php
namespace lib\app\nic_domain;


class check
{
	public static function syntax($_domain)
	{
		if(!$_domain || !is_string($_domain))
		{
			// \dash\notif::error(T_("Please fill domain"), 'domain');
			return false;
		}

		if(strpos($_domain, '.') === false)
		{
			return false;
		}
		else
		{
			if(!preg_match("/^[\w\d]+\.(ir)$/", $_domain))
			{
				// return false;
			}
		}

		return true;

	}

	public static function check($_domain)
	{
		if(!\lib\app\nic_domain\check::syntax($_domain))
		{
			return false;
		}

		$result = \lib\nic\exec\domain_check::check($_domain);

		return $result;

	}


	public static function variable()
	{
		$autorenew = \dash\app::request('autorenew') ? 1 : null;


		$args              = [];
		$args['autorenew'] = $autorenew;
		return $args;
	}
}
?>