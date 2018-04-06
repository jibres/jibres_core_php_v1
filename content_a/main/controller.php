<?php
namespace content_a\main;


class controller extends \mvc\controller
{
	public function repository()
	{
		if(!\dash\url::subdomain())
		{
			\dash\redirect::to(\dash\url::base());
		}

		if(!\lib\store::id())
		{
			\dash\header::status(404, T_("Store not found"));
		}

		if(!\dash\user::login())
		{
			\dash\redirect::to(\dash\url::base(). '/enter');
			return;
		}

		if(!\lib\userstore::in_store())
		{
			\dash\header::status(403, T_("Your are not in this store"));
		}
	}
}
?>
