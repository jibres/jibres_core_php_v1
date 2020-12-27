<?php
namespace content_n\home;

class controller
{
	public static function routing()
	{

		$module = \dash\url::module();
		if(!$module)
		{
			\dash\redirect::to(\dash\url::kingdom());
		}



		$load_post = \dash\app\posts\get::get(\dash\url::module(), ['check_login' => false]);

		// if(!isset($load_post['type']) || !isset($load_post['status']) || !isset($load_post['url']) || !isset($load_post['language']))
		// {
		// 	\dash\redirect::to(\dash\url::kingdom());
		// }

		// if(!in_array($load_post['type'], ['post', 'page', 'help']))
		// {
		// 	\dash\redirect::to(\dash\url::kingdom());
		// }

		// var_dump($load_post);exit();


		// if(!in_array($load_post['status'], ['publish']))
		// {
		// 	\dash\redirect::to(\dash\url::kingdom());
		// }

		// if(isset($load_post['link']))
		// {
		// 	\dash\log::set('newsCodeRedirect', ['code' => \dash\url::module(), 'link' => $load_post['link']]);

		// 	\dash\redirect::to($load_post['link']);

		// 	return;
		// }

		// \dash\redirect::to(\dash\url::kingdom());

		\dash\data::dataRow($load_post);

		\dash\open::get();
	}
}
?>