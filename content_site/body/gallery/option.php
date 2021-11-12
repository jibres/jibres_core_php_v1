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
			'section' => 'gallery',
			'title'   => T_("Gallery"),
			'icon'    => \dash\utility\icon::url('Image'),
		];
	}



	/**
	 * Get model list
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function model_list()
	{
		return
		[
			'g1',
			'g2',
			'g3',
			'g4',
			'g5',
			'g6',
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


	public static function maximum_capacity($_type)
	{
		$option = \content_site\call_function::section_options('gallery', $_type);

		if(isset($option['maximum_capacity']))
		{
			return intval($option['maximum_capacity']);
		}
		return 12;

	}


	/**
	 * After save page move all preview menu field to real menu field
	 *
	 * @param      <type>  $_section_id  The section identifier
	 */
	public static function after_save_page($_section_id = null)
	{
		$list = \lib\app\menu\get::get_by_for_id('gallery', $_section_id);

		if(!is_array($list))
		{
			$list = [];
		}

		foreach ($list as $key => $value)
		{
			if(a($value, 'preview', 'is_removed'))
			{
				\lib\app\menu\remove::remove($value['id'], true);
			}
			else
			{
				$update = $value['preview'];

				unset($update['is_removed']);
				unset($update['is_preview_menu']);
				unset($update['is_saved_menu']);
				unset($update['parent1']);
				unset($update['parent2']);
				unset($update['parent3']);
				unset($update['parent4']);
				unset($update['parent5']);

				\lib\app\menu\edit::edit($update, $value['id'], true);

				$preview = $value['preview'];

				$preview['is_preview_menu'] = false;
				$preview['is_saved_menu'] = true;

				$preview = json_encode($preview);

				\lib\db\menu\update::pdo_update(['preview' => $preview,], $value['id']);
			}
		}

		\dash\notif::clean(true);

	}


	/**
	 * Get list of gallery item
	 *
	 * @param      <type>  $_section_id  The section identifier
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function gallery_items($_section_id, $_preview_mode)
	{
		$list = \lib\app\menu\get::get_by_for_id('gallery', $_section_id);

		if(!is_array($list))
		{
			$list = [];
		}

		$new_list = [];

		foreach ($list as $key => $value)
		{
			if($_preview_mode)
			{
				if(a($value, 'preview', 'is_removed'))
				{
					// is removed !
				}
				else
				{
					if(a($value, 'url') && !a($value, 'preview', 'url'))
					{
						$value['preview']['url'] = a($value, 'url');
					}
					$value = array_merge($value, $value['preview']);

					$new_list[] = $value;
				}
			}
			else
			{
				if(a($value, 'preview', 'is_saved_menu'))
				{
					$new_list[] = $value;
				}
			}
		}

		if($_preview_mode)
		{
			$sort_column = array_column($new_list, 'sort');

			if(count($sort_column) === count($new_list))
			{
				array_multisort($new_list, SORT_ASC, SORT_NUMERIC, $sort_column);
			}
		}

		return $new_list;
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

		$menu = array_merge($menu, $menu['preview']);

		// if(is_array(a($menu, 'preview', 'meta')))
		// {
		// 	$menu = array_merge($menu, $menu['preview']['meta']);
		// }

		$menu['index']      = $index;
		$menu['section_id'] = $currentSectionDetail['id'];

		return $menu;
	}


	public static function sort_gallery_items($_sort)
	{
		$sort = array_map('floatval', $_sort);
		$sort = array_filter($sort);
		$sort = array_unique($sort);

		if(!$sort)
		{
			return;
		}


		$currentSectionDetail = \dash\data::currentSectionDetail();

		if(!$currentSectionDetail || !isset($currentSectionDetail['id']))
		{
			return false;
		}

		$items = self::gallery_items($currentSectionDetail['id'], true);

		foreach ($items as $item)
		{
			$id = a($item, 'id');
			if(($mySort = array_search($id, $sort)) !== false)
			{
				self::update_menu_preview([], $id, ['sort' => $mySort]);
			}
		}

		\content_site\utility::need_redirect(true);
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
		$count = self::gallery_items($_section_id, true);

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

		\dash\notif::clean(true);

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

		$preview_option =  \content_site\call_function::section_model_preview('gallery', $_type, $_preview_key);

		if(isset($preview_option['options']['image_count']))
		{
			$max = intval($preview_option['options']['image_count']);
		}
		else
		{
			$max = self::maximum_capacity($_type);
		}

		if(!is_numeric($max) || !$max)
		{
			return;
		}

		$menu_id = self::add_menu_for_gallery($_section_id);
		if(!$menu_id)
		{
			return false;
		}

		for ($i=1; $i <= $max; $i++)
		{
			self::add_menu_child_as_gallery_item($_section_id, $menu_id, $i);
		}

	}

	public static function add_menu_for_gallery($_section_id)
	{
		$insert_menu =
		[
			'title'  => 'gallery-'. $_section_id,
			'for'    => 'gallery',
			'for_id' => $_section_id,
		];

		$result_add_menu = \lib\app\menu\add::add($insert_menu, true);

		if(a($result_add_menu, 'id'))
		{
			return $result_add_menu['id'];
		}
		else
		{
			\dash\log::oops('dbInsertGalleryMenuError');
			return false;
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
	public static function after_change_model($_section_id = null, $_type = null, $_preview_key = null)
	{
		if(!$_section_id || !$_type)
		{
			return;
		}


		$preview_option =  \content_site\call_function::section_model_preview('gallery', $_type, $_preview_key);

		if(isset($preview_option['options']['image_count']))
		{
			$max = intval($preview_option['options']['image_count']);
		}
		else
		{
			$max = self::maximum_capacity($_type);
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
			$list = self::gallery_items($_section_id, true);

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

			\dash\notif::clean(true);
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
		$maximum_capacity = self::maximum_capacity($_type);

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
		$maximum_capacity = self::maximum_capacity($_type);

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
	public static function add_menu_child_as_gallery_item($_section_id, $_menu_id, $_number = 1, $_args = [])
	{

		$insert_menu_child =
		[
			'title'  => T_("Image :val", ['val' => \dash\fit::number($_number)]),
			'for'    => 'gallery',
			'for_id' => $_section_id,
			'sort'   => $_number,
		];

		$insert_menu_child = array_merge($insert_menu_child, $_args);

		$last_menu_id = \lib\app\menu\add::menu_item($insert_menu_child, $_menu_id, true);

		if(a($last_menu_id, 'id'))
		{
			self::update_menu_preview($insert_menu_child, a($last_menu_id, 'id'));
		}

		\dash\notif::clean(true);

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
		$type       = a($gallery, 'preview', 'model');
		$section_id = a($gallery, 'id');

		// \lib\app\menu\edit::edit($_args, $index, true);

		self::update_menu_preview($_args, $index);

		if(\dash\engine\process::status())
		{
			\dash\notif::clean(true);
		}

		return true;
	}


	private static function update_menu_preview($_args, $_id, $_meta = [])
	{
		$preview = [];

		\dash\pdo::transaction();

		$record = \lib\db\menu\get::pdo_get_for_update($_id);

		if(isset($record['preview']))
		{
			$preview = json_decode($record['preview'], true);

			if(!is_array($preview))
			{
				$preview = [];
			}
		}

		$option = [];

		$args = \lib\app\menu\edit::edit($_args, $_id, true, true, $option);


		if(!is_array($_meta))
		{
			$_meta = [];
		}

		if(!is_array($args))
		{
			$args = [];
		}

		$args = array_merge($preview, $args, $_meta);

		$args['is_preview_menu'] = true;

		$args = json_encode($args);

		\lib\db\menu\update::pdo_update(['preview' => $args], $_id);

		\dash\pdo::commit();

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

		$option = \content_site\call_function::section_options('gallery', \dash\data::currentSectionDetail_model());

		if(isset($option['minimum_item']) && is_numeric($option['minimum_item']))
		{
			$min = intval($option['minimum_item']);
		}
		else
		{
			$min = 1;
		}

		if(intval(self::gallery_items_count($gallery['section_id'])) - 1 < $min)
		{
			if($min > 1)
			{
				\dash\notif::error(T_("On this gallery model you need at least :min item", ['min' => \dash\fit::number($min)]));
			}
			else
			{
				\dash\notif::error(T_("Can not remove last gallery item"));
			}

			return false;
		}

		$index      = a($gallery, 'index');

		self::update_menu_preview([], $index, ['is_removed' => true]);

		// \lib\app\menu\remove::remove($index, true);

		if(\dash\engine\process::status())
		{
			\dash\notif::clean(true);
		}

		return true;


	}

}
?>