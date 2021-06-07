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
			return self::save_options();
		}



		/**
		 * Add or select new option
		 */
		$page_id = \dash\request::get('id');


		if(\dash\request::post('section') === 'preview')
		{
			$key = \dash\request::post('key');

			$key = \dash\validate::string_100($key);

			if(!$key)
			{
				\dash\notif::error(T_("Invalid key"));
				return false;
			}

			$section_list = controller::section_list();
			$all_key = array_column($section_list, 'key');

			if(!in_array($key, $all_key))
			{
				\dash\notif::error(T_("Can not chose this section!"));
				return false;
			}

			self::preview($key);

			if(\dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
		}

		if(\dash\request::post('select') === 'adding')
		{
			$result = self::select_adding($page_id);


			if($result)
			{
				$url = \dash\url::this(). '/';
				$url .= a($result, 'section');
				$url .= \dash\request::full_get(['sid' => a($result, 'sid')]);

				\dash\redirect::to($url);
			}

		}
	}


	/**
	 * Saves options.
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	public static function save_options()
	{

		$page_id      = \dash\request::get('id');
		$section_id   = \dash\request::get('sid');

		if(\dash\request::post('delete') === 'section' || \dash\request::post('hide_view') === 'toggle')
		{
			$load_section_lock = \lib\db\pagebuilder\get::by_id($section_id);

			if(!$load_section_lock || !is_array($load_section_lock))
			{
				\dash\notif::error(T_("Invalid section id"));

				return false;
			}
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


		$options_list = \dash\data::currentOptionList();

		$option_key   = \dash\request::post('option');

		if(!$option_key || !is_string($option_key))
		{
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
		else
		{
			$value = \dash\request::post($option_key);
		}


		$fn = ['\\content_site\\options\\'. $option_key, 'validator'];

		$value = call_user_func($fn, $value);

		$load_section_lock = \lib\db\pagebuilder\get::by_id($section_id);

		if(!$load_section_lock || !is_array($load_section_lock))
		{
			\dash\notif::error(T_("Invalid section id"));

			return false;
		}

		$preview = json_decode($load_section_lock['preview'], true);

		// save multi option
		if(is_array($value))
		{
			foreach ($value as $index => $val)
			{
				$preview[$index] = $val;
			}
		}
		else
		{
			$preview[$option_key] = $value;
		}

		$preview           = json_encode($preview);

		\content_site\update_record::patch_field($section_id, 'preview', $preview);

		\dash\notif::complete();

	}




	private static function preview($_section)
	{
		$page_id = \dash\coding::decode(\dash\request::get('id'));

		$section_list = \content_site\controller::load_current_section_list('with_adding');

		$end_record = end($section_list);

		$preview = json_encode(['key' => $_section, 'adding' => true]);

		if(isset($end_record['preview']['adding']))
		{
			// update current preview link
			$section_id = $end_record['id'];

			\content_site\update_record::patch_field($section_id, 'preview', $preview);
		}
		else
		{
			// add new record by adding mode

			$insert                = [];
			$insert['mode']        = 'body';
			$insert['type']        = $_section;
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
	}


	private static function select_adding($_page_id)
	{

		$page_id = \dash\coding::decode($_page_id);

		$section_list = \content_site\controller::load_current_section_list('with_adding');

		$end_record = end($section_list);

		if(isset($end_record['preview']['adding']))
		{
			unset($end_record['preview']['adding']);

			$section_id = $end_record['id'];

			\content_site\update_record::patch_field($section_id, 'preview', json_encode($end_record['preview']));


			$result = ['sid' => $section_id, 'section' => $end_record['preview']['key']];
			return $result;
		}
		else
		{
			\dash\notif::error(T_("Please select one section"));
			return false;
		}
	}

}
?>