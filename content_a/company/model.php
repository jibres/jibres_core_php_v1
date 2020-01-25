<?php
namespace content_a\company;


class model
{
	public static function post()
	{
		$old_company = \dash\request::post('oldcompany');
		$new_company = \dash\request::post('company');
		$get_company = \dash\request::get('edit');

		// remove company
		if(\dash\request::post('type') === 'remove' && \dash\data::removeMode())
		{
			$args             = [];
			$args['whattodo'] = \dash\request::post('whattodo');
			$args['company']     = \dash\request::post('company');

			\lib\app\product\company::remove($args, \dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this());
			}
			return;
		}

		$args                = [];

		$args['title']       = \dash\request::post('company');

		$result = \lib\app\product\company::edit($args, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this());
		}

	}
}
?>