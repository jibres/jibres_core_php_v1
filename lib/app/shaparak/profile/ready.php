<?php
namespace lib\app\shaparak\profile;


class ready
{
	public static function row($_data)
	{
		$result = [];

		if(!is_array($_data))
		{
			$_data = [];
		}

		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'nationalpic':
				case 'shpic':
					$result[$key] = \lib\filepath::fix($value);
					break;

				case 'user_id':
					$result['user_id_raw'] = $value;
					$result[$key] = \dash\coding::encode($value);
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}



	// remove useless field to send to shaparak
	public static function for_shaparak($_data)
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

				case 'merchantType':
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



		if(array_key_exists('merchantType', $result) && !$result['merchantType'])
		{
			if(isset($_data['company']) && $_data['company'])
			{
				$result['merchantType'] = 1; // legal person
			}
			else
			{
				$result['merchantType'] = 0; // real person
			}
		}


		if(array_key_exists('residencyType', $result) && !$result['residencyType'])
		{
			if(true)
			{
				$result['residencyType'] = 0; // iranian person
			}
			else
			{
				$result['residencyType'] = 1; // non-iranian person
			}
		}

		if(array_key_exists('firstNameEn', $result) && !$result['firstNameEn'])
		{
			if(isset($_data['pre_firstname_en']) && $_data['pre_firstname_en'])
			{
				$result['firstNameEn'] = $_data['pre_firstname_en'];
			}
		}

		if(array_key_exists('lastNameEn', $result) && !$result['lastNameEn'])
		{
			if(isset($_data['pre_lastname_en']) && $_data['pre_lastname_en'])
			{
				$result['lastNameEn'] = $_data['pre_lastname_en'];
			}
		}

		if(array_key_exists('fatherNameEn', $result) && !$result['fatherNameEn'])
		{
			if(isset($_data['pre_father_en']) && $_data['pre_father_en'])
			{
				$result['fatherNameEn'] = $_data['pre_father_en'];
			}
		}


		if(array_key_exists('birthDate', $result) && !$result['birthDate'])
		{
			if(isset($_data['pre_birthdate']) && $_data['pre_birthdate'])
			{
				$result['birthDate'] = $_data['pre_birthdate'];
			}
		}


		if(array_key_exists('nationalCode', $result) && !$result['nationalCode'])
		{
			if(isset($_data['pre_nationalcode']) && $_data['pre_nationalcode'])
			{
				$result['nationalCode'] = $_data['pre_nationalcode'];
			}
		}


		if(array_key_exists('telephoneNumber', $result) && !$result['telephoneNumber'])
		{
			if(isset($_data['pre_phone']) && $_data['pre_phone'])
			{
				$result['telephoneNumber'] = $_data['pre_phone'];

				// @TODO @Reza must convert phone to this format
				$result['telephoneNumber'] = '025-36505460';
			}
		}

		if(array_key_exists('cellPhoneNumber', $result) && !$result['cellPhoneNumber'])
		{
			if(isset($_data['user_id']) && $_data['user_id'])
			{
				$laod_user = \dash\db\users::get_by_id($_data['user_id']);
				if(isset($laod_user['mobile']))
				{
					$result['cellPhoneNumber'] = $laod_user['mobile'];
				}
			}
		}

		return $result;
	}

}
?>