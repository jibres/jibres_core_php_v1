<?php
namespace content_a\main;


class controller extends \mvc\controller
{
	public function repository()
	{
		if(!SubDomain)
		{
			$this->redirector($this->url('base'))->redirect();
		}

		if(!\lib\store::id())
		{
			\lib\error::page(T_("Store not found"));
		}

		if(!$this->login())
		{
			$this->redirector($this->url('base'). '/enter')->redirect();
			return;
		}

		if(!\lib\userstore::in_store())
		{
			\lib\error::access(T_("Your are not in this store"));
		}
	}
}
?>
