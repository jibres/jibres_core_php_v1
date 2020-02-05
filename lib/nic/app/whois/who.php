<?php
namespace lib\nic\app\whois;


class who
{
	public static function is($_domain)
	{
		if(!\lib\nic\app\domain\check::syntax($_domain))
		{
			return false;
		}


		$result = \lib\nic\exec\whois::run($_domain);

		j($_domain);

		return true;

	}
}
?>