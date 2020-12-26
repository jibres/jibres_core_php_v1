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

		// thumb image
		\dash\utility\image::load($_file_addr);
		\dash\utility\image::thumb(120, 120);
		\dash\utility\image::save($url_file.'-w120.'.$_ext);

		\dash\utility\image::load($_file_addr);
		\dash\utility\image::setWidth(220);
		\dash\utility\image::save($url_file.'-w220.'.$_ext);

		\dash\utility\image::load($_file_addr);
		\dash\utility\image::setWidth(300);
		\dash\utility\image::save($url_file.'-w300.'.$_ext);

		\dash\utility\image::load($_file_addr);
		\dash\utility\image::setWidth(460);
		\dash\utility\image::save($url_file.'-w460.'.$_ext);

		\dash\utility\image::load($_file_addr);
		\dash\utility\image::setWidth(780);
		\dash\utility\image::save($url_file.'-w780.'.$_ext);

		\dash\utility\image::load($_file_addr);
		\dash\utility\image::setWidth(1100);
		\dash\utility\image::save($url_file.'-w1100.'.$_ext);
	}




}
?>