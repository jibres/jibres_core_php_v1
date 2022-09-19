<?php
namespace lib\app\form\item;


class edit
{

	public static function save_sort($_sort, $_form_id)
	{
		\dash\permission::access('ManageForm');

		$_form_id = \dash\validate::id($_form_id);

		if(!is_array($_sort))
		{
			$_sort = [];
		}

		$new_sort = [];
		foreach ($_sort as $key => $value)
		{
			$key = \dash\validate::number($key);
			$value = \dash\validate::id($value);

			$new_sort[$key] = $value;
		}

		if(!empty($new_sort))
		{
			\lib\db\form_item\update::set_sort($_form_id, $new_sort);
			\dash\notif::ok(T_("Sort saved"));
			return true;
		}
	}


	private static $form_detail = [];

	public static function edit($_args, $_id, $_form_id)
	{
		\dash\permission::access('ManageForm');

		if(isset(self::$form_detail[$_form_id]))
		{
			$load_form = self::$form_detail[$_form_id];
		}
		else
		{
			$load_form = \lib\app\form\form\get::get($_form_id);
			if(!$load_form)
			{
				return false;
			}
			self::$form_detail[$_form_id] = $load_form;
		}


		$load = \lib\app\form\item\get::get($_id);
		if(!$load)
		{
			return false;
		}

		$args = \lib\app\form\item\check::variable($_args, $_id, $load);

		if(!$args)
		{
			return false;
		}

		if(isset($args['setting']))
		{
			$_args['setting'] = $args['setting'];
		}

		if(isset($args['choice']))
		{
			$_args['choice'] = $args['choice'];
		}

		if(isset($args['checkrequire']))
		{
			$_args['require'] = 1;
		}

		unset($args['checkrequire']);

		if(isset($args['checkhidden']))
		{
			$_args['hidden'] = 1;
		}

		unset($args['checkhidden']);

		$args = \dash\cleanse::patch_mode($_args, $args);

		foreach ($args as $key => $value)
		{
			if(\dash\validate::is_equal(a($load, $key), $value))
			{
				unset($args[$key]);
			}
		}

		if(empty($args))
		{
			\dash\notif::info(T_("No data to change"));
			return false;
		}

		$args['datemodified'] = date("Y-m-d H:i:s");

		\lib\db\form_item\update::update($args, $_id);

		return true;
	}


	public static function edit_uniquelist($_args, $_id, $_form_id, $_upload_from_file = false)
	{
		\dash\permission::access('ManageForm');

		if(isset(self::$form_detail[$_form_id]))
		{
			$load_form = self::$form_detail[$_form_id];
		}
		else
		{
			$load_form = \lib\app\form\form\get::get($_form_id);
			if(!$load_form)
			{
				return false;
			}
			self::$form_detail[$_form_id] = $load_form;
		}


		$load = \lib\app\form\item\get::get($_id);
		if(!$load)
		{
			return false;
		}

		$args = \lib\app\form\item\check::variable(['uniquelist' => $_args], $_id, $load);

		if(!$args)
		{
			return false;
		}

		if($args['uniquelist'])
		{
			$unique_list = preg_split("/\,|\n/", $args['uniquelist']);
			
			$pretty_unique_list = [];

			foreach ($unique_list as $unique_item)
			{
				if(a($load, 'type') === 'email')
				{
					if($my_email = \dash\validate::email($unique_item, false))
					{
						$pretty_unique_list[] = $my_email;
					}
					else
					{
						if(!$_upload_from_file)
						{
							\dash\notif::error(T_("Invalid email"));
							return false;
						}
					}
				}
				elseif(a($load, 'type') === 'nationalcode')
				{
					if($my_nationalcode = \dash\validate::nationalcode($unique_item, false))
					{
						$pretty_unique_list[] = $my_nationalcode;
					}
					else
					{
						if(!$_upload_from_file)
						{
							\dash\notif::error(T_("Invalid nationalcode"));
							return false;
						}
					}
				}
				elseif(a($load, 'type') === 'mobile')
				{
					if($my_mobile = \dash\validate::mobile($unique_item, false))
					{
						$pretty_unique_list[] = $my_mobile;
					}
					else
					{
						if(!$_upload_from_file)
						{
							\dash\notif::error(T_("Invalid mobile"));
							return false;
						}
					}
				}
			}
		}
		else
		{
			\dash\notif::error(T_("Please fill the input"));
			return false;
		}


		if(empty($pretty_unique_list))
		{
			\dash\notif::error(T_("No valid entries found"));
			return false;
		}

		$current_data = a($load, 'uniquelist');

		if(is_string($current_data))
		{
			$current_data = explode(',', $current_data);
		}
		else
		{
			$current_data = [];
		}

		if(!$_upload_from_file)
		{
			foreach ($pretty_unique_list as $key => $value)
			{
				if(in_array($value, $current_data))
				{
					\dash\notif::error(T_(":val was exists in your list", ['val' => $value]));
					return false;
				}
			}
		}

		$count_before = count($current_data);

		$current_data = array_merge($current_data, $pretty_unique_list);

		$current_data = array_filter($current_data);

		$current_data = array_unique($current_data);

		$count_after = count($current_data);

		$current_data = implode(',', $current_data);

		\lib\db\form_item\update::update(['uniquelist' => $current_data], $_id);

		if($_upload_from_file)
		{
			\dash\notif::ok(T_(":count data was imported", ['count' => \dash\fit::number(abs($count_before - $count_after))]));
		}
		else
		{
			\dash\notif::ok(T_("Saved"));
		}

		return true;

	}


	public static function remove_from_uniquelist($_value, $_id, $_form_id)
	{
		\dash\permission::access('ManageForm');

		if(isset(self::$form_detail[$_form_id]))
		{
			$load_form = self::$form_detail[$_form_id];
		}
		else
		{
			$load_form = \lib\app\form\form\get::get($_form_id);
			if(!$load_form)
			{
				return false;
			}
			self::$form_detail[$_form_id] = $load_form;
		}


		$load = \lib\app\form\item\get::get($_id);
		if(!$load)
		{
			return false;
		}

		$_value = \dash\validate::string_500($_value);



		$current_data = a($load, 'uniquelist');

		if(is_string($current_data))
		{
			$current_data = explode(',', $current_data);
		}
		else
		{
			$current_data = [];
		}

		if(!in_array($_value, $current_data))
		{
			\dash\notif::error(T_("This item not exists in your list"));
			return false;
		}

		unset($current_data[array_search($_value, $current_data)]);

		$current_data = implode(',', $current_data);

		\lib\db\form_item\update::update(['uniquelist' => $current_data], $_id);

		\dash\notif::ok(T_("Removed"));

		return true;

	}
}
?>