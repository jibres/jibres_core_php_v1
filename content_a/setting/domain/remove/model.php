<?php
namespace content_a\setting\domain\remove;


class model
{
	public static function post()
	{

		if(\dash\request::post('master') === 'master')
		{
			\lib\app\business_domain\edit::set_my_master(\dash\request::post('masterdomain'));
			\dash\redirect::pwd();
		}


		if(\dash\request::post('removedomain') === 'removedomain')
		{
			$result = \lib\app\business_domain\remove::remove_by_user(\dash\data::domainID());
			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that());
			}
		}
	}
}
?>