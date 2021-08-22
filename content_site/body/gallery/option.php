<?php
namespace content_site\body\gallery;


class option
{

	/**
	 * Call when publish the page
	 *
	 * @return     bool  ( description_of_the_return_value )
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
			'group'   => T_("Image"),
			'key'     => 'gallery',
			'title'   => T_("Gallery"),
			'icon'    => \dash\utility\icon::url('Image'),
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
			'g1',
			'g2',
			'g3',
		];

	}


	public static function popular()
	{
		return
		[
			'g1:p1',
			'g2:p1',
			'g3:p1',
		];
	}




	/**
	 * Fill by sample image
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function default_image_list($_count = 3)
	{
		$list = [];

		for ($i=0; $i < $_count ; $i++)
		{
			$list[] =
			[
				"image"   => \dash\sample\img::image(),
				"caption" => T_("Image"),
			];
		}

		return $list;
	}




	/**
	 * Public default
	 */
	public static function master_default($_special_default = [], $_count = 3)
	{
		$master_default =
		[
			'heading'           => T_("Image Gallery"),
			'image_list' => self::default_image_list($_count)

		];

		return array_merge($master_default, $_special_default);
	}


	/**
	 * Master option
	 *
	 * @param      array   $_special_default  The special default
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function master_option()
	{
		\content_site\options\background\background_pack::remove_from_list('coverratio');

		$option =
		[

			'heading_raw',
			'image_list' =>
			[
				'file_gallery',
				'caption',
				'link',
				'target',
			],
			'image_add',

			'description',
			'image_random',

			// sub page
			'style' => \content_site\options\style::option_list(),
		];

		return $option;
	}


	public static function current_gallery_item($_section_id)
	{
		$list = \lib\app\menu\get::get_by_for_id('gallery', $_section_id);

		if(!is_array($list))
		{
			$list = [];
		}

		return $list;
	}


	public static function current_gallery_item_count($_section_id)
	{
		$count = self::current_gallery_item($_section_id);

		if(is_array($count))
		{
			return count($count);
		}

		return 0;
	}




	public static function process_after_add_section($_section_id = null, $_type = null)
	{
		if(!$_section_id || !$_type)
		{
			return;
		}

		$maximum_capacity = \content_site\call_function::section_type_fn('gallery', $_type, 'maximum_capacity');

		if(!is_numeric($maximum_capacity) || !$maximum_capacity)
		{
			return;
		}

		$insert_menu =
		[
			'title'  => 'gallery-'. $_section_id,
			'for'    => 'gallery',
			'for_id' => $_section_id,
		];

		$result_add_menu = \lib\app\menu\add::add($insert_menu, true);

		if(a($result_add_menu, 'id'))
		{
			$menu_id = $result_add_menu['id'];
		}
		else
		{
			\dash\log::oops('dbInsertGalleryMenuError');
			return false;
		}

		for ($i=1; $i <= $maximum_capacity; $i++)
		{
			self::add_gallery_item($_section_id, $menu_id);
		}

	}


	public static function get_master_menu_id($_section_id)
	{
		$menu = \lib\app\menu\get::parent_by_for_id('gallery', $_section_id);

		if(isset($menu['id']))
		{
			return $menu['id'];
		}

		return false;
	}


	public static function process_after_change_type($_section_id = null, $_type = null)
	{
		if(!$_section_id || !$_type)
		{
			return;
		}

		$maximum_capacity = \content_site\call_function::section_type_fn('gallery', $_type, 'maximum_capacity');

		if(!is_numeric($maximum_capacity) || !$maximum_capacity)
		{
			return;
		}
		// get current gallery item
		$current_gallery_item_count = intval(self::current_gallery_item_count($_section_id));

		$remain = $maximum_capacity - $current_gallery_item_count;

		if($remain > 0)
		{
			$master_id = self::get_master_menu_id($_section_id);

			for ($i=1; $i <= $remain; $i++)
			{
				self::add_gallery_item($_section_id, $master_id);
			}
		}
		else
		{
			// try to remove useless items
		}
	}

	public static function allow_capacity($_section_id, $_type)
	{
		$maximum_capacity = \content_site\call_function::section_type_fn('gallery', $_type, 'maximum_capacity');

		if(!is_numeric($maximum_capacity) || !$maximum_capacity)
		{
			return true;
		}
		// get current gallery item
		$current_gallery_item_count = intval(self::current_gallery_item_count($_section_id));

		if($current_gallery_item_count >= $maximum_capacity)
		{
			return false;
		}

		return true;
	}


	public static function append_gallery_item($_section_id, $_type)
	{
		$maximum_capacity = \content_site\call_function::section_type_fn('gallery', $_type, 'maximum_capacity');

		if(!is_numeric($maximum_capacity) || !$maximum_capacity)
		{
			return;
		}
		// get current gallery item
		$current_gallery_item_count = intval(self::current_gallery_item_count($_section_id));



		if($current_gallery_item_count >= $maximum_capacity)
		{
			\dash\notif::error(T_("Maximum capacity of this gallery is full"));
			return false;
		}

		return self::add_gallery_item($_section_id, self::get_master_menu_id($_section_id), $current_gallery_item_count + 1);
	}


	private static function add_gallery_item($_section_id, $_menu_id, $_number = 1)
	{

		$insert_menu_child =
		[
			'title'  => T_("Image :val", ['val' => \dash\fit::number($_number)]),
			'for'    => 'gallery',
			'for_id' => $_section_id,
		];

		$last_menu_id = \lib\app\menu\add::menu_item($insert_menu_child, $_menu_id, true);


		\dash\notif::clean();

		return a($last_menu_id, 'id');
	}

}
?>