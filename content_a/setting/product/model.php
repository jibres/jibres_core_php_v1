<?php
namespace content_a\setting\product;


class model
{
	public static function post()
	{
		$all_post  = \dash\request::post();

		$post = [];


		if(array_key_exists('runaction_defaulttracking', $all_post))
		{
			$post['defaulttracking'] = \dash\request::post('defaulttracking');
		}

		if(array_key_exists('runaction_product_suggestion', $all_post))
		{
			$post['product_suggestion'] = \dash\request::post('product_suggestion');
		}


		if(array_key_exists('runaction_comment', $all_post))
		{
			$post['comment'] = \dash\request::post('comment');
		}


		$ratio = \dash\request::post('ratio') ? \dash\request::post('ratio') : null;
		if(array_key_exists('runaction_ratio', $all_post))
		{
			$post['ratio'] = $ratio;
		}


		\lib\app\setting\set::product_setting($post);

		// \dash\redirect::pwd();
	}
}
?>