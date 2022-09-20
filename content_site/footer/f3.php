<?php
namespace content_site\footer;


class f3
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
				'title'   => T_("Shopping Footer"),
				'options' =>
					[
						'heading_business_footer',
						'description_business',

						'file_business_logo_footer',
						'menu_1',
						'menu_2',
						'menu_3',
						'menu_4',
						'description_copyright',
						'certificate_payping',
						'certificate_enamad',
						'certificate_samandehi',
						'style'      => \content_site\utility::set_style_option(
							[
								// 'font',
								'container',
							]),
						'responsive' => share::set_responsive_option_footer(),

					],
				'default' =>
					[
						'use_as_logo'           => 'business_logo',
						'use_as_heading'        => 'business_heading',
						'use_as_description'    => 'business_description',
						'certificate_samandehi' => true,
						'certificate_enamad'    => true,
						'container'             => 'xl',
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
						'use_as_logo'           => 'business_logo',
						'use_as_footer_link'    => 'default',
						'use_as_heading'        => 'business_heading',
						'use_as_description'    => 'business_description',
						'certificate_samandehi' => true,
						'certificate_enamad'    => true,
					],
			];
	}


}

?>