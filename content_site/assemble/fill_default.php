<?php
namespace content_site\assemble;


class fill_default
{

	public static function blog($_count, $_preview_mode = true)
	{
		$list = [];
		for ($i=1; $i <= $_count ; $i++)
		{
			$list[] = self::get_one_random_blog($i, $_preview_mode);
		}

		return $list;
	}




	private static function get_one_random_blog($i, $_preview_mode)
	{
		$date = date('Y-m-d H:i:s', strtotime( '-'.mt_rand(0,5).' days'));

		if($_preview_mode)
		{
			$img = \dash\sample\img::image();
		}
		else
		{
			$img = \dash\app::static_image_url();
		}

		return
		[
			'title'         => T_("Your post's title"),
			'excerpt'       => T_("Your business hasn't published any posts yet. A post can be used to talk about new product launches, tips, or other news you want to share with your customers."),
			'thumb'         => $img,
			'readingtime'   => \dash\utility\human::time(60* rand(1, 5), true),
			'publishdate'   => $date,
			'comment_count' => rand(0, 200),
			'user_detail'   =>
			[
				'displayname' => T_('Author name'),
				'avatar'      => \dash\app::static_avatar_url(),
			]

		];
	}

}
?>