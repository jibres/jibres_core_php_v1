<?php
namespace content_site\body\blog;


class layout
{


	/**
	 * Layout blog html
	 *
	 * @param      <type>  $_args  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function layout($_args)
	{
		$blogList = [];
		$dataList = [];

		$view_all_link = \dash\url::kingdom(). '/n';

		if(!\content_site\utility::fill_by_default_data())
		{
			$line_detail =
			[
				'tag_id'                  => a($_args, 'post_tag'),
				'subtype'                 => a($_args, 'post_template'),
				'limit'                   => a($_args, 'count'),
				'post_show_author'        => a($_args, 'post_show_author'),
				'btn_viewall_check'       => a($_args, 'btn_viewall_check'),
				'post_order'              => a($_args, 'post_order'),
				'post_show_comment_count' => a($_args, 'post_show_comment_count'),
			];

			$dataList = \dash\app\posts\load::sitebuilder_template($line_detail);

			if(isset($dataList['list']) && is_array($dataList['list']))
			{
				$blogList = $dataList['list'];
			}

			if(isset($dataList['link']))
			{
				$view_all_link = $dataList['link'];
			}

			if(!is_array($blogList))
			{
				// error
				// it will not happend because we fill it in all conditions
				$blogList = [];
			}
		}

		// fill_default_data receive from preview function
		if(empty($blogList) || \content_site\utility::fill_by_default_data())
		{
			$blogList = self::fill_default(a($_args, 'count'), a($_args, 'preview_mode'));
		}

		// send the view all link to every layout of blog
		$_args['btn_viewall_link'] = $view_all_link;
		if(!a($_args, 'btn_viewall'))
		{
			$_args['btn_viewall'] = T_("View all");
		}


		$html             = '';


		$type      = a($_args, 'type');

		$namespace = sprintf('%s\%s\%s', __NAMESPACE__, 'html', $type);

		if(is_callable([$namespace, 'html']))
		{
			$html .= call_user_func_array([$namespace, 'html'],[$_args, $blogList]);
		}

		return $html;
	}



	public static function fill_default($_count, $_preview_mode = true)
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

		if($_preview_mode || \dash\url::subdomain() === 'demo')
		{
			$img = \dash\sample\img::image();
		}
		else
		{
			$img = \dash\app::static_image_url();
		}

		return
		[
			'title'         => T_("Your post’s title"),
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