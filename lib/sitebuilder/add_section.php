<?php
namespace lib\sitebuilder;


class add_section
{
	public static function preview($_page_id, $_section)
	{
		$page_detail = \lib\sitebuilder\get::load_page_detail($_page_id);

		if(!$page_detail)
		{
			return false;
		}

		$page_id = \dash\coding::decode($_page_id);

		$section_list = \lib\sitebuilder\get::body_section_list($_page_id, 'with_adding');

		$end_record = end($section_list);

		$preview = json_encode(['key' => $_section, 'adding' => true]);

		if(isset($end_record['preview']['adding']))
		{
			// update current preview link
			$section_id = $end_record['id'];

			\lib\sitebuilder\section_tools::patch_field($section_id, 'preview', $preview);
		}
		else
		{
			// add new record by adding mode

			$add = ['key' => $_section, 'page_id' => $page_id, 'preview' => $preview];

			self::add_section_record($add);
		}
	}


	public static function select_adding($_page_id)
	{
		$page_detail = \lib\sitebuilder\get::load_page_detail($_page_id);

		if(!$page_detail)
		{
			return false;
		}

		$page_id = \dash\coding::decode($_page_id);

		$section_list = \lib\sitebuilder\get::body_section_list($_page_id, 'with_adding');

		$end_record = end($section_list);


		if(isset($end_record['preview']['adding']))
		{
			unset($end_record['preview']['adding']);

			$section_id = $end_record['id'];

			\lib\sitebuilder\section_tools::patch_field($section_id, 'preview', json_encode($end_record['preview']));


			$result = ['sid' => $section_id, 'section' => $end_record['preview']['key']];
			return $result;
		}
		else
		{
			\dash\notif::error(T_("Please select one section"));
			return false;
		}
	}


	private static function add_section_record($_args)
	{

		$insert                = [];
		$insert['mode']        = 'body';
		$insert['type']        = a($_args, 'key');
		$insert['related']     = 'posts';
		$insert['related_id']  = a($_args, 'page_id');
		$insert['title']       = null;
		$insert['preview']     = a($_args, 'preview');
		$insert['status']      = 'draft';
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
?>