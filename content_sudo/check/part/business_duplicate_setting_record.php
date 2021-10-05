<?php
namespace content_sudo\check\part;


class business_duplicate_setting_record
{
	public static function business_duplicate_setting_record()
	{
		$fn = ['\\content_sudo\\check\\part\\business_duplicate_setting_record', 'find'];

		\content_sudo\check\part\business::call_fn_in_all_store($fn);

	}


	public static function find()
	{
		$query =
		"
			SELECT
				COUNT(*) as `mycount`,
				CONCAT(setting.cat, '.', setting.key) as `cat_key`
			FROM
				setting
			WHERE
				setting.cat != 'homepage' AND
				CONCAT(setting.cat, '.', setting.key) != 'store_setting.domain'
			GROUP BY
				cat_key
			HAVING
				mycount > 1
		";
		$duplicate = \dash\db::get($query);
		if($duplicate)
		{
			\content_sudo\check\part\business::who();
			var_dump($duplicate);
		}
	}


}
?>