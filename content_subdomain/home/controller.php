<?php
namespace content_subdomain\home;

class controller extends \mvc\controller
{
	public function ready()
	{
		if(in_array(\lib\url::subdomain(), \lib\app\store::$black_list_slug))
		{
			// no thing
		}
		else
		{
			if(!\lib\store::id())
			{
				\lib\error::page(T_("Store not found"));
			}
		}
	}
}
?>