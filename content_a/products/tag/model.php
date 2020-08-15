<?php
namespace content_a\products\tag;


class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'remove' && \dash\request::get('edit'))
		{
			$remove = \lib\app\product\tag::remove(\dash\request::get('edit'));
			if($remove)
			{
				\dash\redirect::to(\dash\url::that());
			}

			return;
		}

		$post             = [];
		$post['title']    = \dash\request::post('title');
		$post['desc']     = \dash\request::post('desc');
		$post['language'] = \dash\language::current();
		$post['slug']     = \dash\request::post('slug');
		// $post['status']   = \dash\request::post('status');

		if(\dash\request::get('edit'))
		{
			\lib\app\product\tag::edit($post, \dash\request::get('edit'));
		}
		else
		{
			\lib\app\product\tag::add_tag($post);
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that());
		}
	}
}
?>
