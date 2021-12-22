<?php
namespace content_sudo\fix\ganje;

class controller
{

	public static function routing()
	{
		\dash\code::time_limit(0);

		$files     = glob('E:\Jibres\ProductData\test33\*');
		$ganjePath = "E:\Jibres\ProductData\ganje\\";

		$index = 0;
		foreach ($files as $file)
		{
			$ext    = substr($file, -3);
			$extlen = mb_strlen($ext);

			if(!in_array($ext, ['jpg', 'png', 'gif']))
			{
				continue;
			}

			$width_list = \dash\utility\image::responsive_image_size();

			$fileMd5 = md5_file($file);
			$folderMd5 = substr($fileMd5, 0, 2);
			$file_without_ext = substr($file, 0, -$extlen-1);

			// check new location
			$fileNewLocationJPG = $ganjePath. $folderMd5. '/';
			\dash\file::makeDir($fileNewLocationJPG);

			// add file md5
			$fileNewLocationJPG .= $fileMd5;

			foreach ($width_list as $width)
			{
				// $new_path = $file_without_ext . '-w'. $width. '.webp';
				$new_path = $fileNewLocationJPG. '-w'. $width. '.webp';

				if(is_file($new_path))
				{
					unlink($new_path);
				}

				if(!is_file($new_path) && \dash\str::strpos($file, '.webp') === false)
				{
					\dash\utility\image::make_webp_image($file, $new_path, $width);
				}
			}

			// save compressed file
			$tmpNewLocation = YARD. 'jibres_temp/ganje-tmp.'. $ext;
			\dash\utility\image::setQuality(95);
			\dash\utility\image::load($file);
			\dash\utility\image::save_loaded_img($tmpNewLocation);

			// calc file size
			$fileSizeInit = filesize($file);
			$fileSizeCompressed = filesize($tmpNewLocation);

			$sourceFileAddr = $file;
			if($fileSizeInit > $fileSizeCompressed)
			{
				// good compress
				// use compressed image

				$sourceFileAddr = $tmpNewLocation;

			}

			// copy file to new location
			\dash\file::copy($sourceFileAddr, $fileNewLocationJPG.'.'. $ext, true);



			// add data of old and new file name to csv
			$csvData = $index.','. basename($file). ','. $fileMd5. "\n";
			file_put_contents(root.'test1.csv', $csvData, FILE_APPEND);
			$index++;
		}

		var_dump($files);exit();
	}
}
?>