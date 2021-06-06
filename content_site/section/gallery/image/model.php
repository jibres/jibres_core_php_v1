<?php
namespace content_site\section\gallery\image;


class model
{
	public static function post()
	{
		$page_id      = \dash\request::get('id');
		$section_id   = \dash\request::get('sid');

		// save post option
		if(\dash\request::post('postoption') === 'postoption')
		{
			$postoption              = [];
			$postoption['tag_id']    = \dash\request::post('tag_id');
			$postoption['subtype']   = \dash\request::post('subtype');
			$postoption['play_item'] = \dash\request::post('play_item');

			$condition =
			[
				'tag_id'    => 'code_0',
				'subtype'   => ['enum' => ['any', 'standard', 'gallery', 'video', 'audio']],
				'play_item' => ['enum' => ['none', 'first', 'all']],
			];

			$data = \dash\cleanse::input($postoption, $condition);

			\lib\sitebuilder\section_tools::patch_preview_field($section_id, $data);

			return;
		}

		$option_list = controller::options();

		return \content_site\model::public_model($option_list);


	}
}
?>