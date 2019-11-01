<?php
namespace content_store\subdomain;


class model
{
	public static function post()
	{
		\lib\app\store\subdomain::$subdomain_field_name = 'sd';

		$subdomain       = \dash\request::post('sd');
		if(!\lib\app\store\subdomain::validate_exist($subdomain) || !\dash\engine\process::status())
		{
			return false;
		}

		\dash\session::set('createNewStore_subdomain', $subdomain, 'CreateNewStore');

		\dash\redirect::to(\dash\url::here().'/creating');
	}
}
?>
