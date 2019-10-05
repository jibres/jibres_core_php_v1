<?php
namespace content_crm\transactions\add;


class model
{

	/**
	 * add a new record of transaction
	 */
	public static function post()
	{
		$id = \dash\request::get('id');

		if(!is_numeric($id))
		{
			$id = null;
		}

		$title  = \dash\request::post('title');
		$unit   = \dash\request::post('unit');
		$mobile = \dash\request::post('mobile');

		$plus   = \dash\request::post('amount');
		$desc   = \dash\request::post('desc');
		$type   = \dash\request::post('type');

		if(!\dash\user::login())
		{
			\dash\notif::error(T_("You must login to add new transaction"));
			return false;
		}

		$user_id = null;

		if(!$title)
		{
			\dash\notif::error(T_("Please set the transaction title"));
			return false;
		}

		if(!$unit)
		{
			\dash\notif::error(T_("Please select one of the unit items"));
			return false;
		}


		if(!$mobile)
		{
			\dash\notif::error(T_("Mobile can not be null"));
			return false;
		}

		if(!$type)
		{
			\dash\notif::error(T_("Please select one of the type items"));
			return false;
		}


		if(!in_array($type, ['money', 'gift', 'prize', 'transfer']))
		{
			\dash\notif::error(T_("Invalid type"));
			return false;
		}

		if(!$plus)
		{
			\dash\notif::error(T_("Please fill the minus or plus field"));
			return false;
		}

		if($plus && !is_numeric($plus))
		{
			\dash\notif::error(T_("Invalid plus field"));
			return false;
		}


		$user_id = \dash\db\users::get_by_mobile(\dash\utility\filter::mobile($mobile));
		if(isset($user_id['id']))
		{
			$user_id = $user_id['id'];
		}
		else
		{
			\dash\notif::error(T_("Mobile not exist"));
			return false;
		}

		if(!$user_id)
		{
			\dash\notif::error(T_("User id not set"));
			return false;
		}


		$insert =
		[
			'caller'    => 'manually',
			'title'     => $title,
			'user_id'   => $user_id,
			'plus'      => $plus,
			'minus'     => null,
			'payment'   => null,
			'type'      => $type,
			'unit'      => $unit,
			'date'      => date("Y-m-d H:i:s"),
			'parent_id' => $id,
			'verify'    => 1,
			'dateverify' => time(),
		];

		\dash\db\transactions::set($insert);

		if(\dash\engine\process::status())
		{
			\dash\log::set('addTransactionManualy', ['title' => $title, 'plus' => $plus, 'user_id' => $user_id]);
			\dash\notif::ok(T_("Transaction inserted"));
			\dash\redirect::to(\dash\url::here(). '/transactions');
		}
	}
}
?>
