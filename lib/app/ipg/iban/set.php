<?php
namespace lib\app\ipg\iban;


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

			'card'  => 'string_50',
			'iban' => 'iban',
		];

		$require = ['iban'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$args = \dash\cleanse::patch_mode($_args, $data);


		unset($args['type']);

		$load = \lib\db\ipg\iban\get::my_default_iban(\dash\user::id());

		if(isset($load['id']))
		{
			$args['datemodified'] = date("Y-m-d H:i:s");
			\lib\db\ipg\iban\update::update($args, $load['id']);
		}
		else
		{
			$args['isdefault']   = 1;
			$args['user_id']     = \dash\user::id();
			$args['datecreated'] = date("Y-m-d H:i:s");
			\lib\db\ipg\iban\insert::new_record($args);
		}

		\dash\notif::ok(T_("Your profile was updated"));
		return true;
	}
}
?>