<?php
namespace content_a\setting\units;


class model
{
	public static function post()
	{
		$old_unit = \dash\request::post('oldunit');
		$new_unit = \dash\request::post('unit');
		$get_unit = \dash\request::get('edit');

		// remove unitegory
		if(\dash\request::post('type') === 'remove')
		{
			\lib\app\product\unit::remove(\dash\request::post('removeunit'));
			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/units');
			}
			return;
		}

		// add new unitegory
		if(!\dash\data::editMode())
		{
			$result = \lib\app\product\unit::add($new_unit);
			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/units');
			}
			return;
		}

		// update unitegory
		if($old_unit != $get_unit)
		{
			\dash\notif::error(T_("Invalid name and old name!"));
			return false;
		}

		$result = \lib\app\product\unit::update($old_unit, $new_unit);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this(). '/units');
		}

	}
}
?>