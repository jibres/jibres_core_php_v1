<?php
namespace content_a\products\property\add;


class model
{

	public static function post()
	{

		$id = \dash\request::get('id');

		$post                = [];
		$post['cat']         = \dash\request::post('cat');
		$post['key']         = \dash\request::post('key');
		$post['value']       = \dash\request::post('value');
		$post['outstanding'] = \dash\request::post('outstanding');

		\lib\app\product\property::add($post, $id, \dash\request::get('pid'));

		// save session
		\dash\session::set('fill_product_property', $post['cat'], null, 60);




		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::that(). '?id='. \dash\request::get('id'));

		}
	}
}
?>