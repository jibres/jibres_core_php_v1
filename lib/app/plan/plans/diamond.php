<?php
namespace lib\app\plan\plans;


use lib\app\plan\planPrepare;

class diamond extends planPrepare
{

	public function name() : string
	{
		return 'diamond';
	}


	public function title() : string
	{
		return T_("Diamond");
	}


	public function description() : string
	{
		return T_("Diamond description");
	}


	public function priceIRT() : int
	{
		return 900000; // IRT
	}


	public function smsCost() : int
	{
		return 60;
	}


	public function outstandingFeatures() : array
	{
		return
			[
				T_("Every feature in free and gold plan +"),
				T_("Access admin from your domain"),
				T_("20GB storage"),
			];
	}



	public function featureList()
	{
		return
			[
				T_("Features") =>
					[
						T_("Permission")             => T_("Professional"),
						T_("Persenel count")         => T_("20 user"),
						T_("Allow upload file site") => \dash\fit::number(20) . ' ' . T_('MB'),
						T_("Total storage size")     => \dash\fit::number(20) . ' ' . T_('GB'),
						T_("Free domain")            => T_(".com Domain"),
						T_("Ganje")                  => true,
						T_("SMS Cost")               => \dash\fit::number($this->smsCost()) . ' ' . $this->currencyName(),
						T_("Remove Jibres brank")    => true,
						T_("Admin on your domain")   => true,
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
				'admin_domain',
				'discount_professional',
				'remove_brand',
				'ganje_product',
				'report_professional',
				'sms_pack',
			];
	}

}