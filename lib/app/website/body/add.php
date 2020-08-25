<?php
namespace lib\app\website\body;

class add
{

	public static function line($_key, $_args = [], $_encode = false)
	{
		$_args['line'] = $_key;

		$condition =
		[
			'title'   => 'string_200',
			'sort'    => 'smallint',
			'publish' => 'bit',
			'ratio'   => ['enum' => ['16:9','16:10','19:10','32:9','64:27','5:3', '21:9']],
			'line' => ['enum' => \lib\app\website\body\template::get_keys()],
		];

		$require   = ['line'];

		$meta      = [];

		$data      = \dash\cleanse::input($_args, $condition, $require, $meta);

		$value =
		[
			'title'       => $data['title'] ? $data['title'] : \lib\app\website\body\template::get($_key, 'title'),
			'type'        => $data['line'],
			'ratio'       => $data['ratio'],
			'sort'        => null,
			'publish'     => 1,
			$data['line'] => [],
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

		if($line_id && is_numeric($line_id))
		{
			\lib\app\website\body\edit::set_sort_add_new_line(floatval($line_id));
		}

		\lib\app\website\generator::remove_catch();

		if($_encode)
		{
			return \dash\coding::encode($line_id);
		}
		else
		{
			return $line_id;
		}
	}
}
?>