<?php
namespace content_a\setting\cats;


class model
{
	public static function post()
	{
		$oldcat  = \dash\request::post('oldcat');
		$new_cat = \dash\request::post('name');
		$get_cat = \dash\request::get('edit');

		if(\dash\request::post('type') === 'remove')
		{
			\lib\app\product::remove_old_cat(\dash\request::post('cat'));
			\dash\redirect::pwd();
			return;
		}

		if(!\dash\data::editMode())
		{
			$result = \lib\app\product::add_new_cat($new_cat);
			\dash\redirect::pwd();
			return true;
		}

		if($oldcat != $get_cat)
		{
			\dash\notif::error(T_("Invalid name and old name!"));
			return false;
		}

		if($oldcat == $new_cat)
		{
			\dash\notif::info(T_("No change"));
			return true;
		}

		if(!$new_cat)
		{
			\dash\notif::error(T_("Please fill the category"));
			return true;
		}

		$result = \lib\app\product::update_cat($oldcat, $new_cat);

		if($result)
		{
			\dash\notif::ok(T_("All product by category :old updated to :new", ['old' => $oldcat, 'new' => $new_cat]));
		}
		else
		{
			\dash\notif::error(T_("Can not update you category"));
		}

		\dash\redirect::to(\dash\url::this(). '/cats');
	}
}
?>