<?php
namespace content_a\product\comment;


class model
{
	public static function post()
	{

		// remove comment
		if(\dash\request::post('type') === 'remove' && \dash\data::editMode())
		{

			\lib\app\product\comment::remove(\dash\request::post('commentid'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that(). '?id='. \dash\request::get('id'));
			}
			return;
		}

		$args            = [];
		$args['star']    = \dash\request::post('star');
		$args['content'] = \dash\request::post('content');
		$args['status']  = \dash\request::post('status');

		$result = \lib\app\product\comment::edit($args, \dash\request::get('commentid'));


		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that(). '?id='. \dash\request::get('id'));
		}

	}
}
?>