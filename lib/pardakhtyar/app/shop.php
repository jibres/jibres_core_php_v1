<?php
namespace lib\pardakhtyar\app;


class shop
{

	public static $sort_field = [];

	public static function add($_args)
	{
		\dash\app::variable($_args);

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("User not found"), 'user');
			return false;
		}

		// check args
		$args = self::check();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$args['creator']     = \dash\user::id();
		$args['datecreated'] = date("Y-m-d H:i:s");
		$return = [];

		$shop_id = \lib\pardakhtyar\db\shop::insert($args);

		if(!$shop_id)
		{
			\dash\app::log('dbErrorCanNotAddShop');
			\dash\notif::error(T_("No way to insert Shop"), 'db', 'system');
			return false;
		}

		$return['id'] = \dash\coding::encode($shop_id);
		if(\dash\engine\process::status())
		{
			\dash\log::set('addNewShop', ['code' => $shop_id]);
			\dash\notif::ok(T_("Shop successfuly added"));
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
		if(!\dash\app::isset_request('customer_id')) unset($args['customer_id']);
		if(!\dash\app::isset_request('farsiName')) unset($args['farsiName']);
		if(!\dash\app::isset_request('englishName')) unset($args['englishName']);
		if(!\dash\app::isset_request('telephoneNumber')) unset($args['telephoneNumber']);
		if(!\dash\app::isset_request('postalCode')) unset($args['postalCode']);
		if(!\dash\app::isset_request('businessCertificateNumber')) unset($args['businessCertificateNumber']);
		if(!\dash\app::isset_request('certificateIssueDate')) unset($args['certificateIssueDate']);
		if(!\dash\app::isset_request('certificateExpiryDate')) unset($args['certificateExpiryDate']);
		if(!\dash\app::isset_request('Description')) unset($args['Description']);
		if(!\dash\app::isset_request('businessCategoryCode')) unset($args['businessCategoryCode']);
		if(!\dash\app::isset_request('businessSubCategoryCode')) unset($args['businessSubCategoryCode']);
		if(!\dash\app::isset_request('ownershipType')) unset($args['ownershipType']);
		if(!\dash\app::isset_request('rentalContractNumber')) unset($args['rentalContractNumber']);
		if(!\dash\app::isset_request('rentalExpiryDate')) unset($args['rentalExpiryDate']);
		if(!\dash\app::isset_request('Address')) unset($args['Address']);
		if(!\dash\app::isset_request('countryCode')) unset($args['countryCode']);
		if(!\dash\app::isset_request('provinceCode')) unset($args['provinceCode']);
		if(!\dash\app::isset_request('cityCode')) unset($args['cityCode']);
		if(!\dash\app::isset_request('businessType')) unset($args['businessType']);
		if(!\dash\app::isset_request('etrustCertificateType')) unset($args['etrustCertificateType']);
		if(!\dash\app::isset_request('etrustCertificateIssueDate')) unset($args['etrustCertificateIssueDate']);
		if(!\dash\app::isset_request('etrustCertificateExpiryDate')) unset($args['etrustCertificateExpiryDate']);
		if(!\dash\app::isset_request('emailAddress')) unset($args['emailAddress']);
		if(!\dash\app::isset_request('websiteAddress')) unset($args['websiteAddress']);

		if(!empty($args))
		{
			$args['datemodified'] = date("Y-m-d H:i:s");

			$update = \lib\pardakhtyar\db\shop::update($args, $id);

			if(\dash\engine\process::status())
			{
				\dash\log::set('editShop', ['code' => $id,]);
				\dash\notif::ok(T_("Shop successfully updated"));
			}
		}
	}



	public static function get($_id)
	{
		if(!is_numeric($_id))
		{
			\dash\notif::error(T_("Shop id not set"));
			return false;
		}

		$get = \lib\pardakhtyar\db\shop::get(['id' => $_id, 'limit' => 1]);

		if(!$get)
		{
			\dash\notif::error(T_("Invalid Shop id"));
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

		$customer_id = \dash\app::request('customer_id');
		if($customer_id && !is_numeric($customer_id))
		{
			\dash\notif::error(T_("Invalid user id"), 'customer_id');
			return false;
		}

		$farsiName = \dash\app::request('farsiName');
		if($farsiName && mb_strlen($farsiName) > 50)
		{
			\dash\notif::error('farsiName is out of range', 'farsiName');
			return false;
		}

		if(!$farsiName)
		{
			\dash\notif::error('farsiName is required', 'farsiName');
			return false;
		}

		$englishName = \dash\app::request('englishName');
		if($englishName && mb_strlen($englishName) > 50)
		{
			\dash\notif::error('englishName is out of range', 'englishName');
			return false;
		}

		if(!$englishName)
		{
			\dash\notif::error('englishName is required', 'englishName');
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

		$postalCode = \dash\app::request('postalCode');
		if($postalCode && mb_strlen($postalCode) !== 10)
		{
			\dash\notif::error("postalCode is out of range! exacliy 10", 'postalCode');
			return false;
		}

		if(!$postalCode)
		{
			\dash\notif::error("postalCode is required", 'postalCode');
			return false;
		}


		$businessCertificateNumber = \dash\app::request('businessCertificateNumber');
		if($businessCertificateNumber && mb_strlen($businessCertificateNumber) > 50)
		{
			\dash\notif::error('businessCertificateNumber is out of range', 'businessCertificateNumber');
			return false;
		}

		$certificateIssueDate = \dash\app::request('certificateIssueDate');

		if($certificateIssueDate && !self::checkDateDb($certificateIssueDate))
		{
			\dash\notif::error("certificateIssueDate must be a timestamp", 'certificateIssueDate');
			return false;
		}

		if($certificateIssueDate)
		{
			$certificateIssueDate = self::checkDateDb($certificateIssueDate);
		}

		$certificateExpiryDate = \dash\app::request('certificateExpiryDate');

		if($certificateExpiryDate && !self::checkDateDb($certificateExpiryDate))
		{
			\dash\notif::error("certificateExpiryDate must be a timestamp", 'certificateExpiryDate');
			return false;
		}

		if($certificateExpiryDate)
		{
			$certificateExpiryDate = self::checkDateDb($certificateExpiryDate);
		}


		$Description = \dash\app::request('Description');
		if($Description && mb_strlen($Description) > 255)
		{
			\dash\notif::error("Description is out of range", 'Description');
			return false;
		}


		$businessCategoryCode = \dash\app::request('businessCategoryCode');
		if($businessCategoryCode && mb_strlen($businessCategoryCode) !== 4)
		{
			\dash\notif::error("businessCategoryCode is out of range! exacliy 4", 'businessCategoryCode');
			return false;
		}

		if(!$businessCategoryCode)
		{
			\dash\notif::error('businessCategoryCode is required', 'businessCategoryCode');
			return false;
		}


		$businessSubCategoryCode = \dash\app::request('businessSubCategoryCode');
		if($businessSubCategoryCode && mb_strlen($businessSubCategoryCode) > 4)
		{
			\dash\notif::error('businessSubCategoryCode is out of range! maximum 4', 'businessSubCategoryCode');
			return false;
		}

		if(!$businessSubCategoryCode && $businessSubCategoryCode != '0')
		{
			\dash\notif::error('businessSubCategoryCode is required', 'businessSubCategoryCode');
			return false;
		}

		$isEstijari = false;

		$ownershipType = \dash\app::request('ownershipType');
		if(isset($ownershipType) && is_numeric($ownershipType) && in_array(intval($ownershipType), [0,1]))
		{
			$ownershipType = intval($ownershipType);
			if($ownershipType === 1)
			{
				$isEstijari = true;
			}
		}
		else
		{

			if($ownershipType && !in_array($ownershipType, ['owner', 'tenant']))
			{
				\dash\notif::error("ownershipType must be a number", 'ownershipType');
				return false;
			}

			if($ownershipType)
			{
				if($ownershipType === 'tenant')
				{
					$isEstijari = true;
				}
				$ownershipType = \lib\pardakhtyar\type::index_ownershipType($ownershipType);
			}
		}

		$rentalContractNumber = \dash\app::request('rentalContractNumber');
		if($rentalContractNumber && mb_strlen($rentalContractNumber) > 50)
		{
			\dash\notif::error('rentalContractNumber is out of range! maximum 4', 'rentalContractNumber');
			return false;
		}

		if($isEstijari && !$rentalContractNumber)
		{
			\dash\notif::error('rentalContractNumber is required', 'rentalContractNumber');
			return false;
		}

		$rentalExpiryDate = \dash\app::request('rentalExpiryDate');

		if($rentalExpiryDate && !self::checkDateDb($rentalExpiryDate))
		{
			\dash\notif::error("rentalExpiryDate must be a timestamp", 'rentalExpiryDate');
			return false;
		}

		if($rentalExpiryDate)
		{
			$rentalExpiryDate = self::checkDateDb($rentalExpiryDate);
		}

		if($isEstijari && !$rentalExpiryDate)
		{
			\dash\notif::error('rentalExpiryDate is required', 'rentalExpiryDate');
			return false;
		}



		$Address = \dash\app::request('Address');
		if($Address && mb_strlen($Address) > 255)
		{
			\dash\notif::error('Address is out of range! maximum 255', 'Address');
			return false;
		}


		$countryCode = \dash\app::request('countryCode');
		if($countryCode && mb_strlen($countryCode) !== 2)
		{
			\dash\notif::error("countryCode must exactly 2 character", 'countryCode');
			return false;
		}

		if(!$countryCode)
		{
			$countryCode = 'IR';
			// \dash\notif::error('countryCode is required', 'countryCode');
			// return false;
		}

		$provinceCode = \dash\app::request('provinceCode');
		if($provinceCode && mb_strlen($provinceCode) !== 2)
		{
			\dash\notif::error("provinceCode must exactly 2 character", 'provinceCode');
			return false;
		}

		$cityCode = \dash\app::request('cityCode');
		if($cityCode && mb_strlen($cityCode) !== 6)
		{
			\dash\notif::error("cityCode must exactly 6 character", 'cityCode');
			return false;
		}

		$isVirtualShop = false;

		$businessType = \dash\app::request('businessType');

		if(isset($businessType) && is_numeric($businessType) && in_array(intval($businessType), [0,1,2]))
		{
			$businessType = intval($businessType);
			if($businessType === 1 || $businessType === 2)
			{
				$isVirtualShop = true;
			}
		}
		else
		{

			if($businessType && !in_array($businessType, ['physical','physical-virtual','virtual']))
			{
				\dash\notif::error("businessType must be a number", 'businessType');
				return false;
			}


			if($businessType)
			{
				if(in_array($businessType, ['physical-virtual', 'virtual']))
				{
					$isVirtualShop = true;
				}

				$businessType = \lib\pardakhtyar\type::index_businessType($businessType);
			}
		}

		if(!$businessType && $businessType !== 0)
		{
			\dash\notif::error('businessType is required', 'businessType');
			return false;
		}

		$etrustCertificateType = \dash\app::request('etrustCertificateType');
		if(isset($etrustCertificateType) && is_numeric($etrustCertificateType) && in_array(intval($etrustCertificateType), [0,1]))
		{
			$etrustCertificateType = intval($etrustCertificateType);
		}
		else
		{

			if($etrustCertificateType && !in_array($etrustCertificateType, ['onestar','twostar']))
			{
				\dash\notif::error("etrustCertificateType must be a number", 'etrustCertificateType');
				return false;
			}

			if($etrustCertificateType)
			{
				$etrustCertificateType = \lib\pardakhtyar\type::index_etrustCertificateType($etrustCertificateType);
			}
		}



		$etrustCertificateIssueDate = \dash\app::request('etrustCertificateIssueDate');

		if($etrustCertificateIssueDate && !self::checkDateDb($etrustCertificateIssueDate))
		{
			\dash\notif::error("etrustCertificateIssueDate must be a timestamp", 'etrustCertificateIssueDate');
			return false;
		}

		if($etrustCertificateIssueDate)
		{
			$etrustCertificateIssueDate = self::checkDateDb($etrustCertificateIssueDate);
		}

		$etrustCertificateExpiryDate = \dash\app::request('etrustCertificateExpiryDate');

		if($etrustCertificateExpiryDate && !self::checkDateDb($etrustCertificateExpiryDate))
		{
			\dash\notif::error("etrustCertificateExpiryDate must be a timestamp", 'etrustCertificateExpiryDate');
			return false;
		}

		if($etrustCertificateExpiryDate)
		{
			$etrustCertificateExpiryDate = self::checkDateDb($etrustCertificateExpiryDate);
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

		if($isVirtualShop && !$emailAddress)
		{
			\dash\notif::error('emailAddress is required', 'emailAddress');
			return false;
		}


		$websiteAddress = \dash\app::request('websiteAddress');
		if($websiteAddress && mb_strlen($websiteAddress) > 100)
		{
			\dash\notif::error("websiteAddress is out of range! maximum 100", 'websiteAddress');
			return false;
		}

		if($websiteAddress && mb_strlen($websiteAddress) < 3)
		{
			\dash\notif::error("websiteAddress is out of range! minimum 3", 'websiteAddress');
			return false;
		}

		if($isVirtualShop && !$websiteAddress)
		{
			\dash\notif::error('websiteAddress is required', 'websiteAddress');
			return false;
		}


		$check_duplicate_args =
		[
			'customer_id'             => $customer_id,
			'postalCode'              => $postalCode,
			'businessCategoryCode'    => $businessCategoryCode,
			'businessSubCategoryCode' => $businessSubCategoryCode,
		];

		$check_duplicate = \lib\pardakhtyar\db\shop::check_duplicate($check_duplicate_args, $_id);
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


		$args                                = [];
		$args['customer_id']                 = $customer_id;
		$args['user_id']                     = $user_id;
		$args['farsiName']                   = $farsiName;
		$args['englishName']                 = $englishName;
		$args['telephoneNumber']             = $telephoneNumber;
		$args['postalCode']                  = $postalCode;
		$args['businessCertificateNumber']   = $businessCertificateNumber;
		$args['certificateIssueDate']        = $certificateIssueDate;
		$args['certificateExpiryDate']       = $certificateExpiryDate;
		$args['Description']                 = $Description;
		$args['businessCategoryCode']        = $businessCategoryCode;
		$args['businessSubCategoryCode']     = $businessSubCategoryCode;
		$args['ownershipType']               = $ownershipType;
		$args['rentalContractNumber']        = $rentalContractNumber;
		$args['rentalExpiryDate']            = $rentalExpiryDate;
		$args['Address']                     = $Address;
		$args['countryCode']                 = $countryCode;
		$args['provinceCode']                = $provinceCode;
		$args['cityCode']                    = $cityCode;
		$args['businessType']                = $businessType;
		$args['etrustCertificateType']       = $etrustCertificateType;
		$args['etrustCertificateIssueDate']  = $etrustCertificateIssueDate;
		$args['etrustCertificateExpiryDate'] = $etrustCertificateExpiryDate;
		$args['emailAddress']                = $emailAddress;
		$args['websiteAddress']                     = $websiteAddress;

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
				case 'certificateIssueDate':
				case 'certificateExpiryDate':
				case 'rentalExpiryDate':
				case 'etrustCertificateIssueDate':
				case 'etrustCertificateExpiryDate':
					if($value)
					{
						$result[$key] = strtotime($value). '000';
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'farsiName':
				case 'englishName':
				case 'telephoneNumber':
				case 'postalCode':
				case 'businessCertificateNumber':
				case 'businessCategoryCode':
				case 'businessSubCategoryCode':
				case 'ownershipType':
				case 'rentalContractNumber':
				case 'countryCode':
				case 'provinceCode':
				case 'cityCode':
				case 'businessType':
				case 'etrustCertificateType':
				case 'emailAddress':
				case 'websiteAddress':
					$result[$key] = $value;
					break;


				case 'Address':
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


		$result            = \lib\pardakhtyar\db\shop::search($_string, $_args);
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