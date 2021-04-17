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
			return self::remove($id);
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



	private static function remove($_id)
	{
		\lib\db\pagebuilder\delete::by_id($_id);

		\dash\notif::ok(T_("Line removed"));

		$result = [];
		$result['url'] = \dash\url::this();
		return $result;
	}

}
?>