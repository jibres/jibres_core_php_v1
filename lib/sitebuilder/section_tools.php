<?php
namespace lib\sitebuilder;


class section_tools
{

	public static function remove_hide_html($_section_detail)
	{
		$delete_json    = json_encode(['delete' => 'section']);
		$hide_view_json = json_encode(['hide_view' => 'toggle']);



		$html = '';
		$html .= '<div class="box">';
		$html .= '<div class="pad">';
		$html .= '<div class="row">';
		$html .= "<div class='cauto' data-ajaxify data-data='$delete_json'>";
		$html .= '<img class="avatar" src="'. \dash\utility\icon::url('Delete', 'minor'). '">';
		$html .= '</div>';
		$html .= '<div class="c"></div>';
		$html .= "<div class='cauto' data-ajaxify data-data='$hide_view_json'>";

		if(a($_section_detail, 'status') === 'draft')
		{
			$html .= '<img class="avatar" src="'. \dash\utility\icon::url('hide', 'minor'). '">';

		}
		else
		{
			$html .= '<img class="avatar" src="'. \dash\utility\icon::url('view', 'minor'). '">';
		}

		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';

		return $html;
	}


	public static function action($_section_id, $_page_id)
	{
		if(\dash\request::post('delete') === 'section' || \dash\request::post('hide_view') === 'toggle')
		{
			$load_section_lock = \lib\db\pagebuilder\get::by_id($_section_id);

			if(!$load_section_lock || !is_array($load_section_lock))
			{
				\dash\pdo::rollback();

				\dash\notif::error(T_("Invalid section id"));

				return false;
			}
		}


		if(\dash\request::post('delete') === 'section')
		{
			// delete section
			\lib\db\pagebuilder\delete::by_id($_section_id);

			return 'delete';
		}

		if(\dash\request::post('hide_view') === 'toggle')
		{


			$load_section_lock = \lib\sitebuilder\ready::section_list($load_section_lock);

			if($load_section_lock['status'] === 'draft')
			{
				$new_status = 'enable';
			}
			else
			{
				$new_status = 'draft';
			}

			\lib\sitebuilder\section_tools::patch_field($_section_id, 'status', $new_status);

			// set hide and view section
			return true;
		}

		return false;
	}


	public static function patch_field($_section_id, $_field, $_value)
	{
		\dash\pdo::transaction();

		$load_section_lock = \lib\db\pagebuilder\get::by_id_lock($_section_id);

		if(!$load_section_lock || !is_array($load_section_lock))
		{
			\dash\pdo::rollback();

			\dash\notif::error(T_("Invalid section id"));

			return false;
		}

		\dash\pdo\query_template::update('pagebuilder', [$_field => $_value], $_section_id);

		\dash\pdo::commit();

		return true;

	}



}
?>