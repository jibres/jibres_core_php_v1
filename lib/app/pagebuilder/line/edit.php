<?php
namespace lib\app\pagebuilder\line;


class edit
{
	public static function element($_args = [])
	{
		$result = \lib\app\pagebuilder\line\get::load_current_element();

		if(!$result)
		{
			\dash\notif::error(T_("Invalid line detail"));
			return false;
		}

		$id = $result['id'];

		// remove element
		if(isset($_args['remove']) && $_args['remove'] === 'line')
		{
			return self::remove($result['key'], $id, $result);
		}

		$update = \lib\app\pagebuilder\line\check::input($result['key'], $id, $_args, $result);
		if(!$update)
		{
			return false;
		}

		$exception = \lib\app\pagebuilder\line\tools::input_exception();

		$update = \dash\cleanse::patch_mode($_args, $update, $exception);

		if(empty($update))
		{
			\dash\notif::info(T_("No change in your data"));
			return true;
		}

		if(array_key_exists('text', $update))
		{
			\lib\db\pagebuilder\update::bind_text($update['text'], $id);

			unset($update['text']);
		}

		if(!empty($update))
		{
			\lib\db\pagebuilder\update::record($update, $id);
		}

		\dash\notif::ok(T_("Your data successfully updated"));

		$result        = [];

		$redirect = \lib\app\pagebuilder\line\tools::need_redirect();
		if($redirect)
		{
			$result['url'] = $redirect;
		}

		return $result;
	}



	private static function remove($_element, $_id, $_args)
	{
		if(is_callable(\lib\app\pagebuilder\line\tools::get_fn($_element, 'remove')))
		{
			$allow_remove = \lib\app\pagebuilder\line\tools::call_fn_args($_element, 'remove', $_args);

			if(!$allow_remove)
			{
				return false;
			}
		}

		\lib\db\pagebuilder\delete::by_id($_id);

		\dash\notif::ok(T_("Line removed"));

		$result = [];
		$result['url'] = \dash\url::this();
		return $result;
	}



	public static function set_sort($_sort)
	{
		$sort = \dash\validate::sort($_sort);

		$list = \lib\app\pagebuilder\line\search::list();

		if(!$list || !is_array($list))
		{
			\dash\notif::warn(T_("No data to sort"));
			return false;
		}

		$current_ids = array_column($list, 'id');

		$new_sort = [];

		foreach ($sort as $key => $value)
		{
			if(in_array($value, $current_ids))
			{
				$new_sort[] = $value;
			}
		}

		$set_sort = [];
		foreach ($new_sort as $key => $value)
		{
			$new_key = floatval($key) * 10;

			$set_sort[$new_key] = $value;
		}

		\lib\db\pagebuilder\update::set_sort($set_sort);

		\dash\notif::ok(T_("Sort saved"));

		return true;
	}

}
?>