<?php
namespace content_site\options\description;

class description_gallery
{

	use description;

	public static function db_key()
	{
		return 'desc';
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