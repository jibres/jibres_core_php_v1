<?php
namespace content_a\setting\inventory;


class model
{

	public static function post()
	{
		$post            = [];
		$post['name']    = \dash\request::post('name');
		$post['default'] = \dash\request::post('inventorydefault');
		$post['online']  = \dash\request::post('inventoryonline');
		$post['sale']    = \dash\request::post('inventorysale');

		\lib\app\inventory::add($post);

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Inventory successfully added"));
			\dash\redirect::pwd();
		}
	}
}
?>