<?php
namespace content_crm\transactions;

class controller
{

	public static function routing()
	{

		if(\dash\url::child() === 'all')
		{
			\dash\open::get();
		}
	}
}
?>