<?php
namespace content_site\footer;


class f1
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
				'title'        => T_("Simple"),
				'options'      =>
					[
						'heading_business_header',
						'description_copyright',
						'responsive' => share::set_responsive_option_footer(),

					],
				'default'      =>
					[
						'use_as_heading' => 'business_heading',
					],
				'preview_list' =>
					[
						'p1',
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
				'version' => 1,
				'options' =>
					[
						'use_as_heading'     => 'business_heading',
						'use_as_footer_link' => 'default',
					],
			];
	}


}

?>