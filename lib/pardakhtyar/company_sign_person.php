<?php
namespace lib\pardakhtyar;

class company_sign_person
{
	public static function get()
	{
		$myCompanyPerson =
		[
			// foreign must fill
			'firstNameFa'             => 'جواد',
			'lastNameFa'              => 'عوض زاده',
			'fatherNameFa'            => 'علی',

			// require
			'firstNameEn'             => 'Javad',
			'lastNameEn'              => 'Adib',
			'fatherNameEn'            => 'KhosroAli',

			// foreign must fill, for iranian is auto
			// female
			// 'gender'               => 0
			// male
			'gender'                  => 1,

			// for real person must fill
			'birthday'               => '1369/04/15',

			// for company must fill
			'registerDate'            => null,

			// for real iranian must fill
			'nationalCode'            => '2190053994',

			// iranian 0
			'residencyType'           => 0,
			// foreign 1
			// 'residencyType'           => 1,

			// for real iranian is auto
			// live 0
			'vitalStatus'             => 0,
			// dead 1
			// 'vitalStatus'             => 1,

			'birthCrtfctNumber'       => null,
			'birthCrtfctSerial'       => null,
			'birthCrtfctSeriesLetter' => null,
			'birthCrtfctSeriesNumber' => null,

			// for company must fill
			'nationalLegalCode'       => null,
			'commercialCode'          => null,

			// foreign must fill, for iranian is auto
			'countryCode'             => null,
			'foreignPervasiveCode'    => null,
			'passportNumber'          => null,
			'passportExpireDate'      => null,

			// it's not important and not official!
			// 'Description'             => null,
		];

		return $myCompanyPerson;
	}

}
?>