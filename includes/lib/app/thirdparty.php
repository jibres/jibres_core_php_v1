<?php
namespace lib\app;


class thirdparty
{

	use \lib\app\thirdparty\user_id;
	use \lib\app\thirdparty\add;
	use \lib\app\thirdparty\datalist;
	use \lib\app\thirdparty\edit;
	use \lib\app\thirdparty\get;


	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	private static function check($_id = null)
	{
		$type = \dash\app::request('type');
		if(!$_id)
		{
			$type = mb_strtolower($type);
			if(!in_array($type, ['staff', 'customer', 'supplier']))
			{
				\dash\notif::error(T_("Invalid thirdparty type"), 'type');
				return false;
			}
		}

		$mobile = \dash\app::request('mobile');
		if($mobile && !\dash\utility\filter::mobile($mobile))
		{
			\dash\notif::error(T_("Invalid mobile"), 'mobile');
			return false;
		}

		if($mobile)
		{
			$mobile = \dash\utility\filter::mobile($mobile);
		}

		$firstname = \dash\app::request('firstname');
		if($firstname && mb_strlen($firstname) > 100)
		{
			\dash\notif::error(T_("Plese set firstname less than 100 character"), 'firstname');
			return false;
		}

		$lastname = \dash\app::request('lastname');
		if($lastname && mb_strlen($lastname) > 100)
		{
			\dash\notif::error(T_("Plese set firstname less than 100 character"), 'lastname');
			return false;
		}

		$visitor               = \dash\app::request('visitor');
		$visitor2              = \dash\app::request('visitor2');

		$taxexempt             = \dash\app::request('taxexempt') ? 1 : null;
		$marketing             = \dash\app::request('marketing') ? 1 : null;

		$companyname           = \dash\app::request('companyname');
		$companyeconomiccode   = \dash\app::request('companyeconomiccode');
		$companynationalid     = \dash\app::request('companynationalid');
		$companyregisternumber = \dash\app::request('companyregisternumber');

		$displayname             = \dash\app::request('displayname');

		$father = \dash\app::request('father');

		if(\dash\app::isset_request('father'))
		{
			if($father && mb_strlen($father) > 100)
			{
				\dash\notif::error(T_("Invalid father"), 'father');
				return false;
			}
		}

		$nationalcode = \dash\app::request('nationalcode');
		if($nationalcode && !\dash\utility\filter::nationalcode($nationalcode))
		{
			\dash\notif::error(T_("Invalid nationalcode"), 'nationalcode');
			return false;
		}


		$pasportcode = \dash\app::request('pasportcode');
		if($pasportcode && !is_numeric($pasportcode) )
		{
			\dash\notif::error(T_("Invalid pasportcode"), 'pasportcode');
			return false;
		}

		if($pasportcode && intval($pasportcode) > 1E+14)
		{
			\dash\notif::error(T_("Invalid pasportcode"), 'pasportcode');
			return false;
		}

		$birthday = null;

		if(\dash\app::isset_request('birthday') && \dash\app::request('birthday'))
		{
			$birthday = \dash\app::request('birthday');
			$birthday = \dash\date::db($birthday);
			if($birthday === false)
			{
				\dash\notif::error(T_("Invalid birthday"), 'birthday');
				return false;
			}

			if(\dash\utility\jdate::is_jalali($birthday))
			{
				$birthday = \dash\utility\jdate::to_gregorian($birthday, "Y-m-d");
			}

			$datetime1 = new \DateTime($birthday);
			$datetime2 = new \DateTime(date("Y-m-d"));

			if($datetime1 >= $datetime2)
			{
				\dash\notif::error(T_("Invalid birthday, birthday can not larger than date now!"), 'birthday');
				return false;
			}

		}

		$gender = \dash\app::request('gender');
		if($gender && !in_array($gender, ['male', 'female']))
		{
			\dash\notif::error(T_("Invalid gender"), 'gender');
			return false;
		}

		// to remove 0 if not selected gender
		if(!$gender)
		{
			$gender = null;
		}

		$marital = \dash\app::request('marital');
		if($marital && !in_array($marital, ['single', 'married']))
		{
			\dash\notif::error(T_("Invalid marital"), 'marital');
			return false;
		}

		$shcode = \dash\app::request('shcode');
		$shcode = \dash\utility\convert::to_en_number($shcode);
		if($shcode && !is_numeric($shcode))
		{
			\dash\notif::error(T_("Invalid shcode"), 'shcode');
			return false;
		}

		$birthcity = \dash\app::request('birthcity');
		if($birthcity && mb_strlen($birthcity) > 50)
		{
			\dash\notif::error(T_("Invalid birthcity"), 'birthcity');
			return false;
		}

		$zipcode = \dash\app::request('zipcode');
		$zipcode = \dash\utility\convert::to_en_number($zipcode);
		if($zipcode && !is_numeric($zipcode))
		{
			\dash\notif::error(T_("Invalid zipcode"), 'zipcode');
			return false;
		}


		$avatar = \dash\app::request('avatar');
		if($avatar && mb_strlen($avatar) > 2000)
		{
			\dash\notif::error(T_("Invalid avatar"), 'avatar');
			return false;
		}

		$shfrom = \dash\app::request('shfrom');
		if ($shfrom && mb_strlen($shfrom) > 200)
		{
			\dash\notif::error(T_("Invalid issue place"), 'shfrom');
			return false;
		}


		$code = \dash\app::request('code');
		if ($code && !is_numeric($code))
		{
			\dash\notif::error(T_("Invalid code"), 'code');
			return false;
		}

		if(\dash\app::isset_request('code') && !$code)
		{
			$code = \lib\db\userstores::get_costomer_code();
		}

		if($code && intval($code) > 1E+9)
		{
			$code = null;
		}

		$email = \dash\app::request('email');
		if ($email && mb_strlen($email) > 150)
		{
			\dash\notif::error(T_("Invalid email"), 'email');
			return false;
		}


		$phone = \dash\app::request('phone');
		if($phone && mb_strlen($phone) > 50)
		{
			\dash\notif::error(T_("Invalid phone"), 'phone');
			return false;
		}

		$fax = \dash\app::request('fax');
		if($fax && mb_strlen($fax) > 50)
		{
			\dash\notif::error(T_("Invalid fax"), 'fax');
			return false;
		}

		$status = \dash\app::request('status');
		if($status && !in_array($status, ['active','deactive','disable','filter','leave','delete','parent','suspended']))
		{
			\dash\notif::error(T_("Invalid status"), 'status');
			return false;
		}

		$desc = \dash\app::request('desc');
		if($desc && mb_strlen($desc) > 500)
		{
			\dash\notif::error(T_("Invalid desc"), 'desc');
			return false;
		}

		$nationality = \dash\app::request('nationality');
		if($nationality && !\dash\utility\location\countres::check($nationality))
		{
			\dash\notif::error(T_("Invalid nationality"), 'nationality');
			return false;
		}

		$args             = [];
		$args['status']   = $status;

		$staff            = \dash\app::request('staff') ? 1 : null;
		$args['staff']    = $staff;

		$supplier         = \dash\app::request('supplier') ? 1 : null;
		$args['supplier'] = $supplier;

		$customer         = \dash\app::request('customer') ? 1 : null;
		$args['customer'] = $customer;

		if($type)
		{
			$args[$type]      = 1;
		}


		if($args['staff'])
		{
			if(\dash\app::isset_request('mobile') && !$mobile)
			{
				\dash\notif::error(T_("Fill mobile for staff is required!"), 'mobile');
				return false;
			}


			if(\dash\app::isset_request('firstname') || \dash\app::isset_request('lastname') || \dash\app::isset_request('displayname'))
			{
				if(!$firstname && !$lastname && !$displayname)
				{
					\dash\notif::error(T_("Fill name of staff is required"), ['element' => ['name', 'lastName', 'displayname']]);
					return false;
				}
			}
		}

		if(isset($args['supplier']) && $args['supplier'])
		{
			// no check
		}
		else
		{
			if(\dash\app::isset_request('displayname') || \dash\app::isset_request('mobile'))
			{
				if(!$displayname && !$mobile)
				{
					\dash\notif::error(T_("Fill mobile or name is require!"), ['element' => ['displayname', 'mobile']]);
					return false;
				}
			}
		}

		if(!$displayname && ($firstname || $lastname))
		{
			$displayname = trim($firstname. ' '. $lastname);
		}

		$permission = \dash\app::request('permission');
		if(\dash\permission::check("aThirdPartyPermissionChange"))
		{
			if($permission && !in_array($permission, array_keys(\dash\permission::groups())))
			{
				if($permission === 'supervisor')
				{
					if(!\dash\url::isLocal() && !\dash\permission::supervisor())
					{
						\dash\notif::error("Permission is incorrect", 'permission');
						return false;
					}
					else
					{
						// no problem
						// supervisor make a new supervisor
					}
				}
				else
				{
					\dash\app::log('thirdpartyInvalidPermissionTryToSet', \dash\user::id(), $log_meta);
					\dash\notif::error(T_("Permission is incorrect"), 'permission');
					return false;
				}
			}
		}


		$args['permission']          = $permission;

		if(!\dash\permission::check("aThirdPartyPermissionChange") || !isset($args['staff']))
		{
			unset($args['permission']);
		}

		$file = [];

		if(\dash\app::isset_request('nationalthumb') && \dash\app::request('nationalthumb'))
		{
			$file['nationalthumb'] = \dash\app::request('nationalthumb');
		}
		if(\dash\app::isset_request('shthumb') && \dash\app::request('shthumb'))
		{
			$file['shthumb'] = \dash\app::request('shthumb');
		}
		if(\dash\app::isset_request('passportthumb') && \dash\app::request('passportthumb'))
		{
			$file['passportthumb'] = \dash\app::request('passportthumb');
		}

		if(!empty($file))
		{
			$args['file'] = json_encode($file, JSON_UNESCAPED_UNICODE);
		}

		$args['displayname']           = $displayname;
		$args['mobile']                = $mobile;
		$args['code']                  = $code;
		$args['email']                 = $email;
		$args['shfrom']                = $shfrom;
		$args['nationalcode']          = $nationalcode;
		$args['nationality']           = $nationality;
		$args['pasportcode']           = $pasportcode;
		$args['firstname']             = $firstname;
		$args['lastname']              = $lastname;
		$args['father']                = $father;
		$args['birthday']              = $birthday;
		$args['gender']                = $gender;
		$args['marital']               = $marital;
		$args['shcode']                = $shcode;
		$args['birthcity']             = $birthcity;
		$args['avatar']                = $avatar;
		$args['phone']                 = $phone;
		$args['fax']                   = $fax;
		$args['desc']                  = $desc;
		$args['visitor']               = $visitor;
		$args['visitor2']              = $visitor2;
		$args['taxexempt']             = $taxexempt;
		$args['marketing']             = $marketing;
		$args['companyname']           = $companyname;
		$args['companyeconomiccode']   = $companyeconomiccode;
		$args['companynationalid']     = $companynationalid;
		$args['companyregisternumber'] = $companyregisternumber;


		return $args;
	}


	/**
	 * ready data of member to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function ready($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'id':
				case 'store_id':
				case 'user_id':
					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'file':
					$result[$key] = $value;
					if(is_string($value))
					{
						$result['file_array'] = json_decode($value, true);
					}
					break;

				case 'desc':
					if(is_string($value) && $value && substr($value, 0, 1) === '{')
					{
						$temp = json_decode($value, true);
						$result = array_merge($temp, $result);
					}

					$result[$key] = $value;
					break;

				case 'avatar':
					$result['avatar'] = $value ? $value : \dash\app::static_avatar_url();
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}
		// var_dump($result);exit();
		return $result;
	}

}
?>
