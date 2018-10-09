<?php
namespace content_a\thirdparty\add;

class controller
{

	public static function routing()
	{
		$type = \dash\request::get('type');
		switch ($type)
		{
			case 'staff':
				\dash\permission::access('aStaffAdd');
				break;
			case 'customer':
				\dash\permission::access('aCustomerAdd');
				break;
			case 'supplier':
				\dash\permission::access('aSupplierAdd');
				break;

			default:
				if(!\dash\permission::check('aStaffAdd') && !\dash\permission::check('aCustomerAdd') && !\dash\permission::check('aSupplierAdd'))
				{
					\dash\header::status(403, T_("You have not permission to add any thirdparty!"));
				}
				break;
		}
	}
}
?>