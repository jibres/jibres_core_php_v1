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

		if(!\dash\permission::supervisor())
		{
			\dash\header::status(403);
		}

		if(\dash\request::get('server') === 'status')
		{
			\dash\temp::set('force_stop_visitor', true);
		}


		self::check_su_access();

	}


	/**
	 * { function_description }
	 */
	private static function check_su_access()
	{
		$access = \dash\session::get('su_access');
		if(!$access || !isset($access['time']))
		{
			if(\dash\url::module() !== 'passwd')
			{
				\dash\redirect::to(\dash\url::here(). '/passwd');
			}
			return;
		}

		if(time() - intval($access['time']) > (60*60))
		{
			\dash\session::clean('su_access');

			\dash\redirect::to(\dash\url::here());
		}

		// in status page needless to update session
		if(\dash\request::get('cmd') === 'health')
		{
			return;
		}

		// while supervisor active in su needless to set password again
		$su_access_detail =
		[
			'time'    => time(),
			'acccess' => true,
		];

		\dash\session::set('su_access', $su_access_detail);
	}
}
?>