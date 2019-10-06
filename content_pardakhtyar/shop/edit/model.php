<?php
namespace content_pardakhtyar\shop\edit;


class model
{
	public static function post()
	{

		$post =
		[
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


		\lib\pardakhtyar\app\shop::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>