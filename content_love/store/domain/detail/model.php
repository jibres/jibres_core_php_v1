<?php
namespace content_love\store\domain\detail;


class model
{
	public static function post()
	{
		if(\dash\request::post('send') === 'again')
		{
			$domain = \dash\request::post('domain');
			$result = \lib\app\store\domain::add_domain_arvan($domain);
			return $result;
		}
	}
}
?>