<?php
namespace content_site\body\contactform;


class cf1
{

	/**
	 * Style 1
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function option()
	{
		return
		[
			'title'        => T_("Contact form"),
			'default'      => [],
			'options'      =>
			[

				'heading_raw',
				'description',
				'google_map_embed',
				'contact_get_email',
				'contact_get_name',
				'contact_get_mobile',
				'model',
			],

			'preview_list' =>
			[
				'p1',
				'p2'
			],
		];
	}


	/**
	 * Preview 1
	 */
	public static function p1()
	{
		return
		[
			'version'        => 1,
			'options' =>
			[

			],
		];
	}



}
?>