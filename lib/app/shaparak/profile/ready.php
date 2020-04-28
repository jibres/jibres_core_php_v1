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

}
?>