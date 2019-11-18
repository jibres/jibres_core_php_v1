<?php
namespace lib\app\customer;

class comment
{
	private static function load_user_id($_userstore_id)
	{

		$_userstore_id = \dash\coding::decode($_userstore_id);
		if(!$_userstore_id)
		{
			\dash\notif::error(T_("Invalid user id"));
			return false;
		}

		$load = \lib\db\userstores::get(['id' => $_userstore_id, 'store_id' => \lib\store::id(), 'limit' => 1]);
		if(!isset($load['user_id']))
		{
			\dash\notif::error(T_("Invalid user id"));
			return false;
		}
		return $load['user_id'];
	}

	public static function add($_note, $_id)
	{
		\dash\permission::access('customerNoteAdd');

		$user_id = self::load_user_id($_id);
		if(!$user_id)
		{
			return false;
		}

		$request              = [];
		$request['text']      = $_note;
		$request['user_id']   = $user_id;
		$request['creator']   = \dash\user::id();
		$request['status']    = 'enable';
		$request['subdomain'] = \dash\url::subdomain();

		if(!trim($request['text']))
		{
			\dash\notif::error(T_("Please fill the box"), 'note');
			return false;
		}

		$check_duplicate = \dash\db\userdetail::get(['user_id' => $user_id, 'text' => $request['text'], 'subdomain' => \dash\url::subdomain(), 'limit' => 1]);
		if($check_duplicate)
		{
			\dash\notif::error(T_("Duplicate note for user founded"), 'note');
			return false;
		}

		\dash\db\userdetail::insert($request);
		\dash\notif::ok(T_("Note saved"));
		return true;
	}



	public static function list($_id, $_limit = 100)
	{
		\dash\permission::access('customerNoteView');

		$user_id = self::load_user_id($_id);
		if(!$user_id)
		{
			return false;
		}

		$args              = [];
		$args['userdetail.user_id']   = $user_id;
		$args['userdetail.status']    = 'enable';
		$args['userdetail.subdomain'] = \dash\url::subdomain();
		$dataTable         = \dash\db\userdetail::search(null, $args);

		return $dataTable;

	}

	public static function remove($_id, $_userstore_id)
	{
		\dash\permission::access('customerNoteDelete');

		$user_id = self::load_user_id($_userstore_id);
		if(!$user_id)
		{
			return false;
		}

		$check =
		[
			'subdomain' => \dash\url::subdomain(),
			'user_id'   => $user_id,
			'status'    => 'enable',
			'limit'     => 1,
		];

		$check = \dash\db\userdetail::get($check);

		if(!isset($check['id']))
		{
			\dash\notif::error(T_("Note not found"));
			return false;
		}

		\dash\db\userdetail::update(['status' => 'delete'], $check['id']);
		\dash\notif::ok(T_("Note removed"));
		return true;
	}
}
?>