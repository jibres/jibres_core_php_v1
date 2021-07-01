<?php
namespace content_site\page;


class model
{
	public static function post()
	{
		if(\dash\request::post('set_sort_section'))
		{
			self::set_sort();
		}

		if(\dash\request::post('savepage') === 'savepage')
		{
			self::save_page();
		}
	}


	private static function save_page()
	{

		$page_id = \dash\request::get('id');

		$page_id = \dash\validate::code($page_id);
		$page_id = \dash\coding::decode($page_id);
		if(!$page_id)
		{
			\dash\notif::error(T_("Invali page id"));
			return false;
		}

		\lib\db\sitebuilder\update::save_page($page_id);

		\dash\notif::ok(T_("Data saved"));

		return true;

	}


	/**
	 * Set the section order
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	private static function set_sort()
	{
		$page_id = \dash\request::get('id');

		$page_id = \dash\validate::code($page_id);
		$page_id = \dash\coding::decode($page_id);
		if(!$page_id)
		{
			\dash\notif::error(T_("Invali page id"));
			return false;
		}

		$sort = \dash\request::post('sort_section');
		$sort = \dash\validate::sort($sort);
		if(!$sort)
		{
			\dash\notif::error(T_("Invalid sort arguments"));
			return false;
		}

		$sort = array_map('floatval', $sort);
		$sort = array_filter($sort);
		$sort = array_unique($sort);
		if(!$sort)
		{
			\dash\notif::error(T_("Invalid sort arguments"));
			return false;
		}

		$currentSectionList = \dash\data::currentSectionList();

		if(!is_array($currentSectionList))
		{
			$currentSectionList = [];
		}

		foreach ($currentSectionList as $key => $value)
		{
			if(a($value, 'mode') === 'header' || a($value, 'mode') === 'footer')
			{
				unset($currentSectionList[$key]);
			}
		}

		if(count($currentSectionList) !== count($sort))
		{
			\dash\notif::warn(T_("Some item have problem in sorting. Need load again"));
			\dash\redirect::pwd();
		}

		foreach ($currentSectionList as $key => $value)
		{
			if(isset($value['id']) && in_array(floatval($value['id']), $sort))
			{
				//ok
			}
			else
			{
				\dash\notif::warn(T_("Some item have problem in sorting. Need load again"));
				\dash\redirect::pwd();
				return;
			}
		}

		\lib\db\sitebuilder\update::set_sort($sort);

		\dash\redirect::pwd();
		return;


	}
}
?>