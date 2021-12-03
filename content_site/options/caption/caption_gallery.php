<?php
namespace content_site\options\caption;


class caption_gallery extends caption
{


	public static function have_specialsave()
	{
		return true;
	}


	public static function title()
	{
		return T_("Title");
	}



	public static function specialsave($_data)
	{
		$data = \dash\validate::string_100(a($_data, static::name()));

		return \content_site\body\gallery\option::update_one_gallery_item(['title' => $data]);
	}

}
?>