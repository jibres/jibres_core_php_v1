<?php
namespace lib\pardakhtyar;

class customer_irani
{
	/**
	 * for each person we need below values!
	 * for person1 and person2 and so on...
	 * @return [type] [description]
	 */
	public static function get($_args, $_emptyIbans = false, $_isUpdate = false)
	{
		$samplePerson =
		[
			// farsi
			'firstNameFa'     => 'جواد',
			'lastNameFa'      => 'عوض زاده',
			'fatherNameFa'    => 'خسروعلی',

			// english
			'firstNameEn'     => 'Javad',
			'lastNameEn'      => 'Adib',
			'fatherNameEn'    => 'KhosroAli',

			// extra
			'gender'          => 1,
			'birthDate'       => strtotime('1990-07-06'),
			'nationalCode'    => '2190053994',
			'telephoneNumber' => '025-36505281',
			'cellPhoneNumber' => '09357269759',
			// iban
			'merchantIbans'   =>
			[
				\lib\pardakhtyar\shaba::get('IR360700001000114904343001'),
				\lib\pardakhtyar\shaba::get('IR480700035000114904343001'),
			],
		];


		if($_args === 'sample')
		{
			$_args = $samplePerson;
		}

		if($_emptyIbans)
		{
			$_args['merchantIbans'] = null;
		}


		$myCustomer =
		[
			// for iranina get from sabteAhval and optional
			// foreign must fill
			'firstNameFa'             => $_args['firstNameFa'],
			'lastNameFa'              => $_args['lastNameFa'],
			'fatherNameFa'            => $_args['fatherNameFa'],

			// for real person must fill
			'firstNameEn'             => $_args['firstNameEn'],
			'lastNameEn'              => $_args['lastNameEn'],

			// for iranina real person is require
			'fatherNameEn'            => $_args['fatherNameEn'],

			// foreign must fill, for iranian is auto
			// female
			// 'gender'               => 0
			// male
			'gender'                  => $_args['gender'],

			// for real person must fill
			'birthDate'               => $_args['birthDate'],

			// for company must fill
			// 'registerDate'            => null,

			// for real iranian must fill
			'nationalCode'            => $_args['nationalCode'],

			// for company must fill
			// 'registerNumber'          => null,
			// 'comNameFa'               => null,
			// 'comNameEn'               => null,

			// real 0
			'merchantType'            => 0,

			// iranian 0
			'residencyType'           => 0,

			// live 0
			'vitalStatus'             => 0,


			// 'birthCrtfctNumber'       => 2190053994,
			// 'birthCrtfctSerial'       => 448121,
			// 'birthCrtfctSeriesLetter' => 0,
			// 'birthCrtfctSeriesNumber' => 39,

			// 'birthCrtfctNumber'       => null,
			// 'birthCrtfctSerial'       => null,
			// 'birthCrtfctSeriesLetter' => null,
			// 'birthCrtfctSeriesNumber' => null,


			// for company must fill
			// 'nationalLegalCode'       => null,
			// 'commercialCode'          => '',

			// foreign must fill, for iranian is auto
			// 'countryCode'             => null,
			// 'foreignPervasiveCode'    => null,
			// 'passportNumber'          => null,
			// 'passportExpireDate'      => null,

			// it's not important and not official!
			// 'description'             => 'Test Person1',

			'telephoneNumber'         => $_args['telephoneNumber'],
			'cellPhoneNumber'         => $_args['cellPhoneNumber'],
			// 'emailAddress'            => null,
			// 'webSite'                 => null,
			// 'fax'                     => null,
			'merchantIbans'           => $_args['merchantIbans'],
			// 'merchantOfficers'        => null,

			'updateAction'            => 0,
		];


		if($_isUpdate)
		{
			$myCustomer[0]['updateAction'] = 2;
		}

		return $myCustomer;
	}
}
?>