<?php
namespace content_site\options\video;


class video_poster_gallery
{
	use video_poster;

	public static function have_specialsave()
	{
		return true;
	}


	public static function visible()
	{
		return video_loop_gallery::visible();
	}


	public static function specialsave($_data = [])
	{
		$data = self::validator_upload_file($_data);

		return \content_site\body\gallery\option::update_one_gallery_item(['video_poster' => $data]);
	}

}
?>