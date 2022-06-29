<?php
namespace lib\app\form\tag;


class get
{



	public static function load_answer_by_tag($_tag)
	{
		\dash\permission::access('_group_form');

		$_tag = \dash\validate::string($_tag);
		if(!$_tag)
		{
			return false;
		}

		$_tag     = \dash\str::urldecode($_tag);
		$load_tag = \lib\db\form_tag\get::by_slug($_tag);
		return $load_tag;
	}


	public static function all_tag()
	{
		\dash\permission::access('_group_form');

		$id = \dash\request::get('id');
		$id = \dash\validate::id($id);
		if(!$id)
		{
			return false;
		}

		$result = \lib\db\form_tag\get::all_tag($id);
		return $result;
	}



	public static function public_answer_tag($_answer_id)
	{
		$get_usage = \lib\db\form_tagusage\get::usage_public($_answer_id);

		if(!is_array($get_usage))
		{
			$get_usage = [];
		}

		foreach ($get_usage as $key => $value)
		{
			if(isset($value['color']) && $value['color'])
			{
				switch ($value['color'])
				{
					case 'red':
						$get_usage[$key]['class'] = 'alert-danger';
						break;

					case 'green':
						$get_usage[$key]['class'] = 'alert-success';
						break;

					case 'blue':
						$get_usage[$key]['class'] = 'alert-primary';
						break;

					case 'black':
						$get_usage[$key]['class'] = 'alert-secondary';
						break;

					default:
						$get_usage[$key]['class'] = '';
						break;
				}
			}
		}

		return $get_usage;
	}

	public static function answer_tag($_answer_id)
	{
		\dash\permission::access('_group_form');

		$_answer_id = \dash\validate::id($_answer_id);
		if(!$_answer_id)
		{
			return false;
		}

		$get_usage = \lib\db\form_tagusage\get::usage($_answer_id);

		return $get_usage;
	}


	public static function inline_get($_id)
	{
		$_id = \dash\validate::id($_id);

		if(!$_id)
		{
			\dash\notif::error(T_("Invalid tag id"));
			return false;
		}

		$load = \lib\db\form_tag\get::one($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid tag id"));
			return false;
		}

		return $load;
	}


	public static function get_title($_id)
	{
		$load = self::inline_get($_id);
		if(isset($load['title']))
		{
			return $load['title'];
		}
		return null;
	}


	public static function get($_id)
	{
		\dash\permission::access('_group_form');


		$_id = \dash\validate::id($_id);

		if(!$_id)
		{
			\dash\notif::error(T_("Invalid tag id"));
			return false;
		}

		$load = \lib\db\form_tag\get::one($_id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid tag id"));
			return false;
		}

		$load['count'] = \lib\db\form_tag\get::get_count_answer($_id);

		$load = \lib\app\form\tag\ready::row($load);
		return $load;
	}

}
?>