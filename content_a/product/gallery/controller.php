<?php
namespace content_a\product\gallery;


class controller
{
	public static function routing()
	{
		\dash\permission::access('productGalleryEdit');
		\content_a\product\load::product();
	}
}
?>
