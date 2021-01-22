<?php
namespace dash\app\ticket;

class edit
{

	public static function edit($_args, $_id)
	{
		\dash\permission::access('crmTicketManager');

		$load = \dash\app\ticket\get::inline_get($_id);
		if(!$load)
		{
			return false;
		}



		$args = \dash\app\ticket\check::variable($_args);
		if(!$args)
		{
			return false;
		}

		$exception = [];

		$file = null;
		if(\dash\request::files('file'))
		{
			$file = \dash\upload\support::ticket();
			if(!isset($file['path']))
			{
				return false;
			}

			$args['file'] = $file['path'];

			$exception[] = 'file';
		}


		$args = \dash\cleanse::patch_mode($_args, $args, $exception);


		if(empty($args))
		{
			\dash\notif::warn(T_("No data receive for update!"));
			return;
		}

		foreach ($args as $key => $value)
		{
			if(array_key_exists($key, $load) && \dash\validate::is_equal($load[$key], $value))
			{
				unset($args[$key]);
			}
		}


		if(empty($args))
		{
			\dash\notif::info(T_("Message save without change"));
			return true;
		}

		$args['datemodified'] = date("Y-m-d H:i:s");

		\dash\db\tickets\update::update($args, $load['id']);

		\dash\notif::ok(T_('Message edited'));

		return true;


	}


}
?>