<?php
namespace lib\app\form\item;


class check
{
	public static function variable($_args, $_id = null, $_current_detail = [])
	{
		$condition =
		[
			'title'        => 'title',
			'desc'         => 'desc',
			'type'         => ['enum' =>	\lib\app\form\item\type::get_keys()],
			'status'       => ['enum' => ['draft','publish','expire','deleted','lock','awaiting','block','filter','close','full']],
			'require'      => 'bit',
			'maxlen'       => 'smallint',
			'maxlen2'      => 'smallint',
			'sort'         => 'int',
			'placeholder'  => 'string_100',
			'choice'       => 'tag',
			'choiceinline' => 'bit',
			'random'       => 'bit',
			'check_unique' => 'bit',
			'min'          => 'number',
			'max'          => 'number',
		];

		$require = ['title', 'type'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$setting = [];
		if(isset($_current_detail['setting']) && is_array($_current_detail['setting']))
		{
			$setting = $_current_detail['setting'];
		}

		if(\dash\get::index($_current_detail, 'type_detail', 'placeholder'))
		{
			$setting[$data['type']]['placeholder'] = $data['placeholder'];
		}

		if(\dash\get::index($_current_detail, 'type_detail', 'maxlen2'))
		{
			$setting[$data['type']]['maxlen2'] = $data['maxlen2'];
		}

		if(\dash\get::index($_current_detail, 'type_detail', 'min'))
		{
			$setting[$data['type']]['min'] = $data['min'];
		}

		if(\dash\get::index($_current_detail, 'type_detail', 'max'))
		{
			$setting[$data['type']]['max'] = $data['max'];
		}


		if(\dash\get::index($_current_detail, 'type_detail', 'choiceinline'))
		{
			$setting[$data['type']]['choiceinline'] = $data['choiceinline'];
		}

		if(\dash\get::index($_current_detail, 'type_detail', 'random'))
		{
			$setting[$data['type']]['random'] = $data['random'];
		}

		if(\dash\get::index($_current_detail, 'type_detail', 'check_unique'))
		{
			$setting[$data['type']]['check_unique'] = $data['check_unique'];
		}


		$choice = null;
		if(\dash\get::index($_current_detail, 'type_detail', 'choice'))
		{
			$choice = [];
		}

		$data['setting'] = json_encode($setting, JSON_UNESCAPED_UNICODE);
		if(is_array($choice))
		{
			$data['choice'] = json_encode($choice, JSON_UNESCAPED_UNICODE);
		}


		unset($data['placeholder']);
		unset($data['choice']);
		unset($data['choiceinline']);
		unset($data['random']);
		unset($data['check_unique']);
		unset($data['min']);
		unset($data['max']);

		return $data;
	}
}
?>