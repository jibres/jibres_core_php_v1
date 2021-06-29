<?php
namespace content_site\section;


class model
{
	public static function post()
	{

		// change header
		if(\dash\data::changeHeader())
		{
			return self::add_new_section();
		}

		/**
		 * Save option of one section
		 */
		if(\dash\url::child())
		{
			return self::save_options();
		}

		/**
		 * Add or select new option
		 */
		self::add_new_section();
	}




	/**
	 * Saves options.
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	public static function save_options()
	{
		$need_redirect_back = false;
		$page_id            = \dash\request::get('id');
		$section_id         = \dash\request::get('sid');
		$section_id         = \dash\validate::id($section_id);

		if(!$section_id)
		{
			\dash\notif::error(T_("Invalid section id"));
			return false;
		}


		// delete or hide a section
		if(\dash\request::post('delete') === 'section' || \dash\request::post('hide_view') === 'toggle')
		{
			$load_section_lock = \lib\db\pagebuilder\get::by_id($section_id);

			if(!$load_section_lock || !is_array($load_section_lock))
			{
				\dash\notif::error(T_("Section not found"));

				return false;
			}

			if(\dash\request::post('delete') === 'section')
			{
				// delete section
				\lib\db\pagebuilder\delete::by_id($section_id);

				\dash\redirect::to(\dash\url::here(). '/page'. \dash\request::full_get(['sid' => null]));
				return;
			}

			if(\dash\request::post('hide_view') === 'toggle')
			{

				$load_section_lock = view::ready_section_list($load_section_lock);

				if($load_section_lock['status'] === 'draft')
				{
					$new_status = 'enable';
				}
				else
				{
					$new_status = 'draft';
				}

				\content_site\update_record::patch_field($section_id, 'status', $new_status);

				\dash\redirect::pwd();
				\dash\notif::complete();

				// set hide and view section
				return true;
			}
		}

		// set section sort
		if(\dash\request::post('set_sort_child'))
		{
			return self::set_sort_child($section_id);
		}


		$subchild = \dash\url::subchild();
		$index    = \dash\request::get('index');

		if(\dash\request::post('delete') === 'block' && \dash\request::get('index') && \dash\url::subchild())
		{
			\dash\pdo::transaction();

			$load_section_lock = \lib\db\pagebuilder\get::by_id_lock($section_id);

			if(!$load_section_lock)
			{
				\dash\pdo::rollback();

				\dash\notif::error(T_("Section not found"));

				return false;
			}

			$preview = json_decode($load_section_lock['preview'], true);

			if(isset($preview[$subchild]) && is_array($preview[$subchild]))
			{
				foreach ($preview[$subchild] as $key => $value)
				{
					if(isset($value['index']) && $value['index'] === $index)
					{
						unset($preview[$subchild][$key]);

						$need_redirect_back = true;
					}
				}

			}
			else
			{
				\dash\notif::error(T_("Can not remove this block!"));
				\dash\pdo::rollback();
				\dash\redirect::to(view::generate_back_url());
				return false;
			}
		}
		else
		{

			$options_list = \dash\data::currentOptionList();

			if($subchild && isset($options_list[$subchild]))
			{
				$options_list = $options_list[$subchild];
			}

			$option_key   = \dash\request::post('option');

			if(!$option_key || !is_string($option_key))
			{
				\dash\notif::error(T_("Option key not found!"));
				return false;
			}

			if(!in_array($option_key, $options_list))
			{
				\dash\notif::error(T_("Invalid option"));
				return false;
			}

			// save multi option
			if(\dash\request::post('multioption') === 'multi')
			{
				$value = \dash\request::post();
			}
			elseif(\dash\request::post('specialsave') === 'specialsave')
			{
				return \content_site\call_function::option_specialsave($option_key, \dash\request::post());
			}
			else
			{
				$value = \dash\request::post($option_key);
			}

			$value = \content_site\call_function::option_validator($option_key, $value);

			if(!\dash\engine\process::status())
			{
				\dash\notif::error_once(T_("Please check your input"));
				return false;
			}

			// reload section detail to get last update
			// for example in upload file need this line
			\dash\pdo::transaction();

			$load_section_lock = \lib\db\pagebuilder\get::by_id_lock($section_id);

			if(!$load_section_lock)
			{
				\dash\pdo::rollback();

				\dash\notif::error(T_("Section not found"));

				return false;
			}

			$preview = json_decode($load_section_lock['preview'], true);


			if($subchild)
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
								$preview[$subchild][$k][$option_key] = $value;
							}
						}
					}
				}
				else
				{
					\dash\notif::error(T_("Can save this index!"));
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
					$preview[$option_key] = $value;
				}

			}
		}

		$preview           = json_encode($preview);

		\dash\pdo\query_template::update('pagebuilder', ['preview' => $preview], $section_id);

		\dash\pdo::commit();

		if($need_redirect_back)
		{
			\dash\redirect::to(view::generate_back_url());
		}

		\dash\notif::complete();

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

			\dash\notif::error(T_("Section not found"));

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


		if(\dash\request::post('section') === 'preview')
		{
			$key = \dash\request::post('key');

			$key = \dash\validate::string_100($key);

			if(!$key)
			{
				\dash\notif::error(T_("Invalid key"));
				return false;
			}

			$style = \dash\request::post('style');

			$style = \dash\validate::string_100($style);

			if(!$style)
			{
				\dash\notif::error(T_("Invalid style"));
				return false;
			}

			$section_list = controller::section_list();
			$all_key = array_column($section_list, 'key');

			if(!in_array($key, $all_key))
			{
				\dash\notif::error(T_("Can not chose this section!"));
				return false;
			}

			$trust_style = false;

			foreach ($section_list as $one_item)
			{
				if(isset($one_item['key']) && $one_item['key'] === $key && isset($one_item['style']) && $one_item['style'] === $style)
				{
					$trust_style = true;
				}
			}

			if(!$trust_style)
			{
				\dash\notif::error(T_("Can not chose this section!"));
				return false;
			}

			$section_list = \content_site\controller::load_current_section_list('with_adding');

			$end_record = [];

			if(\dash\url::module() === 'header')
			{
				foreach ($section_list as $v)
				{
					if(a($v, 'mode') === 'header')
					{
						$end_record = $v;
					}
				}
			}
			else
			{
				$end_record = end($section_list);
			}

			if(\dash\data::changeHeader())
			{
				if(isset($end_record['preview']))
				{
					$preview           = $end_record['preview'];
					$preview['key']    = $key;
					$preview['style']  = $style;
					$preview['adding'] = true;
					$preview           = json_encode($preview);
				}
				else
				{
					\dash\notif::error(T_("Invalid data"));
					return false;
				}
			}
			else
			{
				$preview = json_encode(['key' => $key, 'style' => $style, 'adding' => true]);
			}

			if(isset($end_record['preview']['adding']) || \dash\data::changeHeader())
			{
				// update current preview link
				$section_id = $end_record['id'];

				// @reza @TODO  need to check and lock all record to add adding mode to end of preview json
				\content_site\update_record::patch_field($section_id, 'preview', $preview);
			}
			else
			{
				// add new record by adding mode

				$mode = 'body';

				if(\dash\url::module() === 'header')
				{
					$mode = 'header';
				}

				$insert                = [];
				$insert['mode']        = $mode;
				$insert['type']        = $key;
				$insert['related']     = 'posts';
				$insert['related_id']  = $page_id;
				$insert['title']       = null;
				$insert['preview']     = $preview;
				$insert['status']      = 'enable';
				$insert['datecreated'] = date("Y-m-d H:i:s");

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

				$id = \lib\db\pagebuilder\insert::new_record($insert);

				if(!$id)
				{
					\dash\notif::error(T_("No way to save data"));
					return false;
				}
			}

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}

		if(\dash\request::post('select') === 'adding')
		{

			$section_list = \content_site\controller::load_current_section_list('with_adding');

			$end_record = [];

			if(\dash\url::module() === 'header')
			{
				foreach ($section_list as $v)
				{
					if(a($v, 'mode') === 'header')
					{
						$end_record = $v;
					}
				}
			}
			else
			{
				$end_record = end($section_list);
			}

			if(isset($end_record['preview']['adding']))
			{
				unset($end_record['preview']['adding']);

				$section_id = $end_record['id'];

				// @reza @TODO  need to check and lock all record to add adding mode to end of preview json
				\content_site\update_record::patch_field($section_id, 'preview', json_encode($end_record['preview']));


				$url = \dash\url::this(). '/';
				$url .= $end_record['preview']['key'];
				$url .= \dash\request::full_get(['sid' => $section_id]);

				\dash\redirect::to($url);

			}
			else
			{
				\dash\notif::error(T_("Please select one section"));
				return false;
			}
		}
	}


}
?>