<?php
namespace content_su;

class controller
{
	public static function routing()
	{
		\dash\redirect::remove_subdomain();

		\dash\redirect::remove_store();

		\dash\redirect::to_login();

		if(\dash\url::isLocal())
		{
			\dash\notif::info(T_('Local mode'));
			\dash\data::line_bottom(T_('You are in Supervisor Panel of Local Mode'));
		}
		// else
		{
			// Check permission and if user can do this operation
			// allow to do it, else show related message in notify center

			if(!\dash\permission::supervisor())
			{
				\dash\header::status(403);
			}

			if(\dash\request::get('server') === 'status')
			{
				\dash\temp::set('force_stop_visitor', true);
			}
		}
	}
}
?>