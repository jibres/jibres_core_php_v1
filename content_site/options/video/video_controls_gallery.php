<?php
namespace content_site\options\video;


class video_controls_gallery
{
	use video_controls;


	public static function have_specialsave()
	{
		return true;
	}


	/**
	 * Use in other options
	 * @return [type] [description]
	 */
	public static function visible()
	{
		return video_loop_gallery::visible();
	}


	public static function specialsave($_data = [])
	{
		$data = \dash\validate::string_200(a($_data, 'video_controls'));

		return \content_site\body\gallery\option::update_one_gallery_item(['video_controls' => $data]);
	}

}
?>