<?php
namespace lib\app\form\form;


class get
{

	public static function sitemap_list($_from, $_to)
	{
		$list = \lib\db\form\get::sitemap_list($_from, $_to);
		if(!is_array($list))
		{
			return false;
		}

		$list = array_map(['\\lib\\app\\form\\form\\ready', 'row'], $list);

		return $list;
	}


	public static function get($_id)
	{
		\dash\permission::access('_group_form');

		return self::public_get($_id);

	}


	public static function by_id($_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}

		$load = \lib\db\form\get::by_id($id);

		if(!$load)
		{
			return false;
		}

		$load = \lib\app\form\form\ready::row($load);

		return $load;
	}


	public static function resetMyStartTime($_form_id)
	{
		$key = 'formStartTime_' . $_form_id;

		\dash\session::set($key, null);
	}


	public static function getMyStartTime($_form_id)
	{
		$key = 'formStartTime_' . $_form_id;

		return \dash\session::get($key);
	}


	private static function fillMyStartDate(&$result)
	{
		if(a($result, 'setting', 'timelimit'))
		{
			$form_id = a($result, 'id');

			$key = 'formStartTime_' . $form_id;

			// user Refresh the page
			if(!self::getMyStartTime($form_id))
			{
				\dash\session::set($key, time());
			}

			$myStartDate           = \dash\session::get($key);
			$result['myStartDate'] = $myStartDate;
		}
	}


	public static function public_get_for_generate($_id)
	{
		$result = self::public_get($_id);

		self::fillMyStartDate($result);

		return $result;
	}


	public static function public_get($_id)
	{

		$id = \dash\validate::string_200($_id);

		if(!$id)
		{
			return false;
		}

		$load = \lib\db\form\get::load_public_form($id);

		if(!$load)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load = \lib\app\form\form\ready::row($load);

		return $load;
	}


	/**
	 * @return bool
	 */
	public static function enterpriseSpecialFormBuilder() : bool
	{
		$ok = in_array(intval(\lib\store::id()), [1000089, 1001466]);

		if($ok)
		{
			return true;
		}

		if(\dash\url::isLocal())
		{
			return true;
		}

		return false;
	}

}

?>