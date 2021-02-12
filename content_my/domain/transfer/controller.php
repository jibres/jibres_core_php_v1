<?php
namespace content_my\domain\transfer;


class controller
{
	public static function routing()
	{


		$domain = \dash\request::get('domain');
		$domain = urldecode($domain);
		if($domain)
		{
			if(\dash\validate::domain($domain))
			{
				if(!\dash\validate::ir_domain($domain, false))
				{
					\dash\data::internationalDomain(true);
				}

				\dash\data::myDomain($domain);
			}
		}

	}
}
?>