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
	 * Get list of gallery item
	 *
	 * @param      <type>  $_section_id  The section identifier
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function gallery_items($_section_id)
	{
		$list = \lib\app\menu\get::get_by_for_id('gallery', $_section_id);

		if(!is_array($list))
		{
			$list = [];
		}

		return $list;
	}


	/**
	 * Gets the current item.
	 *
	 * @return     bool  The current item.
	 */
	public static function get_current_item()
	{
		$index = \dash\request::get('index');

		$index = \dash\validate::id($index);

		if(!$index)
		{
			return false;
		}

		$currentSectionDetail = \dash\data::currentSectionDetail();

		if(!$currentSectionDetail || !isset($currentSectionDetail['id']))
		{
			return false;
		}

		$menu = \lib\app\menu\get::load_one_by_for_id('gallery', $currentSectionDetail['id'], $index);

		if(!$menu)
		{
			return false;
		}

		$menu['index']       = $index;
		$menu['section_id'] = $currentSectionDetail['id'];

		return $menu;
	}


	/**
	 * Get count of current gallery item
	 *
	 * @param      <type>  $_section_id  The section identifier
	 *
	 * @return     int     ( description_of_the_return_value )
	 */
	public static function gallery_items_count($_section_id)
	{
		$count = self::gallery_items($_section_id);

		if(is_array($count))
		{
			return count($count);
		}

		return 0;
	}


	/**
	 * Gets the master menu identifier.
	 * For use in add child in menu [As gallery item]
	 *
	 * @param      <type>  $_section_id  The section identifier
	 *
	 * @return     bool    The master menu identifier.
	 */
	public static function get_master_menu_id($_section_id)
	{
		$menu = \lib\app\menu\get::parent_by_for_id('gallery', $_section_id);

		if(isset($menu['id']))
		{
			return $menu['id'];
		}

		return false;
	}


	public static function before_section_remove($_section_id = null)
	{
		if(!$_section_id)
		{
			return;
		}

		$menu_id = self::get_master_menu_id($_section_id);

		if(!$menu_id)
		{
			return;
		}

		\lib\app\menu\remove::remove($menu_id, true);

		\dash\notif::clean();

	}

	/**
	 * After add new gallery we need to create menu and add some child to that menu
	 *
	 * @param      <type>  $_section_id  The section identifier
	 * @param      <type>  $_type        The type
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	public static function after_add_section($_section_id = null, $_type = null, $_preview_key = null)
	{
		if(!$_section_id || !$_type)
		{
			return;
		}

		$preview_option =  \content_site\call_function::section_type_preview('gallery', $_type, $_preview_key);

		if(isset($preview_option['options']['image_count']))
		{
			$max = intval($preview_option['options']['image_count']);
		}
		else
		{
			$max = \content_site\call_function::section_type_fn('gallery', $_type, 'maximum_capacity');
		}

		if(!is_numeric($max) || !$max)
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

		for ($i=1; $i <= $max; $i++)
		{
			self::add_menu_child_as_gallery_item($_section_id, $menu_id, $i);
		}

	}


	/**
	 * After change type of gallery we need to recalculate gallery item
	 * If need add some item
	 * Else remove some item
	 *
	 * @param      <type>  $_section_id  The section identifier
	 * @param      <type>  $_type        The type
	 */
	public static function after_change_type($_section_id = null, $_type = null, $_preview_key = null)
	{
		if(!$_section_id || !$_type)
		{
			return;
		}


		$preview_option =  \content_site\call_function::section_type_preview('gallery', $_type, $_preview_key);

		if(isset($preview_option['options']['image_count']))
		{
			$max = intval($preview_option['options']['image_count']);
		}
		else
		{
			$max = \content_site\call_function::section_type_fn('gallery', $_type, 'maximum_capacity');
		}

		if(!is_numeric($max) || !$max)
		{
			return;
		}

		// get current gallery item
		$gallery_items_count = intval(self::gallery_items_count($_section_id));

		$remain = $max - $gallery_items_count;

		if($remain > 0)
		{
			$master_id = self::get_master_menu_id($_section_id);

			for ($i=1; $i <= $remain; $i++)
			{
				self::add_menu_child_as_gallery_item($_section_id, $master_id, $i);
			}
		}
		else
		{
			/**
			 * remove useless items by check datemodified
			 */
			$list = self::gallery_items($_section_id);

			$must_remove = abs($remain);

			$count_removed = 0;

			foreach ($list as $key => $value)
			{
				if($count_removed < $must_remove)
				{
					if(a($value, 'datemodified'))
					{
						// can not beremove
					}
					else
					{
						$count_removed++;

						\lib\app\menu\remove::remove($value['id'], true);
					}
				}
			}

			\dash\notif::clean();
		}
	}


	/**
	 * Allow capapcity to add new item
	 *
	 * @param      <type>  $_section_id  The section identifier
	 * @param      <type>  $_type        The type
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	public static function allow_capacity($_section_id, $_type)
	{
		$maximum_capacity = \content_site\call_function::section_type_fn('gallery', $_type, 'maximum_capacity');

		if(!is_numeric($maximum_capacity) || !$maximum_capacity)
		{
			return true;
		}
		// get current gallery item
		$gallery_items_count = intval(self::gallery_items_count($_section_id));

		if($gallery_items_count >= $maximum_capacity)
		{
			return false;
		}

		return true;
	}


	/**
	 * Appends a gallery item.
	 *
	 * @param      <type>  $_section_id  The section identifier
	 * @param      <type>  $_type        The type
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	public static function append_gallery_item($_section_id, $_type)
	{
		$maximum_capacity = \content_site\call_function::section_type_fn('gallery', $_type, 'maximum_capacity');

		if(!is_numeric($maximum_capacity) || !$maximum_capacity)
		{
			return;
		}
		// get current gallery item
		$gallery_items_count = intval(self::gallery_items_count($_section_id));



		if($gallery_items_count >= $maximum_capacity)
		{
			\dash\notif::error(T_("Maximum capacity of this gallery is full"));
			return false;
		}

		return self::add_menu_child_as_gallery_item($_section_id, self::get_master_menu_id($_section_id), $gallery_items_count + 1);
	}


	/**
	 * Adds a menu child as gallery item.
	 *
	 * @param      <type>  $_section_id  The section identifier
	 * @param      <type>  $_menu_id     The menu identifier
	 * @param      int     $_number      The number
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function add_menu_child_as_gallery_item($_section_id, $_menu_id, $_number = 1)
	{

		$insert_menu_child =
		[
			'title'  => T_("Image :val", ['val' => \dash\fit::number($_number)]),
			'for'    => 'gallery',
			'for_id' => $_section_id,
			'sort'   => $_number,
		];

		$last_menu_id = \lib\app\menu\add::menu_item($insert_menu_child, $_menu_id, true);

		\dash\notif::clean();

		return a($last_menu_id, 'id');
	}


	/**
	 * Update current gallery item
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public static function update_one_gallery_item($_args)
	{
		$gallery = self::get_current_item();

		if(!$gallery)
		{
			\dash\notif::error(T_("Invalid index"));
			return false;
		}

		$index      = a($gallery, 'index');
		$type       = a($gallery, 'preview', 'type');
		$section_id = a($gallery, 'id');

		\lib\app\menu\edit::edit($_args, $index, true);

		if(\dash\engine\process::status())
		{
			\dash\notif::clean();
		}

		return true;
	}


		/**
	 * Update current gallery item
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public static function remove_current_gallery_item()
	{
		$gallery = self::get_current_item();

		if(!$gallery)
		{
			\dash\notif::error(T_("Invalid index"));
			return false;
		}

		if(intval(self::gallery_items_count($gallery['section_id'])) === 1)
		{
			\dash\notif::error(T_("Can not remove last gallery item"));
			return false;
		}

		$index      = a($gallery, 'index');


		\lib\app\menu\remove::remove($index, true);

		if(\dash\engine\process::status())
		{
			\dash\notif::clean();
		}

		return true;


	}

}
?>