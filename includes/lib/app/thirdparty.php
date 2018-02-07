<?php
namespace lib\app;


class thirdparty
{

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
		$type = \lib\app::request('type');
		if(!$_id)
		{
			$type = trim($type);
			$type = mb_strtolower($type);
			if(!in_array($type, ['staff', 'customer', 'supplier']))
			{
				\lib\debug::error(T_("Invalid thirdparty type"), 'type');
				return false;
			}
		}

		$mobile = \lib\app::request('mobile');
		$mobile = trim($mobile);

		if($mobile && !\lib\utility\filter::mobile($mobile))
		{
			\lib\debug::error(T_("Invalid mobile"), 'mobile');
			return false;
		}

		$firstname = \lib\app::request('firstname');
		$firstname = trim($firstname);
		if($firstname && mb_strlen($firstname) > 100)
		{
			\lib\debug::error(T_("Plese set firstname less than 100 character"), 'firstname');
			return false;
		}

		$lastname = \lib\app::request('lastname');
		$lastname = trim($lastname);
		if($lastname && mb_strlen($lastname) > 100)
		{
			\lib\debug::error(T_("Plese set firstname less than 100 character"), 'lastname');
			return false;
		}

		$detail = null;

		if($type === 'supplier')
		{
			$displayname             = \lib\app::request('company');
			$detail                  = [];
			$detail['visitorname']   = \lib\app::request('visitorname');
			$detail['visitormobile'] = \lib\app::request('visitormobile');
			$detail                  = json_encode($detail, JSON_UNESCAPED_UNICODE);
		}
		else
		{
			if(\lib\app::isset_request('firstname') || \lib\app::isset_request('lastname'))
			{
				if(!$firstname && !$lastname)
				{
					\lib\debug::error(T_("firstname or lastname is required"), ['firstname', 'lastname']);
					return false;
				}
			}
			$displayname = trim($firstname. ' '. $lastname);

		}

		$father = \lib\app::request('father');
		$father = trim($father);

		if(\lib\app::isset_request('father'))
		{
			if($father && mb_strlen($father) > 100)
			{
				\lib\debug::error(T_("Invalid father"), 'father');
				return false;
			}
		}

		$nationalcode = \lib\app::request('nationalcode');
		$nationalcode = trim($nationalcode);
		if($nationalcode && !\lib\utility\nationalcode::check($nationalcode))
		{
			\lib\debug::error(T_("Invalid nationalcode"), 'nationalcode');
			return false;
		}


		$pasportcode = \lib\app::request('pasportcode');
		$pasportcode = trim($pasportcode);
		if($pasportcode && !is_numeric($pasportcode) )
		{
			\lib\debug::error(T_("Invalid pasportcode"), 'pasportcode');
			return false;
		}

		if($pasportcode && intval($pasportcode) > 1E+14)
		{
			\lib\debug::error(T_("Invalid pasportcode"), 'pasportcode');
			return false;
		}

		$birthday = null;

		if(\lib\app::isset_request('birthday'))
		{
			$birthday = \lib\app::request('birthday');
			$birthday = \lib\date::db($birthday);
			if($birthday === false)
			{
				\lib\debug::error(T_("Invalid birthday"), 'birthday');
				return false;
			}

			$datetime1 = new \DateTime($birthday);
			$datetime2 = new \DateTime(date("Y-m-d"));

			if($datetime1 >= $datetime2)
			{
				\lib\debug::error(T_("Invalid birthday, birthday can not larger than date now!"), 'birthday');
				return false;
			}

			$datetime2 = \lib\utility\jdate::date("Y-m-d", time(), false);
			$datetime2 = new \DateTime($datetime2);

			if($datetime1 >= $datetime2)
			{
				\lib\debug::error(T_("Invalid birthday, birthday can not larger than date now!"), 'birthday');
				return false;
			}

		}


		$pasportdate = \lib\app::request('pasportdate');
		$pasportdate = \lib\date::db($pasportdate);
		if($pasportdate === false)
		{
			\lib\debug::error(T_("Invalid pasportdate"), 'pasportdate');
			return false;
		}

		$gender = \lib\app::request('gender');
		if($gender && !in_array($gender, ['male', 'female']))
		{
			\lib\debug::error(T_("Invalid gender"), 'gender');
			return false;
		}

		$marital = \lib\app::request('marital');
		if($marital && !in_array($marital, ['single', 'married']))
		{
			\lib\debug::error(T_("Invalid marital"), 'marital');
			return false;
		}

		$shcode = \lib\app::request('shcode');
		$shcode = trim($shcode);
		$shcode = \lib\utility\convert::to_en_number($shcode);
		if($shcode && !is_numeric($shcode))
		{
			\lib\debug::error(T_("Invalid shcode"), 'shcode');
			return false;
		}

