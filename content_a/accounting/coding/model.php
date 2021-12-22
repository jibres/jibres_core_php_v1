<?php
namespace content_a\accounting\coding;


class model
{
	public static function post()
	{
		if(\dash\request::post('first') === 'init')
		{
			$dataTable = \lib\app\tax\coding\search::list(null, []);

			if($dataTable)
			{
				\dash\notif::error(T_("Your have some coding and can not import coding again"));
				return false;
			}

			$file_addr = __DIR__.'/accounting-coding-import.csv';
			$data = \dash\utility\import::csv($file_addr);

			$insert = [];
			foreach ($data as $key => $value)
			{
				$temp =
				[
					'id'            => a($value, '﻿id'),
					'code'          => a($value, 'code'),
					'title'         => a($value, 'title'),
					'parent1'       => a($value, 'parent1'),
					'parent2'       => a($value, 'parent2'),
					'parent3'       => a($value, 'parent3'),
					'status'        => a($value, 'status'),
					'naturegroup'   => a($value, 'naturegroup'),
					'balancetype'   => a($value, 'balancetype'),
					'detailable'    => a($value, 'detailable') ? 1 : null,
					'type'          => a($value, 'type'),
					'naturecontrol' => a($value, 'naturecontrol') ? 1 : null,
					'exchangeable'  => a($value, 'exchangeable') ? 1 : null,
					'followup'      => a($value, 'followup') ? 1 : null,
					'currency'      => a($value, 'currency') ? 1 : null,
				];

				\dash\pdo\query_template::insert('tax_coding', $temp);

			}

			\dash\notif::ok(T_("Accounting coding imported"));
			\dash\redirect::pwd();
		}
	}
}
?>