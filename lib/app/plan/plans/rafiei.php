<?php
namespace lib\app\plan\plans;


use lib\app\plan\planPrepare;


class rafiei extends planPrepare
{

	public function name() : string
	{
		return 'rafiei';
	}


	public function title() : string
	{
		return T_("Rafiei");
	}


	public function description() : string
	{
		return '';
	}


	public function featureList()
	{
		return [];
	}


	public function priceIRT() : int
	{
		return 2000000; // IRT
	}


	public function smsCost() : int
	{
		return 60;
	}


	public function maxFileUploadSize() : int
	{
		return 20 * 1024 * 1024; // 20 MB
	}


	public function totalStorageSize() : int
	{
		return 20 * 1024 * 1024 * 1024; // 20 GB
	}


	public function outstandingFeatures() : array
	{
		return
			[
				T_("Everything you need ❤"),
				T_("Enterprice plan"),
			];
	}


	public function type() : string
	{
		return 'enterprise';
	}


	public static function enterprise() : string
	{
		return 'rafiei';
	}


	public function contain() : array
	{
		return
			[
				'admin_domain',
				'discount_professional',
				'remove_brand',
				'ganje_product',
				'report_professional',
				'sms_pack',
			];
	}

}