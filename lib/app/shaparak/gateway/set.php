<?php
namespace lib\app\shaparak\gateway;


class set
{
	public static function first_gateway($_args)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$condition =
		[
			'title'      => 'string_100',
			'website'    => 'enstring_50',
			'websiteurl' => 'url',
			'email'      => 'email',
			'phone'      => 'phone',
			'logo'       => 'string_500',
			'status'     => ['enum' => ['enable', 'disable', 'deleted', 'lock', 'reject', 'pending', 'blocked', 'error']],
			'category'   => 'string_50',
		];

		$require = ['websiteurl', 'email', 'phone'];

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$args = \dash\cleanse::patch_mode($_args, $data);


		$load = \lib\db\shaparak\gateway\get::my_first_gateway(\dash\user::id());

		if(isset($load['id']))
		{
			$args['datemodified'] = date("Y-m-d H:i:s");
			\lib\db\shaparak\gateway\update::update($args, $load['id']);
		}
		else
		{
			$args['user_id']     = \dash\user::id();
			$args['datecreated'] = date("Y-m-d H:i:s");
			\lib\db\shaparak\gateway\insert::new_record($args);
		}

		\dash\notif::ok(T_("Your profile was updated"));
		return true;
	}
}
?>