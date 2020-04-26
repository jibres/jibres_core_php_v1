<?php
namespace content_pardakhtyar\customer\dashboard;


class model
{
	public static function post()
	{
		if(\dash\request::post('xtype') === 'run')
		{
			return self::run_action();
		}


		$type = \dash\request::post('formSubmitType');
		switch ($type)
		{
			case 'customer':
				self::save_customer();
				break;

			case 'terminal':
				self::save_terminal();
				break;

			case 'shop':
				self::save_shop();
				break;

			case 'iban':
				self::save_iban();
				break;

			case 'removeIban':
				self::remove_iban();
				break;

			case 'acceptor':
				self::save_acceptor();
				break;

			default:
				\dash\notif::error(T_("Dont!"));
				return false;
				break;
		}

		if(\dash\engine\process::status())
		{
			// \dash\redirect::pwd();
		}
	}


	private static function run_action()
	{
		$id = \dash\request::post('id');
		if(!$id)
		{
			\dash\notif::error(T_("Id not set"));
			return false;
		}

		$RequestType = \dash\request::post('RequestType');

		switch ($RequestType)
		{
			case 'fetch':
				\lib\pardakhtyar\app\shaparak\request::fetch($id);
				return true;
				break;

			case 13:
			case 5:
			case 6:
			case 7:
			case 18:
			case 17:
			case 14:
				$fn = 'type_'. $RequestType;
				$namespace = "\\lib\\pardakhtyar\\app\\shaparak\\$fn";
				$namespace::run($id);
				return true;
				break;

			default:
				\dash\notif::error(T_("Dont!"));
				return false;
				break;
		}

	}



	private static function save_customer()
	{
		$post =
		[
			'firstNameFa'             => \dash\request::post('firstNameFa'),
			'lastNameFa'              => \dash\request::post('lastNameFa'),
			'fatherNameFa'            => \dash\request::post('fatherNameFa'),
			'firstNameEn'             => \dash\request::post('firstNameEn'),
			'lastNameEn'              => \dash\request::post('lastNameEn'),
			'fatherNameEn'            => \dash\request::post('fatherNameEn'),
			'registerNumber'          => \dash\request::post('registerNumber'),
			'comNameFa'               => \dash\request::post('comNameFa'),
			'comNameEn'               => \dash\request::post('comNameEn'),
			'birthCrtfctNumber'       => \dash\request::post('birthCrtfctNumber'),
			'commercialCode'          => \dash\request::post('commercialCode'),
			'foreignPervasiveCode'    => \dash\request::post('foreignPervasiveCode'),
			'passportNumber'          => \dash\request::post('passportNumber'),
			'Description'             => \dash\request::post('Description'),
			'telephoneNumber'         => \dash\request::post('telephoneNumber'),
			'emailAddress'            => \dash\request::post('emailAddress'),
			'webSite'                 => \dash\request::post('webSite'),
			'fax'                     => \dash\request::post('fax'),
			'gender'                  => \dash\request::post('gender'),
			'merchantType'            => \dash\request::post('merchantType'),
			'residencyType'           => \dash\request::post('residencyType'),
			'vitalStatus'             => \dash\request::post('vitalStatus'),
			'birthCrtfctSeriesLetter' => \dash\request::post('birthCrtfctSeriesLetter'),
			'birthCrtfctSeriesNumber' => \dash\request::post('birthCrtfctSeriesNumber'),
			'birthDate'               => \dash\request::post('birthDate'),
			'registerDate'            => \dash\request::post('registerDate'),
			'passportExpireDate'      => \dash\request::post('passportExpireDate'),
			'nationalCode'            => \dash\request::post('nationalCode'),
			'birthCrtfctSerial'       => \dash\request::post('birthCrtfctSerial'),
			'nationalLegalCode'       => \dash\request::post('nationalLegalCode'),
			'countryCode'             => \dash\request::post('countryCode'),
			'cellPhoneNumber'         => \dash\request::post('cellPhoneNumber'),
		];

		\lib\pardakhtyar\app\customer::edit($post, \dash\request::get('id'));

	}


