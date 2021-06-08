<?php
namespace content_site\ganje\blog;


class option
{

	/**
	 * Call when try to add or choose section
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	public static function allow()
	{
		return true;
	}


	/**
	 * Call when publish the page
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function premium()
	{
		return self::allow();
	}


	/**
	 * Get detail
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function detail()
	{
		$detail =
		[
			'group' => T_("Blog"),
			'title' => T_("Blog posts"),
			'key'   => 'blog',
			'icon'  => \dash\utility\icon::url('Blog'),
		];

		return $detail;
	}


	/**
	 * Get style list
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function style_list()
	{
		return
		[
			['key' => 'style_1', 'title' => T_("Classic View")],
			// ['key' => 'style_2', 'title' => T_("Modern View"), 'default' => true,]
		];
	}


	/**
	 * Get current option by check style
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function options()
	{
		$currentSectionDetail = \dash\data::currentSectionDetail();

		$style = null;

		if(isset($currentSectionDetail['preview']['style']) && $currentSectionDetail['preview']['style'])
		{
			$style = $currentSectionDetail['preview']['style'];
		}
		else
		{
			$style = 'style_1';
		}

		$style_detail = call_user_func(['self', $style]);

		return $style_detail['options'];

	}


	/**
	 * Public default
	 */
	private static function master_default()
	{
		return
		[
			'heading'        => T_("Post blog"),
			'post_template'  => 'standard',
		];
	}


	/**
	 * Style 1
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function style_1()
	{
		return
		[
			'key'       => 'style_1',
			'title'     => T_("Classic View"),
			'default'   => self::master_default(),
			'options'   =>
			[
				'heading',
				'view_all_btn',
				'post_tag',
				'post_template',
				'limit',
				'avand',
				'padding',
				'radius',
			],
		];
	}

}
?>