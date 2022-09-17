<?php

namespace lib\app\plan;

class planMessage
{

    public static function needUpgrade()
    {
        return T_("To use from this feature you must upgrade your plan");
    }


	public static function getLink()
	{
		return \dash\url::kingdom(). '/a/plan';
	}


}