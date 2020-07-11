<?php
namespace content_a\setting\place\inventory;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'). ' | '. T_('Inventory'));

		\dash\data::back_text(T_('Back'));
		if(\dash\request::get('type') === 'add')
		{
			\dash\data::back_link(\dash\url::this(). '/place/inventory');
		}
		else
		{
			\dash\data::back_link(\dash\url::this(). '/place');
		}

		\dash\data::action_text(T_('Add new inventory'));
		\dash\data::action_link(\dash\url::current(). '?type=add');


		$all_list = \lib\app\inventory\get::all();
		\dash\data::dataTable($all_list);
	}
}
?>