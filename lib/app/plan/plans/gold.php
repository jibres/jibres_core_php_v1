<?php
namespace lib\app\plan\plans;


use lib\app\plan\planPrepare;


class gold extends planPrepare
{

	public function name() : string
	{
		return 'gold';
	}


	public function title() : string
	{
		return T_("Gold");
	}


	public function description() : string
	{
		return T_("Description of gold");
	}


	public function priceIRT() : int
	{
		return 200000; // IRT
	}


	public function smsCost() : int
	{
		return 90;
	}


	public function maxFileUploadSize() : int
	{
		return 5 * 1024 * 1024; // 20 MB
	}


	public function totalStorageSize() : int
	{
		return 5 * 1024 * 1024 * 1024; // 20 GB
	}


	public function staffAccountCount() : int
	{
		return 5;
	}


	public function outstandingFeatures() : array
	{
		return
			[
				T_("Every feature in free plan +"),
				T_("Professional Discount code"),
				T_("Professional reports"),
				T_("Access to Ganje"),
				T_(":val storage", ['val' => \dash\fit::file_size($this->totalStorageSize())]),
			];
	}


	public function featureList()
	{
		return
			[
				T_("Features") =>
					[
						T_("Permission")             => T_("Simple"),
						T_("Staff")                  => \dash\fit::number($this->staffAccountCount()) . ' ' . T_("Staff"),
						T_("Allowed file upload size") => \dash\fit::file_size($this->maxFileUploadSize()),
						T_("Total storage size")     => \dash\fit::file_size($this->totalStorageSize()),
						T_("Free domain")            => T_(".ir Domain"),
						T_("Ganje")                  => true,
						T_("SMS Cost")               => \dash\fit::number($this->smsCost()) . ' ' . $this->currencyName(),
						T_("Remove Jibres brand")    => true,
						T_("Admin on your domain")   => false,
						T_("Advance report")         => true,
						T_("Advance discount code")  => true,

					],

			];
	}


	public function type() : string
	{
		return 'public';
	}


	public function contain() : array
	{
		return
			[
				'discount_professional',
				'ganje_product',
				'report_professional',
				'sms_pack',
			];
	}

}