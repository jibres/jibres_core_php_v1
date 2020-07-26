<?php
namespace lib\db\domains;


class get
{

	public static function count_all()
	{
		$query   = "SELECT COUNT(*) AS `count` FROM domains ";
		$result = \dash\db::get($query, 'count', true, 'nic_log');
		return $result;
	}


	public static function check_exists($_domain)
	{
		$query   = "SELECT * FROM domains WHERE domains.domain = '$_domain' LIMIT 1";
		$result = \dash\db::get($query, null, true, 'nic_log');
		return $result;
	}


	public static function suggestion_char($_first_char, $_max_use_char, $_domainlen)
	{
		$query   =
		"
			SELECT
				*
			FROM
				domains
			WHERE
				domains.registrar IS NULL AND
				domains.domainlen = $_domainlen AND
				domains.tld = 'ir' AND
				(domains.root LIKE '$_first_char%' AND domains.root LIKE '%$_max_use_char%' ) AND
				(SELECT domainactivity.available FROM domainactivity WHERE domainactivity.domain_id = domains.id ORDER BY domainactivity.id DESC LIMIT 1) = 1

			ORDER BY RAND()
			LIMIT 8
		";

		$result = \dash\db::get($query, null, false, 'nic_log');

		return $result;
	}


	public static function suggestion_char4($_first_char, $_end_char, $_max_use_char, $_domainlen)
	{
		$query   =
		"
			SELECT
				*
			FROM
				domains
			WHERE
				domains.registrar IS NULL AND
				domains.domainlen = $_domainlen AND
				domains.tld = 'ir' AND
				(domains.root LIKE '%$_first_char%' AND domains.root LIKE '%$_end_char' AND domains.root LIKE '%$_max_use_char%' ) AND
				(SELECT domainactivity.available FROM domainactivity WHERE domainactivity.domain_id = domains.id ORDER BY domainactivity.id DESC LIMIT 1) = 1

			ORDER BY RAND()
			LIMIT 5
		";

		$result = \dash\db::get($query, null, false, 'nic_log');

		return $result;
	}
}
?>