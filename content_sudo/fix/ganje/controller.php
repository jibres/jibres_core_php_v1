<?php
namespace content_sudo\fix\ganje;

class controller
{

	public static function routing()
	{
		\dash\code::time_limit(0);

		$files = glob('E:\Jibres\ProductData\test11\*');
		$index = 0;
		foreach ($files as $file)
		{
			$ext = substr($file, -3);

			$extlen     = mb_strlen($ext);

			if(!in_array($ext, ['jpg', 'png', 'gif']))
			{
				continue;
			}

			$width_list = \dash\utility\image::responsive_image_size();

			$fileMd5 = md5_file($file);

			foreach ($width_list as $width)
			{

				$file_without_ext = substr($file, 0, -$extlen-1);

				$new_path = $file_without_ext . '-w'. $width. '.webp';

				if(is_file($new_path))
				{
					unlink($new_path);
				}

				if(!is_file($new_path) && \dash\str::strpos($file, '.webp') === false)
				{
					\dash\utility\image::make_webp_image($file, $new_path, $width);
				}


			}


			// add data of old and new file name to csv
			$csvData = $index.','. basename($file). ','. $fileMd5. "\n";
			file_put_contents(root.'test1.csv', $csvData, FILE_APPEND);
			$index++;
		}

		var_dump($files);exit();
	}
}
?>