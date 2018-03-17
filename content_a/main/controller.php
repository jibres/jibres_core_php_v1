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
			\lib\error::page(T_("Store not found"));
		}

		if(!$this->login())
		{
			\lib\redirect::to(\lib\url::base(). '/enter');
			return;
		}

		if(!\lib\userstore::in_store())
		{
			\lib\error::access(T_("Your are not in this store"));
		}
	}
}
?>
