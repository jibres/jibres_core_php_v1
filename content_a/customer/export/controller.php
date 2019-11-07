<?php
namespace content_a\customer\export;

class controller
{

	public static function routing()
	{
		$type = \dash\request::get('type');
		switch ($type)
		{
			case 'staff':
				\dash\permission::access('staffExport');
				break;
			case 'customer':
				\dash\permission::access('customerExport');
				break;
			case 'supplier':
				\dash\permission::access('supplierExport');
				break;

			default:
				if(!\dash\permission::check('staffExport') && !\dash\permission::check('customerExport') && !\dash\permission::check('supplierExport'))
				{
					\dash\header::status(403, T_("You have not permission to add any customer!"));
				}
				break;
		}
	}
}
?>