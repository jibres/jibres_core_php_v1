<?php
namespace content_site\options\link;


class link_gallery
{

	use link_professional;

	public static function validator($_data)
	{
		$data = \dash\validate::absolute_url($_data, true);
		return $data;
	}


	public static function have_specialsave()
	{
		return true;
	}

	public static function option_key()
	{
		return 'link_gallery';
	}


	public static function specialsave($_data)
	{
		var_dump($_data);exit;
	}



}
?>