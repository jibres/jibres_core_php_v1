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


	public function outstandingFeatures() : array
	{
		return
			[
				T_("Free for ever!"),
				T_("Unlimited product"),
				T_("Unlimited order"),
				T_("Online website"),
				T_("Special application"),
				T_("CRM"),
				T_("CMS"),
				T_("Simple Discount code"),
				T_("1GB storage"),

			];
	}


	public function featureList()
	{
		return
			[
				T_("Features") =>
					[
						T_("Permission")             => false,
						T_("Persenel count")         => T_("2 user"),
						T_("Allow upload file site") => \dash\fit::number(1) . ' ' . T_('MB'),
						T_("Total storage size")     => \dash\fit::number(1) . ' ' . T_('GB'),
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