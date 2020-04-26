<?php
namespace lib\pardakhtyar\app;


class customer
{

	public static $sort_field = [];

	public static function add($_args)
	{
		\dash\app::variable($_args);

		if(!\dash\user::id())
		{
			\dash\notif::error(T_(":user not found"), 'user');
			return false;
		}

		// check args
		$args = self::check();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$args['creator']     = \dash\user::id();
		$args['createby']    = 'site';
		$args['datecreated'] = date("Y-m-d H:i:s");
		$return = [];

		$customer_id = \lib\pardakhtyar\db\customer::insert($args);

		if(!$customer_id)
		{
			\dash\app::log('dbErrorCanNotAddCustomer');
			\dash\notif::error(T_("No way to insert Customer"), 'db', 'system');
			return false;
		}

		$return['id'] = \dash\coding::encode($customer_id);
		if(\dash\engine\process::status())
		{
			\dash\log::set('addNewCustomer', ['code' => $customer_id]);
			\dash\notif::ok(T_("Customer successfuly added"));
		}

		return $return;
	}


	public static function edit($_args, $_id)
	{
		\dash\app::variable($_args);

		$result = self::get($_id);

		$id = $_id;
		if(!$result)
		{
			return false;
		}

		// $id = \dash\coding::decode($_id);

		$args = self::check($id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		if(!\dash\app::isset_request('user_id')) unset($args['user_id']);
		if(!\dash\app::isset_request('firstNameFa')) unset($args['firstNameFa']);
		if(!\dash\app::isset_request('lastNameFa')) unset($args['lastNameFa']);
		if(!\dash\app::isset_request('fatherNameFa')) unset($args['fatherNameFa']);
		if(!\dash\app::isset_request('firstNameEn')) unset($args['firstNameEn']);
		if(!\dash\app::isset_request('lastNameEn')) unset($args['lastNameEn']);
		if(!\dash\app::isset_request('fatherNameEn')) unset($args['fatherNameEn']);
		if(!\dash\app::isset_request('registerNumber')) unset($args['registerNumber']);
		if(!\dash\app::isset_request('comNameFa')) unset($args['comNameFa']);
		if(!\dash\app::isset_request('comNameEn')) unset($args['comNameEn']);
		if(!\dash\app::isset_request('birthCrtfctNumber')) unset($args['birthCrtfctNumber']);
		if(!\dash\app::isset_request('commercialCode')) unset($args['commercialCode']);
		if(!\dash\app::isset_request('foreignPervasiveCode')) unset($args['foreignPervasiveCode']);
		if(!\dash\app::isset_request('passportNumber')) unset($args['passportNumber']);
		if(!\dash\app::isset_request('Description')) unset($args['Description']);
		if(!\dash\app::isset_request('telephoneNumber')) unset($args['telephoneNumber']);
		if(!\dash\app::isset_request('emailAddress')) unset($args['emailAddress']);
		if(!\dash\app::isset_request('webSite')) unset($args['webSite']);
		if(!\dash\app::isset_request('fax')) unset($args['fax']);
		if(!\dash\app::isset_request('gender')) unset($args['gender']);
		if(!\dash\app::isset_request('merchantType')) unset($args['merchantType']);
		if(!\dash\app::isset_request('residencyType')) unset($args['residencyType']);
		if(!\dash\app::isset_request('vitalStatus')) unset($args['vitalStatus']);
		if(!\dash\app::isset_request('birthCrtfctSeriesLetter')) unset($args['birthCrtfctSeriesLetter']);
		if(!\dash\app::isset_request('birthCrtfctSeriesNumber')) unset($args['birthCrtfctSeriesNumber']);
		if(!\dash\app::isset_request('birthDate')) unset($args['birthDate']);
		if(!\dash\app::isset_request('registerDate')) unset($args['registerDate']);
		if(!\dash\app::isset_request('passportExpireDate')) unset($args['passportExpireDate']);
		if(!\dash\app::isset_request('nationalCode')) unset($args['nationalCode']);
		if(!\dash\app::isset_request('birthCrtfctSerial')) unset($args['birthCrtfctSerial']);
		if(!\dash\app::isset_request('nationalLegalCode')) unset($args['nationalLegalCode']);
		if(!\dash\app::isset_request('countryCode')) unset($args['countryCode']);
		if(!\dash\app::isset_request('cellPhoneNumber')) unset($args['cellPhoneNumber']);


		if(!empty($args))
		{
			$args['datemodified'] = date("Y-m-d H:i:s");

			$update = \lib\pardakhtyar\db\customer::update($args, $id);

			if(\dash\engine\process::status())
			{
				\dash\log::set('editCustomer', ['code' => $id,]);
				\dash\notif::ok(T_("Customer successfully updated"));
			}
		}
	}



	public static function get($_id)
	{
		if(!is_numeric($_id))
		{
			\dash\notif::error(T_("Customer id not set"));
			return false;
		}

		$get = \lib\pardakhtyar\db\customer::get(['id' => $_id, 'limit' => 1]);

		if(!$get)
		{
			\dash\notif::error(T_("Invalid Customer id"));
			return false;
		}

		$result = self::ready($get);

		return $result;
	}


	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	private static function check($_id = null)
	{

		$user_id = \dash\app::request('user_id');
		if($user_id && !is_numeric($user_id))
		{
			\dash\notif::error(T_("Invalid user id"), 'user_id');
			return false;
		}

		// some check for real person detail
		$isRealPerson = true;
		$isIranian    = true;

		$merchantType = \dash\app::request('merchantType');

		if(isset($merchantType) && is_numeric($merchantType) && in_array(intval($merchantType), [0,1]))
		{
			$merchantType = intval($merchantType);
			if($merchantType === 1)
			{
				$isRealPerson = false;
			}
		}
		else
		{

			if($merchantType && !in_array($merchantType, ['real', 'legal']))
			{
				\dash\notif::error("merchantType must be a number", 'merchantType');
				return false;
			}

			if($merchantType)
			{
				if($merchantType === 'legal')
				{
					$isRealPerson = false;
				}

				$merchantType = \lib\pardakhtyar\type::index_merchantType($merchantType);
			}
		}


		$residencyType = \dash\app::request('residencyType');
		if(isset($residencyType) && is_numeric($residencyType) && in_array(intval($residencyType), [0,1]))
		{
			$residencyType = intval($residencyType);
			if($residencyType === 1)
			{
				$isIranian = false;
			}
		}
		else
		{

			if($residencyType && !in_array($residencyType, ['iranian', 'non-iranian']))
			{
				\dash\notif::error("residencyType must be a number", 'residencyType');
				return false;
			}

			if($residencyType)
			{
				if($residencyType === 'non-iranian')
				{
					$isIranian = false;
				}

				$residencyType = \lib\pardakhtyar\type::index_residencyType($residencyType);
			}

		}


		$firstNameFa = \dash\app::request('firstNameFa');
		if($firstNameFa && mb_strlen($firstNameFa) > 50)
		{
			\dash\notif::error("firstNameFa is out of range", 'firstNameFa');
			return false;
		}

		// check required
		if($isRealPerson && !$isIranian && !$firstNameFa)
		{
			\dash\notif::error("firstNameFa is required", 'firstNameFa');
			return false;
		}

		$lastNameFa = \dash\app::request('lastNameFa');
		if($lastNameFa && mb_strlen($lastNameFa) > 50)
		{
			\dash\notif::error("lastNameFa is out of range", 'lastNameFa');
			return false;
		}

		// check required
		if($isRealPerson && !$isIranian && !$lastNameFa)
		{
			\dash\notif::error("lastNameFa is required", 'lastNameFa');
			return false;
		}

		$fatherNameFa = \dash\app::request('fatherNameFa');
		if($fatherNameFa && mb_strlen($fatherNameFa) > 50)
		{
			\dash\notif::error("fatherNameFa is out of range", 'fatherNameFa');
			return false;
		}

		$firstNameEn = \dash\app::request('firstNameEn');
		if($firstNameEn && mb_strlen($firstNameEn) > 50)
		{
			\dash\notif::error("firstNameEn is out of range", 'firstNameEn');
			return false;
		}

		if($isRealPerson && !$firstNameEn)
		{
			\dash\notif::error("firstNameEn is required", 'firstNameEn');
			return false;
		}

		if(!$isRealPerson)
		{
			$firstNameEn = null;
		}

		$lastNameEn = \dash\app::request('lastNameEn');
		if($lastNameEn && mb_strlen($lastNameEn) > 50)
		{
			\dash\notif::error("lastNameEn is out of range", 'lastNameEn');
			return false;
		}


		if($isRealPerson && !$lastNameEn)
		{
			\dash\notif::error("lastNameEn is required", 'lastNameEn');
			return false;
		}

		if(!$isRealPerson)
		{
			$lastNameEn = null;
		}


		$fatherNameEn = \dash\app::request('fatherNameEn');
		if($fatherNameEn && mb_strlen($fatherNameEn) > 50)
		{
			\dash\notif::error("fatherNameEn is out of range", 'fatherNameEn');
			return false;
		}


		if($isRealPerson && $isIranian && !$fatherNameEn)
		{
			\dash\notif::error("fatherNameEn is required", 'fatherNameEn');
			return false;
		}


		$gender = \dash\app::request('gender');
		if(isset($gender) && is_numeric($gender) && in_array(intval($gender), [0,1]))
		{
			$gender = intval($gender);
		}
		else
		{
			if($gender && !in_array($gender, ['male', 'female']))
			{
				\dash\notif::error("gender must be a number", 'gender');
				return false;
			}

			if($isRealPerson && !$isIranian && !$gender)
			{
				\dash\notif::error("gender is required", 'gender');
				return false;
			}

			if($gender)
			{
				$gender = \lib\pardakhtyar\type::index_gender($gender);
			}
		}

		$birthDate = \dash\app::request('birthDate');

		if($birthDate && !self::checkDateDb($birthDate))
		{
			\dash\notif::error("birthDate must be a timestamp", 'birthDate');
			return false;
		}

		if($isRealPerson && !$birthDate)
		{
			\dash\notif::error("birthDate is required", 'birthDate');
			return false;
		}

		if(!$isRealPerson)
		{
			$birthDate = null;
		}

		if($birthDate)
		{
			$birthDate = self::checkDateDb($birthDate);
		}


		$registerDate = \dash\app::request('registerDate');
		if($registerDate && strtotime($registerDate) == false)
		{
			\dash\notif::error("registerDate must be a timestamp", 'registerDate');
			return false;
		}

		if(!$isRealPerson && !$registerDate)
		{
			\dash\notif::error("registerDate is required", 'registerDate');
			return false;
		}

		if($isRealPerson)
		{
			$registerDate = null;
		}

		if($registerDate)
		{
			$registerDate = self::checkDateDb($registerDate);
		}

		$nationalCode = \dash\app::request('nationalCode');
		if($nationalCode && mb_strlen($nationalCode) !== 10)
		{
			\dash\notif::error("nationalCode must exactly 10 character", 'nationalCode');
			return false;
		}

		if($nationalCode && !\dash\utility\filter::nationalcode($nationalCode))
		{
			\dash\notif::error("Invalid national code syntax", 'nationalCode');
			return false;
		}

		if($isRealPerson && $isIranian && !$nationalCode)
		{
			\dash\notif::error("nationalCode is required", 'nationalCode');
			return false;
		}

		if(!$isRealPerson || !$isIranian)
		{
			$nationalCode = null;
		}


		$registerNumber = \dash\app::request('registerNumber');
		if($registerNumber && mb_strlen($registerNumber) > 50)
		{
			\dash\notif::error("registerNumber is out of range", 'registerNumber');
			return false;
		}

		$comNameFa = \dash\app::request('comNameFa');
		if($comNameFa && mb_strlen($comNameFa) > 50)
		{
			\dash\notif::error("comNameFa is out of range", 'comNameFa');
			return false;
		}

		if(!$isRealPerson && !$comNameFa)
		{
			\dash\notif::error("comNameFa is required", 'comNameFa');
			return false;
		}

		if($isRealPerson)
		{
			$comNameFa = null;
		}

		$comNameEn = \dash\app::request('comNameEn');
		if($comNameEn && mb_strlen($comNameEn) > 50)
		{
			\dash\notif::error("comNameEn is out of range", 'comNameEn');
			return false;
		}

		if(!$isRealPerson && !$comNameEn)
		{
			\dash\notif::error("comNameEn is required", 'comNameEn');
			return false;
		}

		if($isRealPerson)
		{
			$comNameEn = null;
		}

		$birthCrtfctNumber = \dash\app::request('birthCrtfctNumber');
		if($birthCrtfctNumber && mb_strlen($birthCrtfctNumber) > 10)
		{
			\dash\notif::error("birthCrtfctNumber is out of range", 'birthCrtfctNumber');
			return false;
		}

		$vitalStatus = \dash\app::request('vitalStatus');
		if(isset($vitalStatus) && is_numeric($vitalStatus) && in_array(intval($vitalStatus), [0, 1]))
		{
			$vitalStatus = intval($vitalStatus);
		}
		else
		{
			if($vitalStatus && !in_array($vitalStatus, ['live', 'dead']))
			{
				\dash\notif::error("vitalStatus is invalid", 'vitalStatus');
				return false;
			}

			if($vitalStatus)
			{
				$vitalStatus = \lib\pardakhtyar\type::index_vitalStatus($vitalStatus);
			}
		}

		$birthCrtfctSeriesLetter = \dash\app::request('birthCrtfctSeriesLetter');
		if(isset($birthCrtfctSeriesLetter) && is_numeric($birthCrtfctSeriesLetter) && in_array(intval($birthCrtfctSeriesLetter), [0,1,2,3,4,5,6,7,8,9,10,11,12]))
		{
			$birthCrtfctSeriesLetter = intval($birthCrtfctSeriesLetter);
		}
		else
		{
			$birthCrtfctSeriesLetter = \lib\pardakhtyar\type::index_birthCrtfctSeriesLetter($birthCrtfctSeriesLetter);
		}


		$birthCrtfctSeriesNumber = \dash\app::request('birthCrtfctSeriesNumber');
		if($birthCrtfctSeriesNumber && !is_numeric($birthCrtfctSeriesNumber))
		{
			\dash\notif::error("birthCrtfctSeriesNumber must be a number", 'birthCrtfctSeriesNumber');
			return false;
		}

		if($birthCrtfctSeriesNumber && !is_numeric($birthCrtfctSeriesNumber))
		{
			\dash\notif::error("birthCrtfctSeriesNumber must be a number", 'birthCrtfctSeriesNumber');
			return false;
		}

		if($birthCrtfctSeriesNumber && mb_strlen($birthCrtfctSeriesNumber) !== 2)
		{
			\dash\notif::error("birthCrtfctSeriesNumber must 2 character", 'birthCrtfctSeriesNumber');
			return false;
		}


		$nationalLegalCode = \dash\app::request('nationalLegalCode');
		if($nationalLegalCode && mb_strlen($nationalLegalCode) !== 11)
		{
			\dash\notif::error("nationalLegalCode must exactly 11 character", 'nationalLegalCode');
			return false;
		}

		if($isRealPerson)
		{
			$nationalLegalCode = null;
		}


		$commercialCode = \dash\app::request('commercialCode');
		if($commercialCode && mb_strlen($commercialCode) > 50)
		{
			\dash\notif::error("commercialCode is out of range", 'commercialCode');
			return false;
		}


		$countryCode = \dash\app::request('countryCode');
		if($countryCode && mb_strlen($countryCode) !== 2)
		{
			\dash\notif::error("countryCode must exactly 2 character", 'countryCode');
			return false;
		}

		if(!$isIranian && !$countryCode)
		{
			\dash\notif::error("countryCode is requeired", 'countryCode');
			return false;
		}



		$foreignPervasiveCode = \dash\app::request('foreignPervasiveCode');
		if($foreignPervasiveCode && mb_strlen($foreignPervasiveCode) > 50)
		{
			\dash\notif::error("foreignPervasiveCode is out of range", 'foreignPervasiveCode');
			return false;
		}

		if(!$isIranian && !$foreignPervasiveCode)
		{
			\dash\notif::error("foreignPervasiveCode is required");
			return false;
		}

		if($isIranian)
		{
			$foreignPervasiveCode = null;
		}


		$passportNumber = \dash\app::request('passportNumber');
		if($passportNumber && mb_strlen($passportNumber) > 50)
		{
			\dash\notif::error("passportNumber is out of range", 'passportNumber');
			return false;
		}

		if(!$isIranian && !$passportNumber)
		{
			\dash\notif::error("passportNumber is required");
			return false;
		}

		if($isIranian)
		{
			$passportNumber = null;
		}


		$passportExpireDate = \dash\app::request('passportExpireDate');
		if($passportExpireDate && strtotime($passportExpireDate) == false)
		{
			\dash\notif::error("passportExpireDate must be a timestamp", 'passportExpireDate');
			return false;
		}

		if($passportExpireDate && !self::checkDateDb($passportExpireDate))
		{
			\dash\notif::error("passportExpireDate must be a timestamp", 'passportExpireDate');
			return false;
		}

		if(!$isIranian && !$passportExpireDate)
		{
			\dash\notif::error("passportExpireDate is required", 'passportExpireDate');
			return false;
		}

		if($isIranian)
		{
			$passportExpireDate = null;
		}

		if($passportExpireDate)
		{
			$passportExpireDate = self::checkDateDb($passportExpireDate);
		}



		$Description = \dash\app::request('Description');
		if($Description && mb_strlen($Description) > 255)
		{
			\dash\notif::error("Description is out of range", 'Description');
			return false;
		}

		$telephoneNumber = \dash\app::request('telephoneNumber');
		if($telephoneNumber && mb_strlen($telephoneNumber) > 12)
		{
			\dash\notif::error("telephoneNumber is out of range! maximum 12", 'telephoneNumber');
			return false;
		}

		if($telephoneNumber && mb_strlen($telephoneNumber) < 9)
		{
			\dash\notif::error("telephoneNumber is out of range! minimum 9", 'telephoneNumber');
			return false;
		}

		if(!$telephoneNumber)
		{
			\dash\notif::error("telephoneNumber is required", 'telephoneNumber');
			return false;
		}

		$cellPhoneNumber = \dash\app::request('cellPhoneNumber');
		if($cellPhoneNumber && mb_strlen($cellPhoneNumber) !== 11)
		{
			\dash\notif::error("cellPhoneNumber must exactly 11 character", 'cellPhoneNumber');
			return false;
		}

		if(!$cellPhoneNumber)
		{
			\dash\notif::error("cellPhoneNumber is required", 'cellPhoneNumber');
			return false;
		}


		$emailAddress = \dash\app::request('emailAddress');
		if($emailAddress && mb_strlen($emailAddress) > 100)
		{
			\dash\notif::error("emailAddress is out of range! maximum 100", 'emailAddress');
			return false;
		}

		if($emailAddress && mb_strlen($emailAddress) < 3)
		{
			\dash\notif::error("emailAddress is out of range! minimum 3", 'emailAddress');
			return false;
		}


		$webSite = \dash\app::request('webSite');
		if($webSite && mb_strlen($webSite) > 100)
		{
			\dash\notif::error("webSite is out of range! maximum 100", 'webSite');
			return false;
		}

		if($webSite && mb_strlen($webSite) < 3)
		{
			\dash\notif::error("webSite is out of range! minimum 3", 'webSite');
			return false;
		}

		$fax = \dash\app::request('fax');
		if($fax && mb_strlen($fax) > 12)
		{
			\dash\notif::error("fax is out of range! maximum 12", 'fax');
			return false;
		}

		if($fax && mb_strlen($fax) < 9)
		{
			\dash\notif::error("fax is out of range! minimum 9", 'fax');
			return false;
		}


		$birthCrtfctSerial = \dash\app::request('birthCrtfctSerial');
		if($birthCrtfctSerial && mb_strlen($birthCrtfctSerial) !== 6)
		{
			\dash\notif::error("birthCrtfctSerial must exactly 6 character", 'birthCrtfctSerial');
			return false;
		}

		$check_duplicate_args =
		[
			'merchantType'         => $merchantType,
			'residencyType'        => $residencyType,
			'nationalCode'         => $nationalCode,
			'nationalLegalCode'    => $nationalLegalCode,
			'foreignPervasiveCode' => $foreignPervasiveCode,
		];

		$check_duplicate = \lib\pardakhtyar\db\customer::check_duplicate($check_duplicate_args, $_id);
		if(isset($check_duplicate['id']))
		{
			if(intval($check_duplicate['id']) === intval($_id))
			{
				// no problem to edit record
			}
			else
			{
				\dash\notif::error("This data is duplicate");
				return false;
			}
		}


		$args                            = [];
		$args['user_id']                 = $user_id;
		$args['firstNameFa']           = $firstNameFa;
		$args['lastNameFa']            = $lastNameFa;
		$args['fatherNameFa']          = $fatherNameFa;
		$args['firstNameEn']           = $firstNameEn;
		$args['lastNameEn']            = $lastNameEn;
		$args['fatherNameEn']          = $fatherNameEn;
		$args['registerNumber']        = $registerNumber;
		$args['comNameFa']             = $comNameFa;
		$args['comNameEn']             = $comNameEn;
		$args['birthCrtfctNumber']     = $birthCrtfctNumber;
		$args['commercialCode']        = $commercialCode;
		$args['foreignPervasiveCode']  = $foreignPervasiveCode;
		$args['passportNumber']        = $passportNumber;
		$args['Description']           = $Description;
		$args['telephoneNumber']       = $telephoneNumber;
		$args['emailAddress']          = $emailAddress;
		$args['webSite']               = $webSite;
		$args['fax']                   = $fax;
		$args['gender']                = $gender;
		$args['merchantType']          = $merchantType;
		$args['residencyType']         = $residencyType;
		$args['vitalStatus']           = $vitalStatus;
		$args['birthCrtfctSeriesLetter'] = $birthCrtfctSeriesLetter;
		$args['birthCrtfctSeriesNumber'] = $birthCrtfctSeriesNumber;
		$args['birthDate']             = $birthDate;
		$args['registerDate']          = $registerDate;
		$args['passportExpireDate']    = $passportExpireDate;
		$args['nationalCode']          = $nationalCode;
		$args['birthCrtfctSerial']     = $birthCrtfctSerial;
		$args['nationalLegalCode']     = $nationalLegalCode;
		$args['countryCode']           = $countryCode;
		$args['cellPhoneNumber']       = $cellPhoneNumber;
		return $args;
	}

	private static function checkDateDb($_date)
	{
		if(!$_date)
		{
			return null;
		}

		$_date = substr($_date, 0, 10);

		return \dash\date::db($_date);
	}



	// remove useless field to send to shaparak
	public static function ready_for_shaparak($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'birthDate':
				case 'passportExpireDate':
				case 'registerDate':

					if($value)
					{
						$result[$key] = strtotime($value). '000';
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'firstNameFa':
				case 'lastNameFa':
				case 'fatherNameFa':
				case 'firstNameEn':
				case 'lastNameEn':
				case 'fatherNameEn':
				case 'registerNumber':
				case 'comNameFa':
				case 'comNameEn':
				case 'birthCrtfctNumber':
				case 'commercialCode':
				case 'foreignPervasiveCode':
				case 'passportNumber':
				case 'telephoneNumber':
				case 'emailAddress':
				case 'webSite':
				case 'fax':
				case 'gender':
				case 'merchantType':
				case 'residencyType':
				case 'vitalStatus':
				case 'birthCrtfctSeriesLetter':
				case 'birthCrtfctSeriesNumber':
				case 'nationalCode':
				case 'birthCrtfctSerial':
				case 'nationalLegalCode':
				case 'countryCode':
				case 'cellPhoneNumber':
					$result[$key] = $value;
					break;

				case 'Description':
				default:
					// nothing
					break;
			}
		}

		return $result;
	}

	public static function ready($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{

				case 'birthCrtfctSeriesLetter':
				case 'vitalStatus':
				case 'residencyType':
				case 'gender':
				case 'merchantType':
					$fn = 'title_'. $key;
					$result[$key.'_title'] = \lib\pardakhtyar\type::$fn($value);
					$result[$key] = $value;
					break;
				case 'birthDate':
					$result[$key. '_title'] = \dash\datetime::fit($value, 'human');
					$result[$key] = $value;
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}


	public static function list($_string, $_args)
	{
		if(!\dash\user::id())
		{
			return false;
		}

		$default_meta =
		[
			'sort'  => null,
			'order' => null,
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args = array_merge($default_meta, $_args);

		if($_args['sort'] && !in_array($_args['sort'], self::$sort_field))
		{
			$_args['sort'] = null;
		}


		$result            = \lib\pardakhtyar\db\customer::search($_string, $_args);
		$temp              = [];

		foreach ($result as $key => $value)
		{
			$check = self::ready($value);
			if($check)
			{
				$temp[] = $check;
			}
		}

		return $temp;
	}

}
?>