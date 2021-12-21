<?php
namespace content_sudo\check\part;


class business_duplicate_setting_record
{
	public static function business_duplicate_setting_record()
	{
		\dash\file::delete(self::my_dir());

		$fn = ['\\content_sudo\\check\\part\\business_duplicate_setting_record', 'find'];

		\content_sudo\check\part\business::call_fn_in_all_store($fn);

	}


	public static function my_dir()
	{
		return __DIR__ . '/business_duplicate_setting_record.me.json';
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
		$duplicate = \dash\pdo::get($query);
		if($duplicate)
		{
			$save = [\content_sudo\check\part\business::who(),$duplicate];
			\dash\file::append(self::my_dir(), json_encode($save, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		}
	}


}
?>