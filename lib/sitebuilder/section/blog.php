<?php
namespace lib\sitebuilder\section;


class blog
{

	public static function allow()
	{
		return true;
	}


	private static function detail()
	{
		$detail =
		[
			'group' => T_("Blog"),
			'title' => T_("Blog posts"),
			'key'   => 'blog',
			'icon'  => \dash\utility\icon::url('Blog'),
		];

		return $detail;
	}


	public static function options()
	{
		$options =
		[
			'heading',
			'view_all_btn',
			'post_tag',
			'post_template',
			'rangeslider',
			'avand',
			'padding',
			'radius',
		];

		return $options;
	}


	public static function default()
	{
		$default =
		[
			'heading'        => T_("Post blog"),
			'post_template'  => 'video',
			'post_play_item' => 'all',
		];

		return $default;
	}
}
?>