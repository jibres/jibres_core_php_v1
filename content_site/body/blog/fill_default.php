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
		return
		[
			'title'       => T_("Your post's title"),
			'excerpt'     => "Your store hasn’t published any blog posts yet. A blog can be used to talk about new product launches, tips, or other news you want to share with your customers. You can check out Shopify’s ecommerce blog for inspiration and advice for your own store and blog.",
			'thumb'       => \dash\app::static_image_url(),
			'publishdate' => date("Y-m-d H:i:s"),
			'user_detail' =>
			[
				'displayname' => 'Author name',
				'avatar'      => \dash\sample\img::avatar(),
			]

		];
	}

}
?>