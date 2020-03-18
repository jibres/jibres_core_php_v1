<?php
namespace lib\app\pos;


class add
{
	public static function new_pos($_args)
	{
		if(!\lib\store::id())
		{
			return false;
		}

		$allow_pos =
		[
			'saderat', 'mellat', 'tejarat', 'melli', 'sepah', 'keshavarzi',
			'parsian', 'maskan', 'refah', 'novin', 'ansar', 'pasargad',
			'saman', 'sina', 'post', 'ghavamin', 'taavon', 'shahr', 'ayande',
			'sarmayeh', 'day', 'hekmat', 'iranzamin', 'karafarin', 'gardeshgari',
			'madan', 'tsaderat', 'khavarmiyane', 'ivbb', 'irkish', 'asanpardakht',
			'zarinpal', 'payir',
		];

		$condition =
		[
			'pos'          => ['enum' => $allow_pos],
			'title'        => 'title',
			'asanpardakht' => 'bit',
			'ip'           => 'ip',
			'port'         => 'smallint',
			'irankish'     => 'bit',
			'serial'       => 'bigint',
			'terminal'     => 'bigint',
			'receiver'     => 'bigint',
		];

		$require = ['pos'];

		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$old = \lib\app\pos\datalist::list();

		$default = false;
		if(count($old) === 0)
		{
			$default = true;
		}

		$pc_pos = null;
		if($data['pos'] === 'irkish')
		{
			// irankish setting get
			$pc_pos =
			[
				'serial'   => $data['serial'],
				'terminal' => $data['terminal'],
				'receiver' => $data['receiver'],
			];

		}

		if($data['pos'] === 'asanpardakht')
		{
			// asanpardakht setting get
			// @ if change need remove this line
			$port = 447700;

			$pc_pos =
			[
				'ip'     => $data['ip'] ,
				'port'   => $data['port'] ? $data['port'] : $port,
			];

		}

		$new_pos =
		[
			'title'       => $data['title'],
			'slug'        => $data['pos'],
			'pcpos'       => $pc_pos ? 1 : null,
			'setting'     => json_encode($pc_pos, JSON_UNESCAPED_UNICODE),
			'isdefault'   => $default,
			'status'      => 'enable',
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$pos_id = \lib\db\pos\insert::new_record($new_pos);

		if($pos_id)
		{
			\dash\notif::ok(T_("Pos setting saved"));
			return true;
		}
		else
		{
			\dash\log::set('dbCanNotAddPos');
		}

		return false;
	}

}
?>