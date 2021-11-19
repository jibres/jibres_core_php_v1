<?php
namespace content_site\options\caption;


class caption_gallery_button
{
	use caption_gallery;


	public static function title()
	{
		return T_("Button title");
	}



	public static function specialsave($_data)
	{
		$data = \dash\validate::string_100(a($_data, self::name()));

		return \content_site\body\gallery\option::update_one_gallery_item(['btn_title' => $data]);
	}



}
?>