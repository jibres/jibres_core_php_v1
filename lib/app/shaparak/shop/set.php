<?php
namespace lib\app\shaparak\shop;


class set
{
	public static function first_shop($_args)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$condition =
		[
			'title'           => 'string_100',
			'website'         => 'enstring_50',
			'websiteAddress'  => 'url',
			'emailAddress'    => 'email',
			'telephoneNumber' => 'phone',
			'logo'            => 'string_500',
			'status'          => ['enum' => ['enable', 'disable', 'deleted', 'lock', 'reject', 'pending', 'blocked', 'error']],
			'category'        => 'string_50',
		];

		$require = ['websiteAddress', 'emailAddress', 'telephoneNumber'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$args = \dash\cleanse::patch_mode($_args, $data);


		$load = \lib\db\shaparak\shop\get::my_first_shop(\dash\user::id());

		if(isset($load['id']))
		{
			$args['datemodified'] = date("Y-m-d H:i:s");
			\lib\db\shaparak\shop\update::update($args, $load['id']);
		}
		else
		{
			$args['status']      = 'pending';
			$args['user_id']     = \dash\user::id();
			$args['datecreated'] = date("Y-m-d H:i:s");
			\lib\db\shaparak\shop\insert::new_record($args);
		}

		\dash\notif::ok(T_("Your profile was updated"));
		return true;
	}
}
?>