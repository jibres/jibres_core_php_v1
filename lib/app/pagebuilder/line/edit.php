<?php
namespace lib\app\pagebuilder\line;


class edit
{
	public static function element($_element, $_contain, $_id, $_args = [])
	{
		$result = \lib\app\pagebuilder\line\get::load_element($_element, $_contain, $_id);

		if(!$result)
		{
			\dash\notif::error(T_("Invalid line detail"));
			return false;
		}

		// remove element
		if(isset($_args['remove']) && $_args['remove'] === 'line')
		{
			return self::remove($_id);
		}

		$update = \lib\app\pagebuilder\line\check::input($_element, $_id, $_args);
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

		\lib\db\pagebuilder\update::record($update, $_id);

		\dash\notif::ok(T_("Your data successfully updated"));

		return true;
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