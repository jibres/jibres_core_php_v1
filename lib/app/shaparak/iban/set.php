<?php
namespace lib\app\shaparak\iban;


class set
{
	public static function user_default_iban($_args)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}


		$condition =
		[

			'merchantIban' => 'iban',
		];

		$require = ['merchantIban'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$args = \dash\cleanse::patch_mode($_args, $data);


		$load = \lib\db\shaparak\iban\get::my_default_iban(\dash\user::id());

		if(isset($load['id']))
		{
			$args['datemodified'] = date("Y-m-d H:i:s");
			\lib\db\shaparak\iban\update::update($args, $load['id']);
		}
		else
		{
			$args['isdefault']   = 1;
			$args['status']      = 'pending';
			$args['user_id']     = \dash\user::id();
			$args['datecreated'] = date("Y-m-d H:i:s");
			\lib\db\shaparak\iban\insert::new_record($args);
		}

		\dash\notif::ok(T_("Your profile was updated"));
		return true;
	}



	/**
	 * Add new iban.
	 *
	 * @param      <type>   $_args  The arguments
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function add_new_iban($_args)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$condition =
		[
			'title' => 'string_50',
			'merchantIban'  => 'iban',
		];

		$require = ['merchantIban'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$check_duplicate_ibann = \lib\db\shaparak\iban\get::check_duplicate_ibann($data['iban'], \dash\user::id());

		if(isset($check_duplicate_ibann['id']))
		{
			\dash\notif::error(T_("This IBAN was exists in your list"));
			return false;
		}

		$data['user_id']     = \dash\user::id();
		$data['status']      = 'pending';
		$data['datecreated'] = date("Y-m-d H:i:s");
		\lib\db\shaparak\iban\insert::new_record($data);

		\dash\notif::ok(T_("IBAN was added"));

		return true;
	}
}
?>