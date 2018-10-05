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
		$post['status']  = \dash\request::post('status');

		if(\dash\data::dataRow())
		{
			\lib\app\inventory::edit($post, \dash\request::get('inventory'));
			if(\dash\engine\process::status())
			{
				\dash\notif::ok(T_("Inventory successfully updated"));
				\dash\redirect::to(\dash\url::this(). '/inventory');
			}
		}
		else
		{
			\lib\app\inventory::add($post);
			if(\dash\engine\process::status())
			{
				\dash\notif::ok(T_("Inventory successfully added"));
				\dash\redirect::pwd();
			}
		}

	}
}
?>