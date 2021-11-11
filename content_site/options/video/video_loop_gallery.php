<?php
namespace content_site\options\video;


class video_loop_gallery
{
	use video_loop;


	public static function have_specialsave()
	{
		return true;
	}


	public static function visible()
	{
		$data = \content_site\body\gallery\option::get_current_item();

		$my_file = a($data, 'preview', 'file');

		if($my_file)
		{
			$file_detail = \lib\filepath::get_detail($my_file);
			if(a($file_detail, 'type') === 'video')
			{
				return true;
			}
		}

		return false;
	}


	public static function specialsave($_data = [])
	{
		$data = \dash\validate::string_200(a($_data, 'video_loop'));

		return \content_site\body\gallery\option::update_one_gallery_item(['video_loop' => $data]);
	}

}
?>