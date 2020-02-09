<?php
namespace lib\app\nic_contact;


class edit
{


	public static function edit($_args, $_id)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$load = \lib\app\nic_contact\get::get($_id);
		if(!$load || !isset($load['id']))
		{
			return false;
		}


		$title    	  = (isset($_args['title']) 	    && is_string($_args['title']))		     ? $_args['title'] 		    : null;
		$isdefault    = (isset($_args['isdefault']) 	&& is_string($_args['isdefault']))		 ? $_args['isdefault'] 	 	: null;


		$isdefault = $isdefault ? 1 : null;

		if($isdefault)
		{
			\lib\db\nic_contact\update::remove_old_default(\dash\user::id());
		}

		if($title && mb_strlen($title) > 100)
		{
			\dash\notif::error(T_("Title must be less than 100 character"), 'title');
			return false;
		}

		$update =
		[
			'title'     => $title,
			'isdefault' => $isdefault,
		];


		$contact = \lib\db\nic_contact\update::update($update, $load['id']);
		if($contact)
		{
			\dash\notif::ok(T_("Contact updateded"));
			return true;
		}
		else
		{
			\dash\notif::error(T_("No way to update data"));
			return false;
		}

	}
}
?>