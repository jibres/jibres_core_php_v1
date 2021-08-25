<?php
namespace content_site\section;


class model
{
	private static $do_nothing_reload = false;
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

		self::reloadIframe();
	}


	private static function reloadIframe()
	{
		$page_url = \content_site\view::generate_iframe_src(true);

		if(self::$do_nothing_reload)
		{
			return;
		}

		\dash\notif::reloadIframeSrc($page_url);
		\dash\notif::reloadIframe();
	}




	/**
	 * Saves options.
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	public static function save_options()
	{
		$page_id       = \dash\request::get('id');
		$section_id    = \dash\request::get('sid');
		$section_id    = \dash\validate::id($section_id);
		$subchild      = \dash\url::subchild();
		$section_key   = \dash\url::child();
		$index         = \dash\request::get('index');
		$type          = null;
		$preview_key   = null;

		$update_record = [];

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


		$trust_options_list_raw = \dash\data::currentOptionList();
		if(!is_array($trust_options_list_raw))
		{
			$trust_options_list_raw = [];
		}

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

		$extends_option = \content_site\call_function::option_extends_option($option_key);

		if(is_array($extends_option))
		{
			$trust_options_list = array_merge($trust_options_list, $extends_option);
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

		/**
		 * Code can not be continue
		 * Because the special save edit everything need and complete process
		 * @todo Nedd check if have not function special save make error
		 */
		if(\dash\request::post('specialsave') === 'specialsave')
		{
			$specialsave = \content_site\call_function::option_specialsave($option_key, $myPost);

			if(\content_site\utility::need_redirect())
			{
				self::reloadIframe();
				\dash\redirect::pwd();
			}

			return $specialsave;
		}


		// save multi option
		if(\dash\request::post('multioption') === 'multi')
		{
			$value = $myPost;
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

			$type = \dash\request::post('opt_type');

			$type = \dash\validate::string_100($type);
			if(!$type)
			{
				\dash\notif::error(T_("Invalid type"));
				return false;
			}

			$load_preview = \content_site\call_function::preview($section_key, $type, $preview_key);

			if(!is_array($load_preview))
			{
				\dash\notif::error(T_("Invalid preview key"). ' '. __LINE__);
				return false;
			}

			if(isset($load_preview['options']) && is_array($load_preview['options']))
			{
				$value = $load_preview['options'];
			}
			else
			{
				$value = [];
			}

			$update_record['model']       = $type;
			$update_record['preview_key'] = $preview_key;
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

		if(\dash\temp::get('siteBuilderSetValueInText'))
		{
			\dash\pdo\query_template::update('pagebuilder', ['text_preview' => a($preview, 'html')], $section_id);
			unset($preview['html']);
		}

		$preview           = json_encode($preview);

		if($load_section_lock['preview'] === $preview && !\dash\data::changeSectionTypeMode())
		{
			\dash\pdo::rollback();
			self::$do_nothing_reload = true;
			return;
		}
		else
		{
			$update_record['preview'] = $preview;

			\dash\pdo\query_template::update('pagebuilder', $update_record, $section_id);

			\dash\pdo::commit();

		}


		if(\dash\data::changeSectionTypeMode())
		{
			// check process after change type
			\content_site\call_function::after_change_type($section_key, $section_id, $type, $preview_key);

			\dash\redirect::to(\dash\url::that(). \dash\request::full_get());

		}

		// force set redirect
		if(\content_site\utility::need_redirect())
		{
			self::reloadIframe();
			\dash\redirect::pwd();
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

					$section_key = \dash\url::child();

					\content_site\call_function::before_section_remove($section_key, $section_id);

					// delete section because the master status is draft
					\lib\db\pagebuilder\delete::by_id($section_id);
				}
				else
				{
					// update preview status on deleted to delete when save page
					\content_site\update_record::patch_field($section_id, 'status_preview', 'deleted');
				}

				self::reloadIframe();

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

				self::reloadIframe();
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

			self::reloadIframe();

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

			self::reloadIframe();

			\dash\redirect::pwd();

			return true;
		}

		return false;
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



		$section = \dash\request::get('section');

		$section = \dash\validate::string_100($section);

		if(!$section)
		{
			\dash\notif::error(T_("Invalid key"));
			return false;
		}

		$type = \dash\request::post('opt_type');

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
		$all_section = array_column($section_list, 'key');

		if(!in_array($section, $all_section))
		{
			\dash\notif::error(T_("Can not chose this section!"));
			return false;
		}

		$load_preview = \content_site\call_function::preview($section, $type, $preview_key);

		if(!is_array($load_preview))
		{
			\dash\notif::error(T_("Invalid preview key"). ' '. __LINE__);
			return false;
		}

		$preview_options = [];
		if(isset($load_preview['options']) && is_array($load_preview['options']))
		{
			$preview_options = $load_preview['options'];
		}

		$preview = [];

		$load_default = \content_site\call_function::default($section, $type);

		if(!is_array($load_default))
		{
			$load_default = [];
		}

		$preview = array_merge($load_default, $preview_options, $preview);

		$folder = \content_site\call_function::get_folder($section);

		$update_record = null;

		if($folder === 'header' || $folder === 'footer')
		{
			$check_duplicate = \lib\db\sitebuilder\get::check_duplicate_folder($page_id, $folder);
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
			$folder = 'body';
		}

		$preview = json_encode($preview);

		$args =
		[
			'folder'        => $folder,
			'section'       => $section,
			'model'         => $type,
			'preview_key'   => $preview_key,
			'page_id'       => $page_id,
			'preview'       => $preview,
			'update_record' => $update_record,
		];

		$id = self::add_new_section_db($args);

		if(!$id)
		{
			return false;
		}

		\content_site\call_function::after_add_section($section, $id, $type, $preview_key);

		$url = \dash\url::this(). '/';
		$url .= $section;
		$url .= \dash\request::full_get(['sid' => $id, 'folder' => null, 'section' => null,]);

		\dash\redirect::to($url);

	}



	public static function add_new_section_db($_args)
	{
		$insert                   = [];
		$insert['folder']         = a($_args, 'folder');
		$insert['section']        = a($_args, 'section');
		$insert['model']          = a($_args, 'model');
		$insert['preview_key']    = a($_args, 'preview_key');

		$insert['related']        = 'posts';
		$insert['related_id']     = a($_args, 'page_id');
		$insert['title']          = null;
		$insert['preview']        = a($_args, 'preview');
		$insert['status']         = 'draft';
		$insert['status_preview'] = 'draft';
		$insert['datecreated']    = date("Y-m-d H:i:s");

		if(a($_args, 'text_preview'))
		{
			$insert['text_preview'] = $_args['text_preview'];
		}

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

		if(a($_args, 'update_record'))
		{
			\lib\db\sitebuilder\update::record($insert, a($_args, 'update_record'));
			$id = a($_args, 'update_record');

		}
		else
		{

			$count_section_in_page = \lib\db\sitebuilder\get::count_section_in_page(a($_args, 'page_id'));

			if(floatval($count_section_in_page) >= 50)
			{
				\dash\notif::error(T_("Maximum capacity of page section is full"));
				return false;
			}

			$id = \lib\db\sitebuilder\insert::new_record($insert);

			if(!$id)
			{
				\dash\notif::error(T_("No way to save data"));
				return false;
			}

			return $id;
		}
	}

}
?>