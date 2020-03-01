<?php
namespace content_v2\business\posts;


class controller
{
	public static function routing()
	{
		\content_v2\tools::invalid_url();
	}

	public static function api_routing()
	{
		$detail = [];

		switch (\dash\url::dir(3))
		{
			case 'posts':
				if(\dash\url::dir(4) !== 'list')
				{
					\content_v2\tools::invalid_url();
				}
				if(!\dash\request::is('get'))
				{
					\content_v2\tools::invalid_method();
				}
				$detail = self::posts();
				break;

			case 'post':
				if(!\dash\request::is('get'))
				{
					\content_v2\tools::invalid_method();
				}

				$id = \dash\url::dir(4);

				if(!$id || !\dash\coding::decode($id))
				{
					\content_v2\tools::invalid_param('id');
				}

				$detail = self::load_post($id);
				break;

			default:
				\content_v2\tools::invalid_url();
				break;
		}

		\content_v2\tools::say($detail);
	}


	private static function load_post($_id)
	{
		$load_post = \dash\app\posts::get($_id, ['check_login' => false]);
		return $load_post;
	}


	private static function posts()
	{
		$args = [];

		$limit = \dash\request::get('limit');

		if($limit && is_numeric($limit) && intval($limit) > 1 && intval($limit) < 100)
		{
			$args['limit'] = intval($limit);
		}

		$posts  = \dash\app\posts::get_post_list($args);

		return $posts;

	}



}
?>