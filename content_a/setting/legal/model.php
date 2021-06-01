<?php
namespace content_a\setting\legal;


class model
{
	public static function post()
	{
		$post                       = [];

		if(\dash\request::post('template') === 'template' && \dash\request::post('mode'))
		{
			$post_id = \lib\app\setting\policy_page::create_from_template(\dash\request::post('mode'));

			if($post_id)
			{
				\dash\redirect::to(\dash\url::kingdom(). '/cms/posts/edit?id='. $post_id);
			}
		}

	}
}
?>
