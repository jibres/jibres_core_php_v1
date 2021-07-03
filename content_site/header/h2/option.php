<?php
namespace content_site\header\h2;


class option
{


	/**
	 * Call when publish the page
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function premium()
	{
		return false;
	}



	/**
	 * Get detail
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function detail()
	{
		return
		[
			'group'   => T_("Header"),
			'key'     => 'h2',
			'title'   => T_("Header 2"),
			'icon'    => \dash\utility\icon::url('Header'),
		];
	}



	/**
	 * Get type list
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function type_list()
	{
		return
		[
			[
				'type'   => 'type_1',
				'title'   => T_("Header 2"),
				'default' => true
			],
		];

	}



	/**
	 * Get current option by check type
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function option($_data, $_mode = null)
	{

		$type = null;

		if(isset($_data['preview']['type']) && $_data['preview']['type'])
		{
			$type = $_data['preview']['type'];
		}
		else
		{
			// Hey! if change this variable you must change the default type in type_list function
			$type = 'type_1';
		}

		$type_detail = [];

		if(is_callable(['self', $type]))
		{
			$type_detail = call_user_func(['self', $type]);
		}

		// get full option
		if($_mode === 'full')
		{
			return $type_detail;
		}

		if(isset($type_detail['options']))
		{
			return $type_detail['options'];
		}

		return [];
	}




	/**
	 * Style 1
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function type_1()
	{
		return
		[
			'key'     => __FUNCTION__,
			'title'   => T_("Header 2"),
			'default' =>
			[
				'heading'     => \lib\store::title(),
				'description' => \lib\store::desc(),
			],
			'options' =>
			[
				'heading',
				'description',
				'header_change',
			],
		];
	}



}
?>