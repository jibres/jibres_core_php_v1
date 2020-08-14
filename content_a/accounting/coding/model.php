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
					'id'            => \dash\get::index($value, '﻿id'),
					'code'          => \dash\get::index($value, 'code'),
					'title'         => \dash\get::index($value, 'title'),
					'parent1'       => \dash\get::index($value, 'parent1'),
					'parent2'       => \dash\get::index($value, 'parent2'),
					'status'        => \dash\get::index($value, 'status'),
					'naturegroup'   => \dash\get::index($value, 'naturegroup'),
					'balancetype'   => \dash\get::index($value, 'balancetype'),
					'detailable'    => \dash\get::index($value, 'detailable') ? 1 : null,
					'type'          => \dash\get::index($value, 'type'),
					'naturecontrol' => \dash\get::index($value, 'naturecontrol'),
					'exchangeable'  => \dash\get::index($value, 'exchangeable'),
					'followup'      => \dash\get::index($value, 'followup'),
					'currency'      => \dash\get::index($value, 'currency'),
				];

				$set = \dash\db\config::make_set($temp, ['type' => 'insert']);

				$insert[] = " INSERT INTO tax_coding SET $set ";
			}

			$sql = implode("; \n", $insert);

			// \dash\file::write(__DIR__. '/coding.sql', $sql);

			\dash\db::query($sql, null, ['multi_query' => true]);

			\dash\notif::ok(T_("Accounting coding imported"));
			\dash\redirect::pwd();
		}
	}
}
?>