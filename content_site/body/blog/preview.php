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


	public static function preview_2()
	{
		return
		[
			'type'                     => 'b2',
			'fill_defult_data'         => true,
			'post_show_excerpt'        => true,
			// 'post_template'         => 'standard',
			'background_pack'          => 'solid',
			'background_color'   => '#e0e7ff',

		];
	}



	public static function preview_3()
	{
		return
		[
			'type'                     => 'b3',
			'fill_defult_data'         => true,
			'post_show_excerpt'        => true,
			// 'post_template'         => 'standard',
			// 'background_pack'          => 'solid',
			// 'background_color'   => '#e0e7ff',

		];
	}



}
?>