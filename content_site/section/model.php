<?php
namespace content_site\section;


class model
{
	private static $do_nothing_reload = false;
	public static function post()
	{
		if(\content_site\page\model::sort_up_down())
		{
			// sort section
		}
		else
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
		}

		\dash\notif::complete();



		self::reloadIframe();
	}


	private static function reloadIframe()
	{
		\content_site\model::check_auto_save_page();

		$page_url = \content_site\view::generate_iframe_src(true);

		if(self::$do_nothing_reload)
		{
			return;
		}

		\dash\notif::reloadIframeSrc(\dash\data::siteBuilderIframeLink());
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
		$model          = null;
		$preview_key   = null;

		$update_record = [];

		\content_site\model::check_homepage_permission();

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

		// sort index child
		if(self::set_sort_child($section_id))
		{
			return;
		}


		// remove block
		if(self::remove_block($section_id))
		{
			return;
		}

		if(self::upload_editor())
		{
			return false;
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
				foreach ($value as $k => $v)
				{
					if(is_array($v))
					{
						$trust_options_list[] = $k;
						$trust_options_list = array_merge($trust_options_list, $v);
					}
					else
					{
						$trust_options_list[] = $v;
					}
				}
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
			if(\dash\data::changeSectionModel() && $option_key === 'model')
			{
				// all section have this option opt_model to change model of option
			}
			else
			{
				if(\dash\url::isLocal())
				{
					\dash\notif::info('Local: '. json_encode(['opt_'=> $option_key, 'list' => $trust_options_list]));
				}

				\dash\notif::error(T_("Invalid option"). ' '. __LINE__);
				return false;
			}
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

		if(\dash\data::changeSectionModel())
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

			$model = \dash\request::post('opt_model');

			$model = \dash\validate::string_100($model);
			if(!$model)
			{
				\dash\notif::error(T_("Invalid model"));
				return false;
			}

			$load_preview = \content_site\call_function::preview($section_key, $model, $preview_key);

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

			$update_record['model']       = $model;
			$update_record['preview_key'] = $preview_key;
		}

		// reload section detail to get last update
		// for example in upload file need this line
		\dash\pdo::transaction();

		$load_section_lock = \lib\db\sitebuilder\get::by_id_lock($section_id);

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
				\dash\pdo::rollback();
				\dash\notif::error(T_("Can not save this index!"));
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
			\lib\db\sitebuilder\update::record(['text_preview' => a($preview, 'html')], $section_id);
			unset($preview['html']);
		}


		// detect confilict
		$conflict = \content_site\options\conflict::detect($preview, $section_key);

		if($conflict === false)
		{
			\dash\pdo::rollback();
			\dash\notif::error_once(T_("Some settings are conflicting!"));
			return false;
		}

		if($conflict === null)
		{
			// nothing
			// continue
		}

		if(is_array($conflict) && $conflict)
		{
			// replace array
			$preview = $conflict;
		}


		$preview           = json_encode($preview);

		if($load_section_lock['preview'] === $preview && !\dash\data::changeSectionModel() && !\content_site\update_record::need_update_record_field())
		{
			\dash\pdo::rollback();
			self::$do_nothing_reload = true;

			// force set redirect
			if(\content_site\utility::need_redirect())
			{
				self::reloadIframe();
				\dash\redirect::pwd();
			}

			return;
		}
		else
		{
			$update_record['preview'] = $preview;

			if(\content_site\update_record::need_update_record_field())
			{
				$update_record = array_merge($update_record, \content_site\update_record::need_update_record_field());
			}

			\lib\db\sitebuilder\update::record($update_record, $section_id);

			\dash\pdo::commit();

		}


		if(\dash\data::changeSectionModel())
		{
			// check process after change model
			\content_site\call_function::after_change_model($section_key, $section_id, $model, $preview_key);

			\content_site\model::check_auto_save_page();

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
			$load_section_lock = \lib\db\sitebuilder\get::by_id($section_id);

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
					\lib\db\sitebuilder\delete::by_id($section_id);
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
			$load_section = \lib\db\sitebuilder\get::by_id($section_id);

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



	private static function remove_block($section_id)
	{
		$subchild = \dash\url::subchild();
		$index    = \dash\request::get('index');

		if(\dash\request::post('delete') === 'block' && \dash\request::get('index') && \dash\url::subchild())
		{
			\dash\pdo::transaction();

			$load_section_lock = \lib\db\sitebuilder\get::by_id_lock($section_id);

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

				\lib\db\sitebuilder\update::record(['preview' => $preview], $section_id);

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



	private static function restore_section($section_id)
	{

		// delete or hide a section
		if(\dash\request::post('restore') === 'section')
		{
			$load_section = \lib\db\sitebuilder\get::by_id($section_id);

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
	 * Sets the sort child.
	 * for example set image sort in gallery
	 *
	 * @param      <type>  $section_id  The section identifier
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	private static function set_sort_child($section_id)
	{
		if(!\dash\request::post('sort_child'))
		{
			return false;
		}
		// reload section detail to get last update
		// for example in upload file need this line
		\dash\pdo::transaction();

		$load_section_lock = \lib\db\sitebuilder\get::by_id_lock($section_id);

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

		\lib\db\sitebuilder\update::record(['preview' => $preview], $section_id);

		\dash\pdo::commit();

		\dash\notif::complete();

		return true;

	}


	public static function upload_editor()
	{
		if(\dash\request::files('upload'))
		{
			$id = null;

			if(\dash\request::get('id'))
			{
				$id = \dash\coding::decode(\dash\request::get('id'));
			}

			$uploaded_file = \dash\upload\cms::set_post_gallery_editor($id);

			$result             = [];

			if(isset($uploaded_file['filename']) && isset($uploaded_file['path']))
			{
				$result['fineName'] = $uploaded_file['filename'];
				$result['url']      = \lib\filepath::fix($uploaded_file['path']);
				$result['uploaded'] = 1;
			}
			else
			{
				$result['uploaded'] = 0;
			}

			\dash\code::jsonBoom($result);

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



		$section = \dash\request::post('section');

		$section = \dash\validate::string_100($section);

		if(!$section)
		{
			\dash\notif::error(T_("Invalid key"));
			return false;
		}

		$model = \dash\request::post('opt_model');

		$model = \dash\validate::string_100($model);

		if(!$model)
		{
			\dash\notif::error(T_("Invalid model"));
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
		$all_section = array_column($section_list, 'section');

		if(!in_array($section, $all_section))
		{
			\dash\notif::error(T_("Can not chose this section!"));
			return false;
		}

		$load_preview = \content_site\call_function::preview($section, $model, $preview_key);

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

		$load_default = \content_site\call_function::default($section, $model);

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
			'model'         => $model,
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

		\content_site\call_function::after_add_section($section, $id, $model, $preview_key);

		$url = \dash\url::this(). '/';
		$url .= $section;
		$url .= \dash\request::full_get(['sid' => $id, 'folder' => null, 'section' => null,]);

		\content_site\model::check_auto_save_page();

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

		$get_last_sort = \lib\db\sitebuilder\get::last_sort($get_last_sort_args);

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