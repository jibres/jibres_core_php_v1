<?php
namespace lib\app\plan\feature;

class smsCost implements feature
{

	public function name() : string
	{
		return 'sms_cost';
	}


	public function title() : string
	{
		return T_("SMS Cost");
	}




}
