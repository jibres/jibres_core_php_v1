<?php
namespace content_crm;

class controller
{

	public static function routing()
	{

		if(\dash\engine\store::inStore())
		{
			\dash\engine\store::gate('crm');
		}
		else
		{
			if(\dash\engine\store::admin_subdomain())
			{
				\dash\redirect::admin_subdomain();
			}
			else
			{
				\dash\redirect::remove_subdomain();
			}

		}


		\dash\redirect::to_login();

		if(\dash\url::module() === 'api' && \dash\permission::has_permission())
		{
			// nothing
		}
		else
		{
			\dash\permission::access('_group_crm');
		}
	}
}
?>