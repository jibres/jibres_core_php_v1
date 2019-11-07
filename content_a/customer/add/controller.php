<?php
namespace content_a\customer\add;

class controller
{

	public static function routing()
	{
		$type = \dash\request::get('type');
		switch ($type)
		{
			case 'staff':
				\dash\permission::access('staffAdd');
				break;
			case 'customer':
				\dash\permission::access('customerAdd');
				break;
			case 'supplier':
				\dash\permission::access('supplierAdd');
				break;

			default:
				if(!\dash\permission::check('staffAdd') && !\dash\permission::check('customerAdd') && !\dash\permission::check('supplierAdd'))
				{
					\dash\header::status(403, T_("You have not permission to add any customer!"));
				}
				break;
		}
	}
}
?>