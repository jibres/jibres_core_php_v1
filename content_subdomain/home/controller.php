<?php
namespace content_subdomain\home;

class controller extends \mvc\controller
{
	public function ready()
	{
		if(in_array(\dash\url::subdomain(), \lib\app\store::$black_list_slug))
		{
			// no thing
		}
		else
		{
			if(!\lib\store::id())
			{
				\dash\header::status(404, T_("Store not found"));
			}
		}
	}
}
?>