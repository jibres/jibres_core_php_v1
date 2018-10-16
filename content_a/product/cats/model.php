<?php
namespace content_a\product\cats;


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
			\lib\app\product\cat::remove(\dash\request::post('removecat'));
			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/cats');
			}
			return;
		}

		$args                = [];
		$args['type']        = \dash\request::post('type');
		$args['catdefault'] = \dash\request::post('catdefault');
		$args['maxsale']     = \dash\request::post('maxsale');
		$args['title']       = \dash\request::post('cat');

		// add new category
		if(!\dash\data::editMode())
		{
			$result = \lib\app\product\cat::add($args);
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

		$result = \lib\app\product\cat::update($old_cat, $new_cat, $args);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this(). '/cats');
		}

	}
}
?>