<?php
namespace content_site\section\gallery;


class model
{
	public static function post()
	{
		$page_id      = \dash\request::get('id');
		$section_id   = \dash\request::get('sid');

		if(\dash\request::post('addimage') === 'addimage')
		{
			$currentSectionDetail = \dash\data::currentSectionDetail();
			if(isset($currentSectionDetail['preview']['list']) && is_array($currentSectionDetail['preview']['list']))
			{
				// ok
			}
			else
			{
				$currentSectionDetail['preview']['list'] = [];
			}

			$imagekey = md5(rand(). \dash\user::id(). microtime(). rand());

			$currentSectionDetail['preview']['list'][] =
			[
				'imagekey'  => $imagekey,
				'image'     => null,
				'alt'       => T_("Image"),
				'isdefault' => true,
			];

			$preview = json_encode($currentSectionDetail['preview']);

			\lib\sitebuilder\section_tools::patch_field($section_id, 'preview', $preview);

			$url = \dash\url::that(). '/image'. \dash\request::full_get(['image' => $imagekey]);

			\dash\redirect::to($url);

			return;
		}

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