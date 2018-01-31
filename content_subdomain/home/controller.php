<?php
namespace content_subdomain\home;

class controller extends \mvc\controller
{
	public function ready()
	{
		if(!\lib\store::id())
		{
			\lib\error::page(T_("Store not found"));
		}
	}
}
?>