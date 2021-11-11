<?php
namespace content_site\options\video;


class video_loop_gallery
{
	use video_loop;



	public static function have_specialsave()
	{
		return true;
	}

	public static function specialsave($_data = [])
	{
		$data = \dash\validate::string_200(a($_data, 'video_loop'));

		return \content_site\body\gallery\option::update_one_gallery_item(['video_loop' => $data]);
	}

}
?>