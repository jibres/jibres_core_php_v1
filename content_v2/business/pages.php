<?php
namespace content_v2\business;


class pages
{

	public static function by_slug($_type)
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
		if(!$result_raw)
		{
			\dash\notif::info(T_("This page is empty"));
		}

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