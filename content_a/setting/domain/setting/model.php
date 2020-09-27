<?php
namespace content_a\setting\domain\setting;

class model
{
	public static function post()
	{

		if(\dash\request::post('master') === 'master')
		{
			\lib\app\business_domain\edit::set_my_master(\dash\request::post('masterdomain'));
		}

		if(\dash\request::post('redirect') === 'redirect')
		{
			$post =
			[
				'redirect_all_domain_to_master'    => \dash\request::post('redirect_all_domain_to_master'),
			];

			\lib\app\store\edit::selfedit($post);

			if(\dash\engine\process::status())
			{
				\lib\store::refresh();
				\dash\redirect::pwd();
			}

		}

	}
}
?>