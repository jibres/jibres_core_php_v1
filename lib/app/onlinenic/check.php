<?php
namespace lib\app\onlinenic;


class check
{

	public static function check($_domain, $_type = null)
	{
		$domain = \dash\validate::domain($_domain);

		$session_saved = \dash\session::get('onlinenic_check_domain_'. $_type);
		if(isset($session_saved['domain']) && $session_saved['domain'] === $domain && isset($session_saved['result']))
		{
			$result =  $session_saved['result'];
		}
		else
		{

			$result = \lib\onlinenic\api::check_domain($domain, $_type);

			if(!isset($result['data']))
			{
				return false;
			}

			$session_saved           = [];
			$session_saved['domain'] = $domain;
			$session_saved['result'] = $result;

			\dash\session::set('onlinenic_check_domain_'. $_type, $session_saved);
		}


		$result = $result['data'];

		if(!is_array($result))
		{
			\dash\log::oops('response');
			return false;
		}

		if(array_key_exists('avail', $result))
		{
			$result['available'] = $result['avail'];
		}

		return $result;
	}
}
?>