<?php
namespace dash\upload;

/**
 * Class for crop.
 */
class crop
{
	public static function pic($_file_addr, $_ext)
	{

		$extlen     = mb_strlen($_ext);
		$url_file   = substr($_file_addr, 0, -$extlen-1);
		$url_thumb  = $url_file.'-thumb.'.$_ext;
		$url_normal = $url_file.'-normal.'.$_ext;
		$url_large  = $url_file.'-large.'.$_ext;

		\dash\utility\image::load($_file_addr);

		// large image
		\dash\utility\image::thumb(900, 600);
		\dash\utility\image::save($url_large);


		// normal image
		\dash\utility\image::thumb(600, 400);
		\dash\utility\image::save($url_normal);


		// thumb image
		\dash\utility\image::thumb(150, 150);
		\dash\utility\image::save($url_thumb);
	}


}
?>