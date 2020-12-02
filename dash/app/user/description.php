<?php
namespace dash\app\user;


class description
{

	public static function add($_post, $_user_id)
	{

		$user_id              = \dash\coding::decode($_user_id);
		$request              = [];
		$request['text']      = \dash\validate::desc($_post);
		$request['user_id']   = $user_id;
		$request['creator']   = \dash\user::id();
		$request['status']    = 'enable';

		if(!$request['user_id'])
		{
			\dash\notif::error(T_("Invalid user id"), 'id');
			return false;
		}

		if(!trim($request['text']))
		{
			\dash\notif::error(T_("Please fill the box"), 'note');
			return false;
		}

		$check_duplicate = \dash\db\userdetail::get(['user_id' => $user_id, 'status' => 'enable', 'text' => $request['text'], 'limit' => 1]);

		if($check_duplicate)
		{
			\dash\notif::error(T_("Duplicate note for user founded"), 'note');
			return false;
		}

		\dash\db\userdetail::insert($request);

		\dash\notif::ok(T_("Note saved"));
		return true;
	}

	public static function remove($_note_id, $_user_id)
	{
		$user_id = \dash\coding::decode($_user_id);
		$noteid  = \dash\validate::id($_note_id);

		if(!$user_id)
		{
			\dash\notif::error(T_("Invalid user id"), 'id');
			return false;
		}

		if(!$noteid)
		{
			\dash\notif::error(T_("Invalid notes id"), 'id');
			return false;
		}

		$check_exist = \dash\db\userdetail::get(['user_id' => $user_id, 'id' => $noteid, 'limit' => 1]);
		if(!isset($check_exist['id']))
		{
			\dash\notif::error(T_("Invalid id!"));
			return false;
		}

		$update = \dash\db\userdetail::update(['status' => 'delete', 'datemodified' => date("Y-m-d H:i:s")], $noteid);

		\dash\notif::ok(T_("Notes removed"));
		return true;

	}


	public static function list($_user_id)
	{

		$args              = [];
		$args['user_id']   = \dash\coding::decode($_user_id);
		$args['userdetail.status']   = 'enable';

		if(!$args['user_id'])
		{
			return [];
		}

		$dataTable         = \dash\db\userdetail::search(null, $args);

		return $dataTable;

	}

}
?>