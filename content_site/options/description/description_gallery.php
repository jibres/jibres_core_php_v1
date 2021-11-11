<?php
namespace content_site\options\description;

class description_gallery
{

	use description;


	public static function special_load_value()
	{
		return true;
	}

	public static function load_value()
	{
		$data = \content_site\body\gallery\option::get_current_item();
		return a($data, 'preview', 'meta', 'desc');

	}


	public static function have_specialsave()
	{
		return true;
	}

	public static function specialsave($_data = [])
	{
		$data = \dash\validate::string_200(a($_data, 'description'));

		return \content_site\body\gallery\option::update_one_gallery_item(['desc' => $data]);
	}

}
?>