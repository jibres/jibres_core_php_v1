<?php
namespace content_site\assemble;


class fill_default
{

	public static function blog($_count)
	{
		$list = [];
		for ($i=1; $i <= $_count ; $i++)
		{
			$list[] = self::get_one_random_blog($i);
		}

		return $list;
	}




	private static function get_one_random_blog($i)
	{
		$date = date('Y-m-d H:i:s', strtotime( '-'.mt_rand(0,5).' days'));
		return
		[
			'title'       => T_("Your post's title"),
			'excerpt'     => T_("Your business hasn't published any posts yet. A post can be used to talk about new product launches, tips, or other news you want to share with your customers."),
			'thumb'       => \dash\sample\img::image(),
			'readingtime' => \dash\utility\human::time(60* rand(1, 5), true),
			'publishdate' => $date,
			'user_detail' =>
			[
				'displayname' => T_('Author name'),
				'avatar'      => \dash\app::static_avatar_url(),
			]

		];
	}

}
?>