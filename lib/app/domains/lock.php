<?php
namespace lib\app\domains;


class lock
{

	public static function lock($_domain)
	{
		if(\dash\validate::ir_domain($_domain, false))
		{
			return \lib\app\nic_domain\lock::lock($_domain);
		}
		else
		{
			return \lib\app\onlinenic\lock::lock($_domain);
		}
	}


	public static function unlock($_domain)
	{
		if(\dash\validate::ir_domain($_domain, false))
		{
			return \lib\app\nic_domain\lock::unlock($_domain);
		}
		else
		{
			return \lib\app\onlinenic\lock::unlock($_domain);
		}
	}

}
?>
