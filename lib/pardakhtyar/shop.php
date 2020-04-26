<?php
namespace lib\pardakhtyar;

class shop
{
	/**
	 * for each person we need below values!
	 * for person1 and person2 and so on...
	 * @return [type] [description]
	 */
	public static function get($_args, $_isUpdate = false)
	{

		if($_args === 'sample')
		{
			$_args =
			[
				'farsiName'       => 'جیبرس',
				'englishName'     => 'Jibres',
				'telephoneNumber' => '025-36505281',
				'postalCode'      => '3719617540',
				'address'         => 'خیابان هفت تیر، کوچه یکم',
				'emailAddress'    => 'info@jibres.com',
				'websiteAddress'  => 'jibres.com',
			];
		}

		$myShop =
		[
			// require
			'farsiName'                   => $_args['farsiName'],
			'englishName'                 => $_args['websiteAddress'],
			'telephoneNumber'             => $_args['telephoneNumber'],
			'postalCode'                  => $_args['postalCode'],

			// optional
			// 'businessCertificateNumber'   => null,
			// 'certificateIssueDate'        => null,
			// 'certificateExpiryDate'       => null,
			// 'description'                 => 'Shop 1',

			// require
			'businessCategoryCode'        => '4816',
			'businessSubCategoryCode'     => '0',

			// optional
			'ownershipType'               => 1,
			// 'rentalContractNumber'        => null,
			// 'rentalExpiryDate'            => null,

			// fill from postal code
			'address'                     => $_args['address'],
			// now only iran is available
			'countryCode'                 => 'IR',
			// 'provinceCode'                => 'THR',
			// 'cityCode'                    => '108012',

			// require
			'businessType'                => 1,

			// fill from enamad
			// 'etrustCertificateType'       => 1,
			// 'etrustCertificateIssueDate'  => time() + ( 60 * 60 * 24 * 1). '000',
			// 'etrustCertificateExpiryDate' => time() + ( 60 * 60 * 24 * 365). '000',

			// require
			'emailAddress'                => $_args['emailAddress'],
			'websiteAddress'              => $_args['websiteAddress'],
			'updateAction'                => 0,

		];

		if($_isUpdate)
		{
			$myShop['updateAction'] = 2;
		}

		return $myShop;
	}

}
?>