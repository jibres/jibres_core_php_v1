<?php
namespace content_site;


class model
{
	public static function public_model($_options_list)
	{

		$page_id      = \dash\request::get('id');
		$section_id   = \dash\request::get('sid');


		$section_tools = \lib\sitebuilder\section_tools::action($section_id, $page_id);

		if($section_tools)
		{
			if($section_tools === 'delete')
			{
				\dash\redirect::to(\dash\url::here(). '/page'. \dash\request::full_get(['sid' => null]));
			}
			\dash\redirect::pwd();
			return;
		}

		$options_list = $_options_list;

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

		\lib\sitebuilder\options::admin_save($section_id, $option_key, $value);

		\dash\notif::complete();

	}
}
?>