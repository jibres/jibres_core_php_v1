<?php
namespace lib\app\plan\plans;


use lib\app\plan\planPrepare;

class free extends planPrepare
{

	public function name() : string
	{
		return 'free';
	}


	public function title() : string
	{
		return T_("Free");
	}


	public function description() : string
	{
		return T_("For ever!");
	}


	public function priceIRT() : int
	{
		return 0; // IRT
	}


	public function smsCost() : int
	{
		return 100;
	}


	public function maxFileUploadSize() : int
	{
		return 1 * 1024 * 1024; // 20 MB
	}


	public function totalStorageSize() : int
	{
		return 1 * 1024 * 1024 * 1024; // 20 GB
	}


	public function staffAccountCount() : int
	{
		return 2;
	}


	public function outstandingFeatures() : array
	{
		return
			[
				T_("Free for ever!"),
				T_("Basic reports"),
				\dash\fit::number($this->staffAccountCount()) . ' ' . T_("Staff account"),
				T_("Online website"),
				T_("Special application"),
				T_("CRM"),
				T_("CMS"),
				T_("Simple Discount code"),
				T_(":val storage", ['val' => \dash\fit::file_size($this->totalStorageSize())]),

			];
	}


	public function featureList()
	{
		return
			[
				T_("Features") =>
					[
						T_("Permission")             => false,
						T_("Staff")                  => \dash\fit::number($this->staffAccountCount()) . ' ' . T_("Staff"),
						T_("Allow upload file site") => \dash\fit::file_size($this->maxFileUploadSize()),
						T_("Total storage size")     => \dash\fit::file_size($this->totalStorageSize()),
						T_("Free domain")            => false,
						T_("Ganje")                  => T_("10 request for test"),
						T_("SMS Cost")               => \dash\fit::number($this->smsCost()) . ' ' . $this->currencyName(),
						T_("Remove Jibres brank")    => false,
						T_("Admin on your domain")   => false,
						T_("Advance report")         => false,
						T_("Advance discount code")  => false,

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
				// nothing!
			];
	}

}