		$birthcity = \lib\app::request('birthcity');
		$birthcity = trim($birthcity);
		if($birthcity && mb_strlen($birthcity) > 50)
		{
			\lib\debug::error(T_("Invalid birthcity"), 'birthcity');
			return false;
		}

		$zipcode = \lib\app::request('zipcode');
		$zipcode = trim($zipcode);
		$zipcode = \lib\utility\convert::to_en_number($zipcode);
		if($zipcode && !is_numeric($zipcode))
		{
			\lib\debug::error(T_("Invalid zipcode"), 'zipcode');
			return false;
		}


		$avatar = \lib\app::request('avatar');
		if($avatar && mb_strlen($avatar) > 2000)
		{
			\lib\debug::error(T_("Invalid avatar"), 'avatar');
			return false;
		}

		$shfrom = \lib\app::request('shfrom');
		if ($shfrom && mb_strlen($shfrom) > 200)
		{
			\lib\debug::error(T_("Invalid issue place"), 'shfrom');
			return false;
		}


		$code = \lib\app::request('code');
		if ($code && mb_strlen($code) > 100)
		{
			\lib\debug::error(T_("Invalid code"), 'code');
			return false;
		}

		$email = \lib\app::request('email');
		if ($email && mb_strlen($email) > 150)
		{
			\lib\debug::error(T_("Invalid email"), 'email');
			return false;
		}

		$city = \lib\app::request('city');
		$city = trim($city);
		if($city && mb_strlen($city) > 100)
		{
			\lib\debug::error(T_("Invalid city"), 'city');
			return false;
		}

		$province = \lib\app::request('province');
		$province = trim($province);
		if($province && mb_strlen($province) > 100)
		{
			\lib\debug::error(T_("Invalid province"), 'province');
			return false;
		}

		$country = \lib\app::request('country');
		$country = trim($country);
		if($country && mb_strlen($country) > 100)
		{
			\lib\debug::error(T_("Invalid country"), 'country');
			return false;
		}

		$address = \lib\app::request('address');
		$address = trim($address);
		if($address && mb_strlen($address) > 500)
		{
			\lib\debug::error(T_("Invalid address"), 'address');
			return false;
		}

		$phone = \lib\app::request('phone');
		$phone = trim($phone);
		if($phone && mb_strlen($phone) > 50)
		{
			\lib\debug::error(T_("Invalid phone"), 'phone');
			return false;
		}

		$status = \lib\app::request('status');
		$status = trim($status);
		if($status && !in_array($status, ['active','deactive','disable','filter','leave','delete','parent','suspended']))
		{
			\lib\debug::error(T_("Invalid status"), 'status');
			return false;
		}

		$desc = \lib\app::request('desc');
		$desc = trim($desc);
		if($desc && mb_strlen($desc) > 500)
		{
			\lib\debug::error(T_("Invalid desc"), 'desc');
			return false;
		}

		$args                 = [];
		$args['type']         = $type;
		$args['status']       = $status;

		if($type)
		{
			$args[$type]      = 1;
		}

		if($type === 'supplier')
		{
			$args['displayname'] = $displayname;
			$args['desc']        = $detail;
		}
		else
		{
			if(\lib\app::isset_request('firstname') || \lib\app::isset_request('lastname'))
			{
				if(!$firstname && !$lastname)
				{
					\lib\debug::error(T_("Fill name or family is require!"), ['firstname', 'lastname']);
					return false;
				}
			}

			$args['displayname']  = $displayname;
			$args['mobile']       = $mobile;
			$args['code']         = $code;
			$args['email']        = $email;
			$args['shfrom']       = $shfrom;
			$args['nationalcode'] = $nationalcode;
			$args['pasportcode']  = $pasportcode;
			$args['nationalcode'] = $nationalcode;
			$args['pasportcode']  = $pasportcode;
			$args['firstname']    = $firstname;
			$args['lastname']     = $lastname;
			$args['father']       = $father;
			$args['birthday']     = $birthday;
			$args['pasportdate']  = $pasportdate;
			$args['gender']       = $gender;
			$args['marital']      = $marital;
			$args['shcode']       = $shcode;
			$args['birthcity']    = $birthcity;
			$args['zipcode']      = $zipcode;
			$args['avatar']       = $avatar;
			$args['city']         = $city;
			$args['province']     = $province;
			$args['country']      = $country;
			$args['address']      = $address;
			$args['phone']        = $phone;
			$args['desc']         = $desc;
		}

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
				case 'school_id':
				case 'user_id':
					if(isset($value))
					{
						$result[$key] = \lib\utility\shortURL::encode($value);
					}
					else
					{
						$result[$key] = null;
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
					$result['avatar'] = $value ? $value : \lib\app::static_avatar_url();
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
