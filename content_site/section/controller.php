<?php
namespace content_site\section;


class controller
{
	public static function routing()
	{
		\dash\data::pagebuilderMode('body');
	}


	/**
	 * Get section list
	 */
	public static function section_list()
	{
		$list = [];

		$list[] =
		[
			'group' => T_("Image"),
			'title' => T_("Gallery"),
			'key'   => 'gallery',
			'icon'  => \dash\utility\icon::url('images'),
		];


		return $list;

	}
}
?>