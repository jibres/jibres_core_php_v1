<?php
namespace lib\app\website\body;

class add
{

	public static function line($_key)
	{
		$condition =
		[
			'line' => ['enum' => \lib\app\website\body\template::get_keys()],
		];

		$require   = ['line'];

		$meta      = [];

		$data      = \dash\cleanse::input(['line' => $_key], $condition, $require, $meta);

		$value =
		[
			'title'   => \lib\app\website\body\template::get($_key, 'title'),
			'type'    => $data['line'],
			'sort'    => null,
			'publish' => 1,
		];

		$value = json_encode($value, JSON_UNESCAPED_UNICODE);

		$insert =
		[
			'lang'     => \dash\language::current(),
			'platform' => 'website',
			'cat'      => 'homepage',
			'key'      => 'body_line_'. $_key,
			'value'    => $value,
		];

		$line_id = \lib\db\setting\insert::new_record($insert);

		\lib\app\website\generator::remove_catch();

		return $line_id;
	}
}
?>