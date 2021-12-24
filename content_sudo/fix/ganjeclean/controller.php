<?php
namespace content_sudo\fix\ganjeclean;

class controller
{

	public static function routing()
	{
		\dash\code::time_limit(0);
		ini_set("memory_limit","1000M");

		$list = \dash\utility\import::csv('D:\My Works\Ganje\unique-files\SuperMarket-remove-unused-files.csv');

		foreach ($list as $key => $value)
		{
			$md5 = $value["﻿md5"];
			$folder = substr($md5, 0, 2);
			$filePath = 'E:\Jibres\ProductData\ganje\\'. $folder. '\\'. $md5;

			$ext = ['.jpg', '.png', '-w1100.webp', '-w780.webp', '-w460.webp', '-w300.webp', '-w220.webp', '-w120.webp'];
			foreach ($ext as $myExt)
			{
				$addr = $filePath. $myExt;
				if( file_exists( $addr ) )
				{
					var_dump($addr);
					unlink( $addr );
				}
			}
		}
	}
}
?>