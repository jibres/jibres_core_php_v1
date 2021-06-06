<?php
namespace content_site\section\blog;


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


		$section_tools = \lib\sitebuilder\section_tools::action($section_id, $page_id);

		if($section_tools)
		{
			if($section_tools === 'delete')
			{
				\dash\redirect::to(\dash\url::here(). '/page'. \dash\request::full_get(['sid' => null]));
			}
			\dash\redirect::pwd();
			return;
		}

		$options_list = controller::options();

		$option_key   = \dash\request::post('option');

		if(!in_array($option_key, $options_list))
		{
			\dash\notif::error(T_("Invalid option"));
			return false;
		}

		// save multi option
		if(\dash\request::post('multioption') === 'multi')
		{
			$value = \dash\request::post();
		}
		else
		{
			$value = \dash\request::post($option_key);
		}

		\lib\sitebuilder\options::admin_save($section_id, $option_key, $value);


	}
}
?>