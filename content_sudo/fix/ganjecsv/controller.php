<?php
namespace content_sudo\fix\ganjecsv;

class controller
{

	public static function routing()
	{
		\dash\code::time_limit(0);
		ini_set("memory_limit","1000M");

		$list = \dash\utility\import::csv('D:\My Works\Ganje\SuperMarket-all-v16-79044-need-search.csv');

		foreach ($list as $key => $value)
		{
			$a = self::convert_file('E:\Jibres\ProductData\SuperMarket\\'. $value["﻿addr"]);
			var_dump($a);
		}




		return ;

		$addr = 'E:\Jibres\ProductData\SuperMarket';
		$dirs = self::get_all_folders($addr);

		foreach ($dirs as $myFolderAddr => $value)
		{
			self::convert_folder($myFolderAddr);
		}
	}


	private static function get_all_folders($_folder='')
	{
		$dirs = [];
		$folders = glob($_folder.'\*', GLOB_MARK|GLOB_ONLYDIR|GLOB_NOSORT);

		// add to dir list
		if(is_array($folders) && count($folders))
		{
			foreach ($folders as $myFolder)
			{
				$dirs[$myFolder] = '1';
				$level2 = self::get_all_folders($myFolder);
				$dirs = array_merge($dirs, $level2);
			}
		}
		return $dirs;
	}


	private static function convert_folder($_addr)
	{
		$files = glob($_addr. '\*');


		foreach ($files as $file)
		{
			self::convert_file($file);
		}

		// var_dump($files);exit();
	}


	private static function convert_file($_file)
	{
		// $ganjePath = "E:\Jibres\ProductData\ganje\\";
		$ganjePath = "E:\Jibres\ProductData\ganje-search\\";
		$ext    = substr($_file, -3);
		$extlen = mb_strlen($ext);

		if(!in_array($ext, ['jpg', 'png', 'gif']))
		{
			return false;
		}

		$width_list = \dash\utility\image::responsive_image_size();

		$fileMd5 = md5_file($_file);
		$folderMd5 = substr($fileMd5, 0, 2);
		$file_without_ext = substr($_file, 0, -$extlen-1);

		// check new location
		$fileNewLocationJPG = $ganjePath. $folderMd5. '/';
		\dash\file::makeDir($fileNewLocationJPG);

		// add file md5
		$fileNewLocationJPG .= $fileMd5;
		$fileNewLocationJPF_desc = $fileNewLocationJPG.'.'. $ext;
		if(file_exists($fileNewLocationJPF_desc))
		{
			return false;
		}

		foreach ($width_list as $width)
		{
			// $new_path = $file_without_ext . '-w'. $width. '.webp';
			$new_path = $fileNewLocationJPG. '-w'. $width. '.webp';

			if(is_file($new_path))
			{
				unlink($new_path);
			}

			if(!is_file($new_path) && \dash\str::strpos($_file, '.webp') === false)
			{
				\dash\utility\image::make_webp_image($_file, $new_path, $width);
			}
		}

		// save compressed file
		$tmpNewLocation = YARD. 'jibres_temp/ganje-tmp.'. $ext;
		\dash\utility\image::setQuality(95);
		\dash\utility\image::load($_file);
		\dash\utility\image::save_loaded_img($tmpNewLocation);

		// calc file size
		$fileSizeInit = filesize($_file);
		$fileSizeCompressed = filesize($tmpNewLocation);

		$sourceFileAddr = $_file;
		if($fileSizeInit > $fileSizeCompressed)
		{
			// good compress
			// use compressed image

			$sourceFileAddr = $tmpNewLocation;

		}

		// copy file to new location
		\dash\file::copy($sourceFileAddr, $fileNewLocationJPF_desc, true);



		// add data of old and new file name to csv
		$csvData = basename($_file). ','. $fileMd5. "\n";
		file_put_contents($ganjePath.'result.csv', $csvData, FILE_APPEND);
	}
}
?>