	private static function save_shop()
	{
		$post =
		[
			'customer_id'				  => \dash\request::get('id'),
			'farsiName'                   => \dash\request::post('farsiName'),
			'englishName'                 => \dash\request::post('englishName'),
			'telephoneNumber'             => \dash\request::post('telephoneNumber'),
			'postalCode'                  => \dash\request::post('postalCode'),
			'businessCertificateNumber'   => \dash\request::post('businessCertificateNumber'),
			'certificateIssueDate'        => \dash\request::post('certificateIssueDate'),
			'certificateExpiryDate'       => \dash\request::post('certificateExpiryDate'),
			'Description'                 => \dash\request::post('Description'),
			'businessCategoryCode'        => \dash\request::post('businessCategoryCode'),
			'businessSubCategoryCode'     => \dash\request::post('businessSubCategoryCode'),
			'ownershipType'               => \dash\request::post('ownershipType'),
			'rentalContractNumber'        => \dash\request::post('rentalContractNumber'),
			'rentalExpiryDate'            => \dash\request::post('rentalExpiryDate'),
			'Address'                     => \dash\request::post('Address'),
			'countryCode'                 => \dash\request::post('countryCode'),
			'provinceCode'                => \dash\request::post('provinceCode'),
			'cityCode'                    => \dash\request::post('cityCode'),
			'businessType'                => \dash\request::post('businessType'),
			'etrustCertificateType'       => \dash\request::post('etrustCertificateType'),
			'etrustCertificateIssueDate'  => \dash\request::post('etrustCertificateIssueDate'),
			'etrustCertificateExpiryDate' => \dash\request::post('etrustCertificateExpiryDate'),
			'emailAddress'                => \dash\request::post('emailAddress'),
			'websiteAddress'              => \dash\request::post('websiteAddress'),
		];

		if(\dash\request::post('shopid'))
		{
			\lib\pardakhtyar\app\shop::edit($post, \dash\request::post('shopid'));
		}
		else
		{
			\lib\pardakhtyar\app\shop::add($post);

		}
	}


	private static function save_terminal()
	{
		$post =
		[
			'customer_id'     => \dash\request::get('id'),

			'sequence'        => \dash\request::post('sequence'),
			'terminalNumber'  => \dash\request::post('terminalNumber'),
			'terminalType'    => \dash\request::post('terminalType'),
			'serialNumber'    => \dash\request::post('serialNumber'),
			'setupDate'       => \dash\request::post('setupDate'),
			'hardwareBrand'   => \dash\request::post('hardwareBrand'),
			'hardwareModel'   => \dash\request::post('hardwareModel'),
			'accessAddress'   => \dash\request::post('accessAddress'),
			'accessPort'      => \dash\request::post('accessPort'),
			'callbackAddress' => \dash\request::post('callbackAddress'),
			'callbackPort'    => \dash\request::post('callbackPort'),
		];

		if(\dash\request::post('terminalid'))
		{
			\lib\pardakhtyar\app\terminal::edit($post, \dash\request::post('terminalid'));
		}
		else
		{
			\lib\pardakhtyar\app\terminal::add($post);

		}
	}



	private static function save_acceptor()
	{
		$post =
		[
			'customer_id'				  => \dash\request::get('id'),
			'allowScatteredSettlement'       => \dash\request::post('allowScatteredSettlement'),
			'iin'                            => \dash\request::post('iin'),
			'acceptorCode'                   => \dash\request::post('acceptorCode'),
			'acceptorType'                   => \dash\request::post('acceptorType'),
			'facilitatorAcceptorCode'        => \dash\request::post('facilitatorAcceptorCode'),
			'cancelable'                     => \dash\request::post('cancelable'),
			'refundable'                     => \dash\request::post('refundable'),
			'blockable'                      => \dash\request::post('blockable'),
			'chargeBackable'                 => \dash\request::post('chargeBackable'),
			'settledSeparately'              => \dash\request::post('settledSeparately'),
			'acceptCreditCardTransaction'    => \dash\request::post('acceptCreditCardTransaction'),
			'allowIranianProductsTrx'        => \dash\request::post('allowIranianProductsTrx'),
			'allowKaraCardTrx'               => \dash\request::post('allowKaraCardTrx'),
			'allowGoodsBasketTrx'            => \dash\request::post('allowGoodsBasketTrx'),
			'allowFoodSecurityTrx'           => \dash\request::post('allowFoodSecurityTrx'),
			'allowJcbCardTrx'                => \dash\request::post('allowJcbCardTrx'),
			'allowUpiCardTrx'                => \dash\request::post('allowUpiCardTrx'),
			'allowVisaCardTrx'               => \dash\request::post('allowVisaCardTrx'),
			'allowMasterCardTrx'             => \dash\request::post('allowMasterCardTrx'),
			'allowAmericanExpressTrx'        => \dash\request::post('allowAmericanExpressTrx'),
			'allowOtherInternationaCardsTrx' => \dash\request::post('allowOtherInternationaCardsTrx'),

		];

		if(\dash\request::post('acceptorid'))
		{
			\lib\pardakhtyar\app\acceptor::edit($post, \dash\request::post('acceptorid'));
		}
		else
		{
			\lib\pardakhtyar\app\acceptor::add($post);

		}
	}

	private static function remove_iban()
	{
		$id = \dash\request::post('ibanidremove');
		return \lib\pardakhtyar\app\merchantIbans::remove($id);
	}


	private static function save_iban()
	{
		$post =
		[
			'customer_id'  => \dash\request::get('id'),
			'merchantIban' => \dash\request::post('merchantIban'),
			'Description'  => \dash\request::post('Description'),
		];

		if(\dash\request::post('ibanid'))
		{
			\lib\pardakhtyar\app\merchantIbans::edit($post, \dash\request::post('ibanid'));
		}
		else
		{
			\lib\pardakhtyar\app\merchantIbans::add($post);

		}


	}
}
?>