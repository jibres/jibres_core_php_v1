<?php
namespace lib\pagebuilder\tools;


class edit
{
	public static function element($_args = [])
	{
		$result = \lib\pagebuilder\tools\get::load_current_element();

		return self::edit($result, $_args);
	}

	public static function edit($_element, $_args)
	{
		$result = $_element;

		if(!$result)
		{
			\dash\notif::error(T_("Invalid line detail"));
			return false;
		}

		$id = $result['id'];

		// remove element
		if(isset($_args['remove']) && $_args['remove'] === 'line')
		{
			return self::remove($result['mode'], $result['key'], $id, $result);
		}

		$update = \lib\pagebuilder\tools\check::input($result['mode'], $result['key'], $id, $_args, $result);
		if(!$update)
		{
			return false;
		}

		$exception = \lib\pagebuilder\tools\tools::input_exception();

		$update = \dash\cleanse::patch_mode($_args, $update, $exception);

		if(empty($update))
		{
			\dash\notif::info(T_("No change in your data"));
			return true;
		}

		if(array_key_exists('text', $update))
		{
			\lib\db\pagebuilder\update::update_text($update['text'], $id);

			unset($update['text']);
		}

		if(!empty($update))
		{
			\lib\db\pagebuilder\update::record($update, $id);
		}

		\dash\notif::ok(T_("Your data successfully updated"));

		$result        = [];

		$redirect = \lib\pagebuilder\tools\tools::need_redirect();
		if($redirect)
		{
			$result['url'] = $redirect;
		}

		return $result;
	}



	private static function remove($_folder, $_element, $_id, $_args)
	{
		if(is_callable(\lib\pagebuilder\tools\tools::get_fn($_folder, $_element, 'remove')))
		{
			$allow_remove = \lib\pagebuilder\tools\tools::call_fn_args($_folder, $_element, 'remove', $_args);

			if(!$allow_remove)
			{
				return false;
			}
		}

		\lib\db\pagebuilder\delete::by_id($_id);

		\dash\notif::ok(T_("Line removed"));

		$result = [];
		$result['url'] = \dash\url::this(). '/build'. \dash\request::full_get(['pid' => null]);
		return $result;
	}



	public static function set_sort($_sort)
	{
		$sort = \dash\validate::sort($_sort);

		$list = \lib\pagebuilder\tools\get::current_line_list();

		if(!is_array(a($list, 'list')))
		{
			\dash\notif::warn(T_("No data to sort"));
			return false;
		}

		$list = a($list, 'list');

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