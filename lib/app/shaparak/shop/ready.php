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

		if(array_key_exists('businessSubCategoryCode', $result) && !$result['businessSubCategoryCode'])
		{
			if(true)
			{
				$result['businessSubCategoryCode'] = '0';
			}
		}

		if(array_key_exists('businessCategoryCode', $result) && !$result['businessCategoryCode'])
		{
			if(true)
			{
				$result['businessCategoryCode'] = '4816';
			}
		}


		if(array_key_exists('telephoneNumber', $result))
		{
			if(true)
			{
				$result['telephoneNumber'] = '025-36505460';
			}
		}

		if(array_key_exists('farsiName', $result) && !$result['farsiName'])
		{
			if(isset($_data['title']) && $_data['title'])
			{
				$result['farsiName'] = $_data['title'];
			}
		}

		if(array_key_exists('englishName', $result) && !$result['englishName'])
		{
			if(isset($_data['title']) && $_data['title'])
			{
				$result['englishName'] = "Reza market";
			}
		}

		if(array_key_exists('postalCode', $result) && !$result['postalCode'])
		{
			if(isset($_data['title']) && $_data['title'])
			{
				$result['postalCode'] = '3714816445';
			}
		}


		if(array_key_exists('businessType', $result) && !$result['businessType'])
		{
			if(true)
			{
				$result['businessType'] = 2; // 0 = physical shop. 1= physical & virtual shop, 2 = virtual shop
			}
		}

		if(array_key_exists('ownershipType', $result) && !$result['ownershipType'])
		{
			if(true)
			{
				$result['ownershipType'] = 0; // 0 = malek. 1 = mostajer
			}
		}


		if(array_key_exists('countryCode', $result) && !$result['countryCode'])
		{
			$result['countryCode'] = "IR";
		}

		return $result;
	}
}
?>