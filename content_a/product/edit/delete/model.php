<?php
namespace content_a\product\edit\delete;


class model extends \content_a\main\model
{
	public function post_delete($_args)
	{
		$url_product  = \lib\utility::get('id');
		$post_product = \lib\utility::post('delete');

		if($url_product === $post_product)
		{
			\lib\app\product::delete($url_product);

			if(\lib\debug::$status)
			{
				$this->redirector(\lib\url::here(). '/product');
			}
		}
		else
		{
			\lib\debug::error(T_("What are you doing?"));
		}
	}
}
?>
