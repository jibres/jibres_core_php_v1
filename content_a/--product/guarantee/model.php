<?php
namespace content_a\product\guarantee;


class model
{
	public static function post()
	{

		// remove guarantee
		if(\dash\request::post('type') === 'remove' && \dash\data::removeMode())
		{
			$args             = [];
			$args['whattodo'] = \dash\request::post('whattodo');
			$args['guarantee']  = \dash\request::post('guarantee');

			\lib\app\product\guarantee::remove($args, \dash\request::get('id'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/guarantee');
			}
			return;
		}

		$args                = [];

		$args['title']       = \dash\request::post('guarantee');

		$result = \lib\app\product\guarantee::edit($args, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this(). '/guarantee');
		}

	}
}
?>