<?php
namespace lib\app\website\footer;

class maintext
{

	public static function set($_args)
	{

		$condition =
		[
			'text'   => 'html',
		];

		$require = [];

		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$maintext = json_encode($data, JSON_UNESCAPED_UNICODE);

		$query_result = \lib\db\setting\update::overwirte_platform_cat_key_lang($maintext, 'website', 'footer', 'maintext', \dash\language::current());

		\lib\app\website\generator::remove_catch();

		\dash\notif::ok(T_("Your website footer text was saved"));

		return true;
	}


	public static function get()
	{
		$maintext = \lib\db\setting\get::lang_platform_cat_key(\dash\language::current(), 'website', 'footer', 'maintext');
		if(isset($maintext['value']) && is_string($maintext['value']))
		{
			$maintext = json_decode($maintext['value'], true);
		}

		if(!is_array($maintext))
		{
			$maintext = [];
		}

		return $maintext;
	}

}
?>
