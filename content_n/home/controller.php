<?php
namespace content_n\home;

class controller
{
	public static function routing()
	{

		// <link href="URL OF ORIGINAL PAGE" rel="canonical" />

		$module = \dash\url::module();
		if(!$module)
		{
			\dash\redirect::to(\dash\url::kingdom());
		}



		$load_post = \dash\app\posts\get::get(\dash\url::module(), ['check_login' => false]);

		if(!$load_post || !isset($load_post['type']))
		{
			\dash\header::status(404, T_("Post not found"));
		}

		if(!in_array($load_post['type'], ['post', 'page']))
		{
			\dash\header::status(404, T_("Post not found"));
		}

		if(\dash\url::child())
		{
			if(isset($load_post['slug']) && $load_post['slug'] === \dash\url::child())
			{
				// ok. nothing
			}
			else
			{
				\dash\header::status(404, T_("Invalid slug of post"));
			}
		}

		\dash\data::dataRow($load_post);

		\dash\open::get();
	}
}
?>