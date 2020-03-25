<?php
namespace lib\db\app_download;

class get
{

	public static function chart_all()
	{
		$query  =
		"
			SELECT
				COUNT(*) AS `count`,
				DATE(app_download.datedownload) AS `datedownload`
			FROM
				app_download
			GROUP BY DATE(app_download.datedownload)
			ORDER BY DATE(app_download.datedownload) ASC
		";

		$result = \dash\db::get($query);
		return $result;
	}

	public static function count_all()
	{
		$query  = "SELECT COUNT(*) AS `count` FROM app_download";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}

	public static function count_from_date($_date)
	{
		$query  = "SELECT COUNT(*) AS `count` FROM app_download WHERE app_download.datedownload > '$_date' ";
		$result = \dash\db::get($query, 'count', true);
		return $result;
	}

}
?>