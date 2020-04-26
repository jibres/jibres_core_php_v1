<?php
namespace content_pardakhtyar\shop\edit;


class controller
{
	public static function routing()
	{
		\dash\permission::access('aCustomerEdit');

		// $id = \dash\request::get('id');

		// if(!$id || !\dash\coding::decode($id))
		// {
		// 	\dash\header::status(404, T_("Id not found"));
		// }

	}
}
?>