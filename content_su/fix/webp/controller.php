<?php
namespace content_su\fix\webp;

class controller
{

	public static function routing()
	{
		set_time_limit(0);

		$files = glob('/home/reza/projects/talambar_cdn/images/slider-sample/iran/*');
		foreach ($files as $file)
		{
			$width_list = \dash\utility\image::responsive_image_size();

			foreach ($width_list as $width)
			{
				$ext = substr($file, -3);

				$extlen     = mb_strlen($ext);

				if(!in_array($ext, ['jpg', 'png', 'gif']))
				{
					continue;
				}

				$file_without_ext = substr($file, 0, -$extlen-1);

				$new_path = $file_without_ext . '-w'. $width. '.webp';

				if(is_file($new_path))
				{
					unlink($new_path);
				}

				if(!is_file($new_path) && strpos($file, '.webp') === false)
				{
					\dash\utility\image::make_webp_image($file, $new_path, $width);
				}


			}
		}

		var_dump($files);exit();
	}
}
?>