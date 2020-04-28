<?php
namespace lib\app\shaparak\shop;


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
}
?>