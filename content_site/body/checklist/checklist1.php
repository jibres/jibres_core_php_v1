<?php
namespace content_site\body\checklist;


class checklist1
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
			'title'        => T_("Checklist 1"),
			'options'      =>
			[
				'heading',
				'checklist_list' =>
				[
					'checklist_title',
					'checklist_link',
					// 'checklist_text',
					'checklist_status',
					'checklist_remove',
				],
				'checklist_add',
				'checklist_random',

				'style' => \content_site\utility::set_style_option(
				[
					'font',
					'background_pack',
					'justify_heading',
					'heading_size',
				]),
				'spacing' =>
				[
					'height',
					'padding_top',
					'padding_bottom',
					'container_checklist',
				],
				'responsive' =>
				[
					'responsive_device',
				],
			],
			'default'      =>
			[
				'heading'          => T_("checklist"),
				'height'           => 'auto',
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



	/**
	 * Auto Generate Function
	 * @date 2022-07-13 19:06:01
	 * @author rm.biqarar@gmail.com
	 *
	 * @path content_site/body/checklist/checklist1.php
	 * body / checklist / checklist1 / p1
	 *
	*/
	public static function p1()
	{
		return
		[
			'version' => 1,
			'options' =>
			[
				'height'  => 'auto',
				'heading' => T_("checklist"),
			],
		];
	}
	// path content_site/body/checklist/checklist1.php
	// body / checklist / checklist1 / p1
}
?>