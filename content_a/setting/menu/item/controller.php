<?php
namespace content_a\setting\menu\item;


class controller
{
	public static function routing()
	{
		$menu_detail = \lib\app\menu\get::get_master(\dash\request::get('id'));

		if(!$menu_detail)
		{
			\dash\header::status(404, T_("Invalid id"));
		}

		\dash\data::menuDetail($menu_detail);

		$child_id     = null;
		$editMode     = false;
		$addChildMode = false;

		if(\dash\request::get('edit'))
		{
			$child_id = \dash\request::get('edit');
			$editMode = true;
		}
		elseif(\dash\request::get('parent'))
		{
			$child_id = \dash\request::get('parent');
			$addChildMode = true;
		}

		if($child_id)
		{
			$load_one_child = \lib\app\menu\get::one_child(\dash\request::get('id'), $child_id);
			if(!$load_one_child)
			{
				\dash\header::status(404, T_("Invalid sub menu id"));
			}

			if($editMode)
			{
				\dash\data::dataRow($load_one_child);
				\dash\data::editMode($editMode);
			}

			if($addChildMode)
			{
				\dash\data::dataRowParent($load_one_child);
				\dash\data::addChildMode($addChildMode);
			}
		}
	}
}
?>