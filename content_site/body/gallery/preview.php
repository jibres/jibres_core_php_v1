<?php
namespace content_site\body\gallery;


class preview
{

	public static function preview_1()
	{
		return
		[
			'heading'   => T_("Image Gallery"),
			'style'     => 'style_1',
			'imagelist' => option::default_image_list(),
		];
	}


}
?>