<?php
namespace content_site\body\blog;


class preview
{

	public static function preview_1()
	{
		return
		[
			'type'              => 'b1',
			'fill_defult_data'  => true,
			'post_show_excerpt' => false,
			'background_pack'   => 'none',
		];
	}


	public static function preview_gradient_1()
	{
		return
		[
			'type'                     => 'b2',
			'fill_defult_data'         => true,
			'post_show_excerpt'        => false,
			// 'post_template'         => 'standard',
			'background_pack'          => 'gradient',
			'background_gradient_type' => 'gradient-to-r',
			'background_gradient_from' => 'pink-500',
			'background_gradient_via'  => 'red-500',
			'background_gradient_to'   => 'yellow-500',

		];
	}



}
?>