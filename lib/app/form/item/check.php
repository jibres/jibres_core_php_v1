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
			'color'        => ['enum' => ['red','green','blue','yellow',]],
			'require'      => 'bit',
			'maxlen'       => 'smallint',
			'maxlen2'      => 'smallint',
			'sort'         => 'int',
			'placeholder'  => 'string_100',
			'choice'       => 'tag_long',
			'choiceinline' => 'bit',
			'random'       => 'bit',
			'check_unique' => 'bit',
			'min'          => 'number',
			'max'          => 'number',
			'filetype'     => 'tag',
			'send_sms'     => 'bit',
			'sms_text'     => 'string_210',
			'defaultvalue' => 'string_200',
			'signup'       => 'bit',
			'link'         => 'string_200',
			'targetblank'  => 'bit',
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

		if(isset($setting[$data['type']]['min']) && isset($setting[$data['type']]['max']))
		{
			$min = floatval($setting[$data['type']]['min']);
			$max = floatval($setting[$data['type']]['max']);
			if($min || $max)
			{
				if($min > $max)
				{
					\dash\notif::error(T_("Minimum is larger than Maximum!"));
					return false;
				}
			}
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

		if(\dash\get::index($_current_detail, 'type_detail', 'color'))
		{
			$setting[$data['type']]['color'] = $data['color'];
		}

		if(\dash\get::index($_current_detail, 'type_detail', 'send_sms'))
		{
			$setting[$data['type']]['send_sms'] = $data['send_sms'];
			$setting[$data['type']]['sms_text'] = $data['sms_text'];
		}

		if(\dash\get::index($_current_detail, 'type_detail', 'link'))
		{
			$setting[$data['type']]['link']        = $data['link'];
			$setting[$data['type']]['targetblank'] = $data['targetblank'];
		}

		if(\dash\get::index($_current_detail, 'type_detail', 'signup'))
		{
			$setting[$data['type']]['signup'] = $data['signup'];
		}

		if(\dash\get::index($_current_detail, 'type_detail', 'defaultvalue'))
		{
			$setting[$data['type']]['defaultvalue'] = $data['defaultvalue'];
		}

		if(\dash\get::index($_current_detail, 'type_detail', 'filetype'))
		{
			$filetype = \dash\upload\extentions::get_all_allow_ext();
			$filetype = array_keys($filetype);

			if($data['filetype'])
			{
				foreach ($data['filetype'] as $ext)
				{
					if(!in_array($ext, $filetype))
					{
						\dash\notif::error(T_("Invalid extentions"));
						return false;
					}
				}
			}

			$setting[$data['type']]['filetype'] = $data['filetype'];
		}



		$choice = null;
		if(\dash\get::index($_current_detail, 'type_detail', 'choice'))
		{
			$choice = [];
			if($data['choice'])
			{
				foreach ($data['choice'] as $key => $value)
				{
					$choice[] =
					[
						'title' => $value,
					];
				}
			}
		}

		$data['setting'] = json_encode($setting, JSON_UNESCAPED_UNICODE);
		if(is_array($choice))
		{
			$data['choice'] = json_encode($choice, JSON_UNESCAPED_UNICODE);
		}

		unset($data['placeholder']);
		unset($data['choice']); // the choice is not modified in tihs form

		unset($data['choiceinline']);
		unset($data['random']);
		unset($data['check_unique']);
		unset($data['min']);
		unset($data['max']);
		unset($data['color']);
		unset($data['filetype']);
		unset($data['send_sms']);
		unset($data['sms_text']);
		unset($data['signup']);
		unset($data['defaultvalue']);
		unset($data['link']);
		unset($data['targetblank']);
		return $data;
	}
}
?>