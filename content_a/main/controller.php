<?php
namespace content_a\main;


class controller extends \mvc\controller
{
	public function repository()
	{
		if(!\lib\url::subdomain())
		{
			\lib\redirect::to(\lib\url::base());
		}

		if(!\lib\store::id())
		{
			\lib\header::status(404, T_("Store not found"));
		}

		if(!\lib\user::login())
		{
			\lib\redirect::to(\lib\url::base(). '/enter');
			return;
		}

		if(!\lib\userstore::in_store())
		{
			\lib\header::status(403, T_("Your are not in this store"));
		}
	}
}
?>
