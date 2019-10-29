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
		if(\dash\request::post('type') === 'remove' && \dash\data::removeMode())
		{
			$args             = [];
			$args['whattodo'] = \dash\request::post('whattodo');
			$args['unit']     = \dash\request::post('unit');

			\lib\app\product\unit::remove($args, \dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/units');
			}
			return;
		}

		$args                = [];
		$args['int']         = \dash\request::post('int');
		$args['unitdefault'] = \dash\request::post('unitdefault');
		$args['maxsale']     = \dash\request::post('maxsale');
		$args['title']       = \dash\request::post('unit');

		$result = \lib\app\product\unit::edit($args, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this(). '/units');
		}

	}
}
?>