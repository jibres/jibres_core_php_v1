<?php
namespace content_a\product\units;


class model
{
	public static function post()
	{
		$old_unit = \dash\request::post('oldunit');
		$new_unit = \dash\request::post('unit');
		$get_unit = \dash\request::get('edit');

		// remove unit
		if(\dash\request::post('type') === 'remove')
		{
			\lib\app\product\unit::remove(\dash\request::post('removeunit'));
			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/units');
			}
			return;
		}

		$args                = [];
		$args['decimal']     = \dash\request::post('decimal');
		$args['unitdefault'] = \dash\request::post('unitdefault');
		$args['maxsale']     = \dash\request::post('maxsale');
		$args['title']       = \dash\request::post('unit');

		// add new unit
		if(!\dash\data::editMode())
		{
			$result = \lib\app\product\unit::add($args);
			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/units');
			}
			return;
		}

		// update unit
		if($old_unit != $get_unit)
		{
			\dash\notif::error(T_("Invalid name and old name!"));
			return false;
		}

		$result = \lib\app\product\unit::update($old_unit, $new_unit, $args);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this(). '/units');
		}

	}
}
?>