<?php
namespace content_site\section\blog;


class controller
{
	public static function routing()
	{
		\dash\data::pagebuilderMode('body');

		// load post detail
		\content_site\controller::load_current_page_detail();

		\content_site\controller::load_current_section_detail('blog');
	}



	public static function options()
	{
		$options =
		[
			'avand',
			'padding',
			'radius',
		];

		return $options;
	}
}
?>