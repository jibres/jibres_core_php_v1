<?php
namespace content_crm;

class controller
{

	public static function routing()
	{

		\dash\redirect::to_login();

		if(\dash\url::module() === 'api' && \dash\permission::has_permission())
		{
			// nothing
		}
		else
		{
			\dash\permission::access('contentCrm');
		}
	}
}
?>