<?php
namespace content_site\section;


class model
{
	public static function post()
	{
		/**
		 * Save option of one section
		 */
		if(\dash\url::child())
		{
			self::save_options();
		}
		else
		{
			/**
			 * Add or select new option
			 */
			self::add_new_section();
		}

		\dash\notif::complete();

		\dash\notif::reloadIframe();
	}




	/**
	 * Saves options.
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	public static function save_options()
	{
		$page_id    = \dash\request::get('id');
		$section_id = \dash\request::get('sid');
		$section_id = \dash\validate::id($section_id);
		$subchild   = \dash\url::subchild();
		$child      = \dash\url::child();
		$index      = \dash\request::get('index');

		if(!$section_id)
		{
			\dash\notif::error(T_("Invalid section id"). ' '. __LINE__);
			return false;
		}

		// remove or hidden section
		if(self::remove_or_hidden_section($section_id))
		{
			return;
		}

		// restore section
		if(self::restore_section($section_id))
		{
			return;
		}

		// discard section
		if(self::discard_section($section_id))
		{
			return;
		}

		// set section sort
		if(\dash\request::post('set_sort_child'))
		{
			return self::set_sort_child($section_id);
		}

		// remove one block
		if(self::remove_block($section_id))
		{
			return;
		}

		$trust_options_list_raw = \dash\data::currentOptionList();
		$trust_options_list     = [];

		foreach ($trust_options_list_raw as $key => $value)
		{
			if(is_array($value))
			{
				$trust_options_list[] = $key;
				$trust_options_list = array_merge($trust_options_list, $value);
			}
			else
			{
				$trust_options_list[] = $value;
			}
		}

		$option_key = null;
		$myPost     = [];

		$all_post = \dash\request::post();

		foreach ($all_post as $key => $value)
		{
			if(substr($key, 0, 4) === 'opt_')
			{
				$option_key = substr($key, 4);
				$myPost[$option_key] = $value;
			}
			else
			{
				$myPost[$key] = $value;
			}
		}

		if(!$option_key || !is_string($option_key))
		{
			\dash\notif::error(T_("Option key not found!"). ' '. __LINE__);
			return false;
		}


		if(in_array($option_key, $trust_options_list))
		{
			// ok
		}
		else
		{
			\dash\notif::error(T_("Invalid option"). ' '. __LINE__);
			return false;
		}

		// save multi option
		if(\dash\request::post('multioption') === 'multi')
		{
			$value = $myPost;
		}
		elseif(\dash\request::post('specialsave') === 'specialsave')
		{
			return \content_site\call_function::option_specialsave($option_key, $myPost);
		}
		else
		{
			$value = \dash\request::post('opt_'. $option_key);
		}

		$value = \content_site\call_function::option_validator($option_key, $value);

		if(!\dash\engine\process::status())
		{
			\dash\notif::error_once(T_("Please check your input"));
			return false;
		}

		if(\dash\data::changeSectionTypeMode())
		{
			// need overwrite preview detail
			// load preview setting from function
			// remove preview index fox example fill_default_data

			$preview_key = \dash\request::post('preview_key');

			$preview_key = \dash\validate::string_100($preview_key);

			if(!$preview_key)
			{
				\dash\notif::error(T_("Invalid preview_key"));
				return false;
			}

			$load_preview = \content_site\call_function::preview($child, $preview_key);

			if(!is_array($load_preview))
			{
				\dash\notif::error(T_("Invalid preview key"));
				return false;
			}

			unset($load_preview['fill_defult_data']);

			$value = $load_preview;

		}

		// reload section detail to get last update
		// for example in upload file need this line
		\dash\pdo::transaction();

		$load_section_lock = \lib\db\pagebuilder\get::by_id_lock($section_id);

		if(!$load_section_lock)
		{
			\dash\pdo::rollback();

			\dash\notif::error(T_("Section not found"). ' '. __LINE__);

			return false;
		}

		$preview = json_decode($load_section_lock['preview'], true);

		// check option database name is different by option key
		$option_db_key = $option_key;

		$check_option_db_key = \content_site\call_function::option_db_key($option_key);

		if($check_option_db_key && is_string($check_option_db_key))
		{
			$option_db_key = $check_option_db_key;
		}

		if($subchild && $index)
		{
			if(isset($preview[$subchild]) && is_array($preview[$subchild]))
			{
				foreach ($preview[$subchild] as $k => $v)
				{
					if(isset($v['index']) && $v['index'] === $index)
					{
						// save multi option
						if(is_array($value))
						{
							foreach ($value as $my_key => $val)
							{
								$preview[$subchild][$k][$my_key] = $val;
							}
						}
						else
						{
							$preview[$subchild][$k][$option_db_key] = $value;
						}
					}
				}
			}
			else
			{
				// in mode galler we need the index
				\dash\notif::error(T_("Can not save this index!"));
				\dash\pdo::rollback();
				return false;
			}

		}
		else
		{
			// save multi option
			if(is_array($value))
			{
				foreach ($value as $my_key => $val)
				{
					$preview[$my_key] = $val;
				}
			}
			else
			{
				$preview[$option_db_key] = $value;
			}
		}

		$preview           = json_encode($preview);

		\dash\pdo\query_template::update('pagebuilder', ['preview' => $preview], $section_id);

		\dash\pdo::commit();


		if(\dash\data::changeSectionTypeMode())
		{
			\dash\redirect::to(\dash\url::that(). \dash\request::full_get());
			$need_redirect = true;
		}

		// force set redirect
		if(\content_site\utility::need_redirect())
		{
			\dash\notif::reloadIframe();
			\dash\redirect::pwd();
		}

		if(\dash\url::subchild() === 'style')
		{
			\dash\notif::reloadIframe();

			if(\dash\request::post('notredirect'))
			{
				// nothing
			}
			else
			{
				\dash\redirect::pwd();
			}
		}


	}


	private static function remove_or_hidden_section($section_id)
	{

		// delete or hide a section
		if(\dash\request::post('delete') === 'section' || \dash\request::post('hide_view') === 'toggle')
		{
			$load_section_lock = \lib\db\pagebuilder\get::by_id($section_id);

			if(!$load_section_lock || !is_array($load_section_lock))
			{
				\dash\notif::error(T_("Section not found"). ' '. __LINE__);

				return true;
			}

			if(\dash\request::post('delete') === 'section')
			{

				if(a($load_section_lock, 'status') === 'draft')
				{
					// delete section because the master status is draft
					\lib\db\pagebuilder\delete::by_id($section_id);
				}
				else
				{
					// update preview status on deleted to delete when save page
					\content_site\update_record::patch_field($section_id, 'status_preview', 'deleted');
				}

				\dash\notif::reloadIframe();

				\dash\redirect::to(\dash\url::here(). '/page'. \dash\request::full_get(['sid' => null]));

				return true;
			}

			if(\dash\request::post('hide_view') === 'toggle')
			{

				$load_section_lock = view::ready_section_list($load_section_lock);

				if($load_section_lock['status_preview'] === 'hidden')
				{
					$new_status = 'draft';
				}
				else
				{
					$new_status = 'hidden';
				}

				\content_site\update_record::patch_field($section_id, 'status_preview', $new_status);

				\dash\notif::reloadIframe();
				\dash\redirect::pwd();
				// \dash\notif::complete();

				// set hide and view section
				return true;
			}
		}

		return false;
	}


	private static function discard_section($section_id)
	{

		// delete or hide a section
		if(\dash\request::post('discard') === 'discard')
		{
			$load_section = \lib\db\pagebuilder\get::by_id($section_id);

			if(!$load_section || !is_array($load_section))
			{
				\dash\notif::error(T_("Section not found"). ' '. __LINE__);

				return true;
			}


			\content_site\update_record::patch_field($section_id, 'preview', a($load_section, 'body'));

			\dash\notif::reloadIframe();

			\dash\redirect::pwd();

			return true;
		}

		return false;
	}



	private static function restore_section($section_id)
	{

		// delete or hide a section
		if(\dash\request::post('restore') === 'section')
		{
			$load_section = \lib\db\pagebuilder\get::by_id($section_id);

			if(!$load_section || !is_array($load_section))
			{
				\dash\notif::error(T_("Section not found"). ' '. __LINE__);

				return true;
			}

			$myStatus = 'draft';
			if(a($load_section, 'status'))
			{
				$myStatus = $load_section['status'];
			}

			\content_site\update_record::patch_field($section_id, 'status_preview', $myStatus);

			\dash\notif::reloadIframe();

			\dash\redirect::pwd();

			return true;
		}

		return false;
	}


	private static function remove_block($section_id)
	{
		$subchild = \dash\url::subchild();
		$index    = \dash\request::get('index');

		if(\dash\request::post('delete') === 'block' && \dash\request::get('index') && \dash\url::subchild())
		{
			\dash\pdo::transaction();

			$load_section_lock = \lib\db\pagebuilder\get::by_id_lock($section_id);

			if(!$load_section_lock)
			{
				\dash\pdo::rollback();

				\dash\notif::error(T_("Section not found"). ' '. __LINE__);

				return true;
			}

			$preview = json_decode($load_section_lock['preview'], true);

			if(isset($preview[$subchild]) && is_array($preview[$subchild]))
			{
				foreach ($preview[$subchild] as $key => $value)
				{
					if(isset($value['index']) && $value['index'] === $index)
					{
						unset($preview[$subchild][$key]);
					}
				}

				$preview           = json_encode($preview);

				\dash\pdo\query_template::update('pagebuilder', ['preview' => $preview], $section_id);

				\dash\pdo::commit();

				\dash\notif::reloadIframe();

				\dash\redirect::to(view::generate_back_url());

				return true;
			}
			else
			{
				\dash\notif::error(T_("Can not remove this block!"));
				\dash\pdo::rollback();
				\dash\redirect::to(view::generate_back_url());
				return true;
			}
		}

		return false;
	}

	/**
	 * Sets the sort child.
	 * for example set image sort in gallery
	 *
	 * @param      <type>  $section_id  The section identifier
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	private static function set_sort_child($section_id)
	{
		// reload section detail to get last update
		// for example in upload file need this line
		\dash\pdo::transaction();

		$load_section_lock = \lib\db\pagebuilder\get::by_id_lock($section_id);

		if(!$load_section_lock)
		{
			\dash\pdo::rollback();

			\dash\notif::error(T_("Section not found"). ' '. __LINE__);

			return false;
		}

		$preview = json_decode($load_section_lock['preview'], true);

		if(!is_array($preview))
		{
			\dash\notif::error(T_("Invalid preview detail"));
			\dash\pdo::rollback();
			return false;
		}


		$sort_child = \dash\request::post('sort_child');
		$sort_child = \dash\validate::sort($sort_child);
		if(!$sort_child)
		{
			\dash\notif::error(T_("Invalid sort arguments"));
			\dash\pdo::rollback();

			return false;
		}

		$sort_child = array_values($sort_child);

		$subchild = \dash\request::post('child_key');

		if(!isset($preview[$subchild]) || (isset($preview[$subchild]) && !is_array($preview[$subchild])))
		{
			\dash\notif::error(T_("This section have not sortable item!"));
			\dash\pdo::rollback();
			return false;
		}

		if(count($sort_child) !== count($preview[$subchild]))
		{
			\dash\notif::warn(T_("Some item have problem in sorting. Need load again"));
			\dash\pdo::rollback();
			\dash\redirect::pwd();
			return false;
		}

		foreach ($preview[$subchild] as $key => $value)
		{
			if(isset($value['index']) && in_array($value['index'], $sort_child))
			{
				$preview[$subchild][$key]['sort'] = array_search($value['index'], $sort_child);
				// ok
			}
			else
			{
				\dash\notif::warn(T_("Some item have problem in sorting. Need load again"));
				\dash\pdo::rollback();
				\dash\redirect::pwd();
				return false;
			}
		}

		$child = $preview[$subchild];

		$sort_index = array_column($child, 'sort');

		array_multisort($child, SORT_ASC, SORT_NUMERIC, $sort_index);

		$preview[$subchild] = array_values($child);

		$preview           = json_encode($preview);

		\dash\pdo\query_template::update('pagebuilder', ['preview' => $preview], $section_id);

		\dash\pdo::commit();

		\dash\notif::complete();

		return true;

	}


	/**
	 * Adds a new section.
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	private static function add_new_section()
	{
		$page_id = \dash\request::get('id');
		$page_id = \dash\coding::decode($page_id);

		if(!$page_id)
		{
			\dash\notif::error(T_("Invali page id"));
			return false;
		}

		$key = \dash\request::post('key');

		$key = \dash\validate::string_100($key);

		if(!$key)
		{
			\dash\notif::error(T_("Invalid key"));
			return false;
		}

		$type = \dash\request::post('type');

		$type = \dash\validate::string_100($type);

		if(!$type)
		{
			\dash\notif::error(T_("Invalid type"));
			return false;
		}

		$preview_key = \dash\request::post('preview_key');

		$preview_key = \dash\validate::string_100($preview_key);

		if(!$preview_key)
		{
			\dash\notif::error(T_("Invalid preview_key"));
			return false;
		}

		$section_list = controller::section_list();
		$all_key = array_column($section_list, 'key');

		if(!in_array($key, $all_key))
		{
			\dash\notif::error(T_("Can not chose this section!"));
			return false;
		}

		$load_preview = \content_site\call_function::preview($key, $preview_key);

		if(!is_array($load_preview))
		{
			\dash\notif::error(T_("Invalid preview key"));
			return false;
		}

		$load_default = \content_site\call_function::default($key);

		if(!is_array($load_default))
		{
			$load_default = [];
		}

		$preview = ['key' => $key, 'type' => $type];

		$preview = array_merge($preview,  $load_default, $load_preview);

		$mode = \content_site\call_function::get_folder($key);

		$update_record = null;

		if($mode === 'header' || $mode === 'footer')
		{
			$check_duplicate = \lib\db\sitebuilder\get::check_duplicate_mode($page_id, $mode);
			if(isset($check_duplicate['id']))
			{
				$update_record = $check_duplicate['id'];
			}

			if(isset($check_duplicate['preview']) && is_string($check_duplicate['preview']))
			{
				$old_preview = json_decode($check_duplicate['preview'], true);
				if(is_array($old_preview))
				{
					$preview = array_merge($old_preview, $preview);
				}
			}
		}
		else
		{
			$mode = 'body';
		}

		$preview = json_encode($preview);

		$insert                   = [];
		$insert['mode']           = $mode;
		$insert['type']           = $key;
		$insert['related']        = 'posts';
		$insert['related_id']     = $page_id;
		$insert['title']          = null;
		$insert['preview']        = $preview;
		$insert['status']         = 'draft';
		$insert['status_preview'] = 'draft';
		$insert['datecreated']    = date("Y-m-d H:i:s");

		$get_last_sort_args =
		[
			'related'    => $insert['related'],
			'related_id' => $insert['related_id'],
			// need add some args later
		];

		$get_last_sort = \lib\db\pagebuilder\get::last_sort($get_last_sort_args);

		if(!$get_last_sort || !is_numeric($get_last_sort))
		{
			$insert['sort'] = 10;
		}
		else
		{
			$insert['sort'] = (floor(intval($get_last_sort) / 10) * 10) + 10;
		}

		$insert['sort_preview'] = $insert['sort'];

		if($update_record)
		{
			\lib\db\sitebuilder\update::record($insert, $update_record);
			$id = $update_record;

		}
		else
		{
			$id = \lib\db\sitebuilder\insert::new_record($insert);

			if(!$id)
			{
				\dash\notif::error(T_("No way to save data"));
				return false;
			}
		}


		$url = \dash\url::this(). '/';
		$url .= $key;
		$url .= \dash\request::full_get(['sid' => $id, 'list' => null, 'preview' => null]);

		\dash\redirect::to($url);

	}

}
?>