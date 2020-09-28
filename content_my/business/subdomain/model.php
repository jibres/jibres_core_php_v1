<?php
namespace content_my\business\subdomain;


class model
{
	public static function post()
	{
		\lib\app\store\subdomain::$subdomain_field_name = 'sd';
		\lib\app\store\subdomain::$debug = true;

		$subdomain       = \dash\validate::string_50(\dash\request::post('sd'));
		if(!\lib\app\store\subdomain::validate_exist($subdomain) || !\dash\engine\process::status())
		{
			return false;
		}

		\dash\redirect::to(\dash\url::this().'/creating?'. \dash\request::fix_get(['subdomain' => $subdomain, 'st3' => time()]));
	}
}
?>
