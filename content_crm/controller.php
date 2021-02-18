<?php
namespace content_crm;

class controller
{

	public static function routing()
	{

		if(\dash\engine\store::inStore())
		{
			if(!\dash\url::store())
			{
				\dash\redirect::to(\dash\url::kingdom());
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