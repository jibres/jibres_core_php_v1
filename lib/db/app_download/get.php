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
}
?>