<?php
namespace content_pardakhtyar\customer\add;


class model
{
	public static function post()
	{
		\dash\permission::access('mClassroomAdd');

		$post =
		[
			'firstNameFa'           => \dash\request::post('firstNameFa'),
			'lastNameFa'            => \dash\request::post('lastNameFa'),
			'fatherNameFa'          => \dash\request::post('fatherNameFa'),
			'firstNameEn'           => \dash\request::post('firstNameEn'),
			'lastNameEn'            => \dash\request::post('lastNameEn'),
			'fatherNameEn'          => \dash\request::post('fatherNameEn'),
			'registerNumber'        => \dash\request::post('registerNumber'),
			'comNameFa'             => \dash\request::post('comNameFa'),
			'comNameEn'             => \dash\request::post('comNameEn'),
			'birthCrtfctNumber'      => \dash\request::post('birthCrtfctNumber'),
			'commercialCode'        => \dash\request::post('commercialCode'),
			'foreignPervasiveCode'    => \dash\request::post('foreignPervasiveCode'),
			'passportNumber'        => \dash\request::post('passportNumber'),
			'Description'           => \dash\request::post('Description'),
			'telephoneNumber'       => \dash\request::post('telephoneNumber'),
			'emailAddress'          => \dash\request::post('emailAddress'),
			'webSite'               => \dash\request::post('webSite'),
			'fax'                   => \dash\request::post('fax'),
			'gender'                => \dash\request::post('gender'),
			'merchantType'          => \dash\request::post('merchantType'),
			'residencyType'         => \dash\request::post('residencyType'),
			'vitalStatus'           => \dash\request::post('vitalStatus'),
			'birthCrtfctSeriesLetter' => \dash\request::post('birthCrtfctSeriesLetter'),
			'birthCrtfctSeriesNumber' => \dash\request::post('birthCrtfctSeriesNumber'),
			'birthDate'             => \dash\request::post('birthDate'),
			'registerDate'          => \dash\request::post('registerDate'),
			'passportExpireDate'      => \dash\request::post('passportExpireDate'),
			'nationalCode'          => \dash\request::post('nationalCode'),
			'birthCrtfctSerial'     => \dash\request::post('birthCrtfctSerial'),
			'nationalLegalCode'     => \dash\request::post('nationalLegalCode'),
			'countryCode'           => \dash\request::post('countryCode'),
			'cellPhoneNumber'       => \dash\request::post('cellPhoneNumber'),
		];

		\lib\pardakhtyar\app\customer::add($post);

		if(\dash\engine\process::status())
		{
			\dash\redirect::to(\dash\url::this());
		}

	}
}
?>