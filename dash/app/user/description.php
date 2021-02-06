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
			\dash\notif::error(T_("Please fill the box"), 'notes');
			return false;
		}

		$check_duplicate = \dash\db\userdetail::get(['user_id' => $user_id, 'status' => 'enable', 'text' => $request['text'], 'limit' => 1]);

		if($check_duplicate)
		{
			\dash\notif::error(T_("Duplicate notes for user founded"), 'notes');
			return false;
		}

		\dash\db\userdetail::insert($request);

		\dash\notif::ok(T_("Note saved"));
		return true;
	}

	public static function remove($_notes_id, $_user_id)
	{
		$user_id = \dash\coding::decode($_user_id);
		$notesid  = \dash\validate::id($_notes_id);

		if(!$user_id)
		{
			\dash\notif::error(T_("Invalid user id"), 'id');
			return false;
		}

		if(!$notesid)
		{
			\dash\notif::error(T_("Invalid notes id"), 'id');
			return false;
		}

		$check_exist = \dash\db\userdetail::get(['user_id' => $user_id, 'id' => $notesid, 'limit' => 1]);
		if(!isset($check_exist['id']))
		{
			\dash\notif::error(T_("Invalid id!"));
			return false;
		}

		if(isset($check_exist['status']) && $check_exist['status'] === 'delete')
		{
			\dash\notif::error(T_("Notes not found"));
			return false;
		}

		$update = \dash\db\userdetail::update(['status' => 'delete', 'datemodified' => date("Y-m-d H:i:s")], $notesid);

		\dash\notif::ok(T_("Notes removed"));
		return true;

	}

	private static function ready($_data)
	{
		unset($_data['user_id']);
		unset($_data['creator']);
		unset($_data['displayname']);
		unset($_data['datemodified']);
		unset($_data['status']);
		return $_data;
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

		if(!is_array($dataTable))
		{
			$dataTable = [];
		}

		$dataTable = array_map(['self', 'ready'], $dataTable);

		return $dataTable;

	}

}
?>