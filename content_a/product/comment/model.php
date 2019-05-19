<?php
namespace content_a\product\comment;


class model
{
	public static function post()
	{

		// remove comment
		if(\dash\request::post('type') === 'remove' && \dash\data::removeMode())
		{
			$args             = [];
			$args['whattodo'] = \dash\request::post('whattodo');
			$args['comment']  = \dash\request::post('comment');

			\lib\app\product\comment::remove($args, \dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/comment');
			}
			return;
		}

		$args                = [];

		$args['title']       = \dash\request::post('comment');

		$result = \lib\app\product\comment::edit($args, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this(). '/comment');
		}

	}
}
?>