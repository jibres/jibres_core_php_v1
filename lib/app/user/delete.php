<?php
namespace lib\app\user;


class delete
{

	public static function delete_user($_user_id)
	{
		if(!$_user_id || !is_numeric($_user_id))
		{
			return false;
		}

		$deletedetail               = [];
		$deletedetail['remover']    = \lib\user::id();
		$deletedetail['deletedate'] = date("Y-m-d H:i:s");
		$loadAll                    = \lib\db\users\users::get(['id' => $_user_id, 'limit' => 1]);
		if(!is_array($loadAll))
		{
			$loadAll = [];
		}

		if(isset($loadAll['permission']) && $loadAll['permission'])
		{
			\dash\notif::error(T_("Can not remove user by permission"));
			return false;
		}

		if(isset($loadAll['status']) && $loadAll['status'] === 'removed')
		{
			\dash\notif::error(T_("This user was removed"));
			return false;
		}

		$deletedetail = array_merge($deletedetail, $loadAll);
		$deletedetail = json_encode($deletedetail, JSON_UNESCAPED_UNICODE);

		$update_old                         = [];

		$update_old['mobile']               = null;
		$update_old['email']                = null;
		$update_old['username']             = null;
		$update_old['displayname']          = null;
		$update_old['gender']               = null;
		$update_old['title']                = null;
		$update_old['password']             = null;
		$update_old['verifymobile']         = null;
		$update_old['verifyemail']          = null;
		$update_old['avatar']               = null;
		$update_old['parent']               = null;
		$update_old['type']                 = null;
		$update_old['pin']                  = null;
		$update_old['ref']                  = null;
		$update_old['twostep']              = null;
		$update_old['birthday']             = null;
		$update_old['unit_id']              = null;
		$update_old['language']             = null;
		$update_old['website']              = null;
		$update_old['facebook']             = null;
		$update_old['twitter']              = null;
		$update_old['instagram']            = null;
		$update_old['linkedin']             = null;
		$update_old['gmail']                = null;
		$update_old['sidebar']              = null;
		$update_old['firstname']            = null;
		$update_old['lastname']             = null;
		$update_old['bio']                  = null;
		$update_old['forceremember']        = null;
		$update_old['signature']            = null;
		$update_old['father']               = null;
		$update_old['nationality']          = null;
		$update_old['pasportdate']          = null;
		$update_old['marital']              = null;
		$update_old['foreign']              = null;
		$update_old['phone']                = null;
		$update_old['detail']               = null;
		$update_old['permission']           = null;

		$update_old['status']               = 'removed';

		$update_old['nationalcode']         = null;
		$update_old['pasportcode']          = null;
		$update_old['meta']                 = $deletedetail;

		\lib\db\users\users::update($update_old, $_user_id);

		\dash\log::set('crmMemberRemoved', ['code' => $_user_id]);
		return true;

	}

}
?>