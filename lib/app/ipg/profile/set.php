<?php
namespace lib\app\ipg\profile;


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
			'birthdate'              => 'birthdate',
			'companyname'           => 'string_50',
			'companyname_en'        => 'enstring_50',
			'companynationalid'     => 'intstring_11_11',
			'companyregisternumber' => 'intstring_10_10',
			'ceonationalcode'       => 'nationalcode',
			'phone'                 => 'phone',
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

		if($data['type'] === 'legal')
		{
			$data['firstname']    = null;
			$data['firstname_en'] = null;
			$data['lastname']     = null;
			$data['lastname_en']  = null;
			$data['father']       = null;
			$data['father_en']    = null;
			$data['nationalcode'] = null;
			$data['birthdate']    = null;
			$data['gender']       = 'company';
			$data['company']      = 1;
		}
		elseif($data['type'] === 'real')
		{
			$data['companyname']           = null;
			$data['companyname_en']        = null;
			$data['companynationalid']     = null;
			$data['companyregisternumber'] = null;
			$data['ceonationalcode']       = null;
			$data['company']      = 0;
		}

		unset($data['type']);

		$load = \lib\db\ipg\userdetail\get::my_detail(\dash\user::id());
		if(isset($load['user_id']))
		{
			$data['datemodified'] = date("Y-m-d H:i:s");
			\lib\db\ipg\userdetail\update::update_user_id($data, $load['user_id']);
		}
		else
		{
			$data['user_id']     = \dash\user::id();
			$data['datecreated'] = date("Y-m-d H:i:s");
			\lib\db\ipg\userdetail\insert::new_record($data);
		}

		\dash\notif::ok(T_("Your profile was updated"));
		return true;
	}
}
?>