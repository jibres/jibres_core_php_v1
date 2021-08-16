<?php
namespace content_site\body\blog;


class b6
{

	/**
	 * Style 1
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function option()
	{
		$master_option = option::master_option();

		\content_site\utility::unset_option($master_option, 'post_show_author');
		\content_site\utility::unset_option($master_option, 'post_show_image');
		\content_site\utility::unset_option($master_option, 'post_show_date');


		\content_site\options\background\background_pack::remove_from_list('coverratio');

		return
		[
			'title'        => T_("Modern View"),
			'default'      => option::master_default(['type' => 'b6']),
			'options'      => $master_option,
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
			'preview_title'  => T_("Card"),
			'version'        => 1,
		];
	}


}
?>