<?php
namespace content_site\body\blog;


class fill_default
{

	public static function get($_count)
	{
		$list = [];
		for ($i=1; $i <= $_count ; $i++)
		{
			$list[] = self::get_one_random_post($i);
		}

		return $list;
	}




	private static function get_one_random_post($i)
	{
		$collection =
		[
			'news',
			'flower',
			'work',
			'space',
			'money',
			'food',
			'book',
			'forest',
			'jungle',
			'fire',
			'clock',
			'time',
			'monitor',
			'pen',
			'fruit',
			'paper',
			'ice',

		];

		return
		[
			'title'       => T_("Your post's title"),
			'excerpt'     => T_("Your business hasn't published any posts yet. A post can be used to talk about new product launches, tips, or other news you want to share with your customers."),
			// 'thumb'       => \dash\app::static_image_url(),
			'thumb'       => \dash\sample\img::unsplash(null, $collection[array_rand($collection)]),
			'readingtime' => \dash\utility\human::time(5*60, true),
			'publishdate' => date("Y-m-d H:i:s"),
			'user_detail' =>
			[
				'displayname' => T_('Author name'),
				'avatar'      => \dash\app::static_avatar_url(),
			]

		];
	}

}
?>