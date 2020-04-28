<?php
namespace lib\app\shaparak\profile;


class set
{
	public static function user_set($_args)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}


		$condition =
		[
			'type'                  => ['enum' => ['legal', 'real']],
			'gender'                => ['enum' => ['male', 'female']],
			'firstname'             => 'string_50',
			'firstname_en'          => 'enstring_50',
			'lastname'              => 'string_50',
			'lastname_en'           => 'enstring_50',
			'father'                => 'string_50',
			'father_en'             => 'enstring_50',
			'nationalcode'          => 'nationalcode',
			'birthdate'             => 'birthdate',
			'companyname'           => 'string_50',
			'companyname_en'        => 'enstring_50',
			'companynationalid'     => 'intstring_11_11',
			'companyregisternumber' => 'intstring_10_10',
			'ceonationalcode'       => 'nationalcode',
			'phone'                 => 'phone',

			'nationalpic'           => 'string_1000',
			'shpic'                 => 'string_1000',
		];


		if(isset($_args['type']) && $_args['type'] === 'legal')
		{
			$require = ['companyname','companyname_en','companynationalid', 'phone'];
		}
		else
		{
			$require = ['firstname_en','lastname_en','father_en','nationalcode','birthdate', 'phone'];
		}

		$meta =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$args = \dash\cleanse::patch_mode($_args, $data);

		if($data['type'] === 'legal')
		{
			unset($args['firstname']);
			unset($args['firstname_en']);
			unset($args['lastname']);
			unset($args['lastname_en']);
			unset($args['father']);
			unset($args['father_en']);
			unset($args['nationalcode']);
			unset($args['birthdate']);
			unset($args['gender']);

			// $args['gender']       = 'company';
			$args['company']      = 1;
		}
		elseif($data['type'] === 'real')
		{
			unset($args['companyname']);
			unset($args['companyname_en']);
			unset($args['companynationalid']);
			unset($args['companyregisternumber']);
			unset($args['ceonationalcode']);

			$args['company']      = 0;
		}

		unset($args['type']);

		$load = \lib\db\shaparak\customer\get::my_detail(\dash\user::id());
		if(isset($load['user_id']))
		{
			$args['datemodified'] = date("Y-m-d H:i:s");
			\lib\db\shaparak\customer\update::update_user_id($args, $load['user_id']);
		}
		else
		{
			$args['user_id']     = \dash\user::id();
			$args['datecreated'] = date("Y-m-d H:i:s");
			\lib\db\shaparak\customer\insert::new_record($args);
		}

		\dash\notif::ok(T_("Your profile was updated"));
		return true;
	}
}
?>