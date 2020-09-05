<?php
namespace lib\app\staticfile;


class remove
{
	public static function remove($_args)
	{

		$condition =
		[
			'filename'    => 'string_50',
			'filecontent' => 'string_500',
		];

		$data = \dash\cleanse::input($_args, $condition, ['filename'], []);


		$cat   = 'staticfile_verify';

		$result = \lib\app\setting\get::load_setting_once($cat);

		if(!is_array($result))
		{
			$result = [];
		}

		$setting = [];

		foreach ($result as $key => $value)
		{
			if(isset($value['key']) && array_key_exists('value', $value))
			{
				if($value['key'] === $data['filename'])
				{
					\lib\db\setting\delete::record($value['id']);
					\dash\notif::ok(T_("File removed"));
					return true;
				}
			}
		}

		\dash\notif::error(T_("File not found"));
		return false;

	}

}
?>