<?php
namespace content_site\section\blog;


class controller
{
	public static function routing()
	{
		\dash\data::pagebuilderMode('body');

		// load post detail
		\content_site\controller::load_current_page_detail();

		\content_site\controller::load_current_section_detail('blog', self::options('default'));
	}



	public static function options()
	{
		$options =
		[
			'heading'       => T_("Post blog"),
			'view_all_btn'  => null,
			'post_tag'      => null,
			'post_template' => ['post_template' => 'video', 'post_play_item' => 'all'],
			'rangeslider'   => 2,
			'avand'         => null,
			'padding'       => null,
			'radius'        => null,
		];

		return \lib\sitebuilder\options::get($options, ...func_get_args());

	}
}
?>