<?php
namespace content_site\section\gallery;


class controller
{
	public static function routing()
	{
		\dash\data::pagebuilderMode('body');

		// load post detail
		\content_site\controller::load_current_page_detail();

		\content_site\controller::load_current_section_detail('gallery');
	}



	public static function options()
	{
		$options =
		[
			'heading',
			'avand',
			'padding',
			'radius',
		];

		return $options;
	}
}
?>