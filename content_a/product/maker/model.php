<?php
namespace content_a\product\maker;


class model
{
	public static function post()
	{
		\dash\permission::access('aProductDelete');
		$url_product  = \dash\request::get('id');
		$post_product = \dash\request::post('delete');

		if($url_product === $post_product)
		{
			\lib\app\product::delete($url_product);

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this());
			}
		}
		else
		{
			\dash\notif::error(T_("What are you doing?"));
		}
	}
}
?>
