<?php
namespace content_site\options\container;


class container_gallery_g4
{
	use container_gallery;

	public static function allow_items()
	{
		return
		[
			'sm',
			'md',
			'lg',
			'xl',
			'2xl',
			'fluid',
		];
	}

}
?>