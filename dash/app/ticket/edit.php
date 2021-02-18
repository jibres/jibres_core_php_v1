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

		$add_action = [];

		if(count($args) === 1)
		{
			if(isset($args['status']) && $args['status'] && isset($load['status']) && $args['status'] !== $load['status'])
			{
				$add_action[] =
				[
					'type'    => 'action',
					'content' => 'change status',
					'status'  => $args['status'],
					'parent'  => $load['id'],
					'user_id' => \dash\user::id(),
				];
			}

			if(array_key_exists('solved', $args) && !\dash\validate::is_equal($load['solved'], $args['solved']))
			{
				$add_action[] =
				[
					'type'    => 'action',
					'content' => 'change solved',
					'solved'  => $args['solved'],
					'parent'  => $load['id'],
					'user_id' => \dash\user::id(),
				];
			}

		}

		$args['datemodified'] = date("Y-m-d H:i:s");

		\dash\db\tickets\update::update($args, $load['id']);


		if($add_action)
		{
			foreach ($add_action as $key => $value)
			{
				\dash\app\ticket\add::add_new_ticket($value);
			}

			\dash\notif::clean();
		}

		\dash\notif::ok(T_('Message edited'));

		return true;


	}


}
?>