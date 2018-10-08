<?php
namespace content_a\setting\cats;


class model
{
	public static function post()
	{
		$old_cat = \dash\request::post('oldcat');
		$new_cat = \dash\request::post('cat');
		$get_cat = \dash\request::get('edit');

		// remove category
		if(\dash\request::post('type') === 'remove')
		{
			\lib\app\product::remove_old_cat(\dash\request::post('removecat'));
			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/cats');
			}
			return;
		}

		// add new category
		if(!\dash\data::editMode())
		{
			$result = \lib\app\product::add_new_cat($new_cat);
			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/cats');
			}
			return;
		}

		// update category
		if($old_cat != $get_cat)
		{
			\dash\notif::error(T_("Invalid name and old name!"));
			return false;
		}

		$result = \lib\app\product::update_cat($old_cat, $new_cat);

		if(\dash\engine\process::status())
		{

			\dash\redirect::to(\dash\url::this(). '/cats');
		}
		else
		{
			\dash\notif::error(T_("Can not update you category"));
		}

	}
}
?>