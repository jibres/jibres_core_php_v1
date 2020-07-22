<?php
namespace content_a\products\property;


class model
{

	public static function post()
	{
		$id = \dash\request::get('id');

		if(\dash\request::post('remove') === 'remove')
		{
			\lib\app\product\property::remove(\dash\request::post('pid'), $id);
			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that(). '?id='. \dash\request::get('id'));
			}
			return;
		}

		if(\dash\request::post('outstanding') === 'outstanding')
		{
			\lib\app\product\property::outstanding(\dash\request::post('pid'), $id, \dash\request::post('type'));
			if(\dash\engine\process::status())
			{
				// \dash\notif::clean();
				// \dash\redirect::to(\dash\url::that(). '?id='. \dash\request::get('id'));
				\dash\redirect::pwd();
			}
			return;
		}

		$post                = [];
		$post['cat']         = \dash\request::post('cat');
		$post['key']         = \dash\request::post('key');
		$post['value']       = \dash\request::post('value');
		$post['outstanding'] = \dash\request::post('outstanding');

		\lib\app\product\property::add($post, $id, \dash\request::get('pid'));

		if(\dash\engine\process::status())
		{
			if(\dash\request::get('pid'))
			{
				\dash\redirect::to(\dash\url::that(). '?id='. \dash\request::get('id'));
			}
			else
			{
				// \dash\redirect::pwd();
			}
		}
	}
}
?>