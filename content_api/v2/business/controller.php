<?php
namespace content_api\v2\business;


class controller
{
	public static function routing()
	{
		\content_api\v2::invalid_url();
	}

	public static function api_routing()
	{

		$detail = [];

		$my_child = \dash\url::dir(3);

		switch ($my_child)
		{
			case 'mission':
			case 'vision':
			case 'about':
			case 'contact':
				if(\dash\url::dir(4))
				{
					\content_api\v2::invalid_url();
				}
				if(!\dash\request::is('get'))
				{
					\content_api\v2::invalid_method();
				}

				$detail = self::page($my_child);
				break;

			case 'post':
			case 'posts':
				\content_api\v2\business\posts\controller::api_routing();
				break;

			default:
				\content_api\v2::invalid_url();
				break;
		}

		\content_api\v2::say($detail);

	}



	private static function page($_type)
	{
		$result = [];
		$result_page_args =
		[
			'type'     => 'page',
			'status'   => 'publish',
			'slug'     => $_type,
			'language' => \dash\language::current(),
			'limit'    => 1,
		];

		$result_raw = \dash\db\posts::get($result_page_args);

		if($result_raw && is_array($result_raw))
		{
			foreach ($result_raw as $key => $value)
			{
				switch ($key)
				{
					case 'content':
						$result[$key] = $value;

						break;

					case 'title':
					case 'slug':
					case 'language':
						$result[$key] = $value;
						break;

					case 'url':
						$result[$key] = \dash\url::kingdom(). '/'. $value;
						break;

					default:
						# code...
						break;
				}


			}
		}

		return $result;
	}
}
?>