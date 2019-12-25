<?php
namespace content_transfer\_store;

class database
{
	public static function run()
	{
		\content_transfer\say::info('Check customer database ...');
		self::check_customer_database();

		\content_transfer\say::info('Create database customer ...');
		self::create_database_customer();
	}


	private static function check_customer_database()
	{
		$query = "SHOW DATABASES;";
		$result = \dash\db::get($query, 'Database', true, 'local', ['database' => 'mysql']);

		$stores = "SELECT CONCAT('jibres_', jibres.store.id) AS `id` FROM jibres.store";
		$stores = \dash\db::get($stores, 'id', null, 'local', ['database' => 'jibres']);

		$diff = array_diff($stores, $result);
		if(count($diff) === count($stores))
		{
			\content_transfer\say::ok('No duplicate database founded');
		}
		else
		{
			\content_transfer\say::end('Duplicate database founded! - Remove exist jibres_* database to run.');
		}
	}


	private static function create_database_customer()
	{
		$query =
		"
			SELECT
				store.*,
				store_data.title,
				users.mobile,
				users.displayname,
				users.gender,
				users.avatar,
				users.birthday,
				users.marital,
				store_data.title AS `title`,
				store_data.plan AS `plan`,
				store_data.startplan AS `startplan`,
				store_data.expireplan AS `expireplan`,
				store.creator AS `creator`
			FROM
				store
			INNER JOIN store_data ON store.id = store_data.id
			INNER JOIN users ON users.id = store.creator
		";
		$stores = \dash\db::get($query, null, false, 'local', ['database' => 'jibres']);

		foreach ($stores as $key => $value)
		{
			$args =
			[
				'fuel'        => 'local',
				'creator'     => $value['creator'],
				'mobile'      => $value['mobile'],
				'displayname' => $value['displayname'],
				'gender'      => $value['gender'],
				'avatar'      => $value['avatar'],
				'birthday'    => $value['birthday'],
				'marital'     => $value['marital'],
				'owner'       => $value['creator'],
				'title'       => $value['title'],
				'subdomain'   => $value['subdomain'],
				'plan'        => $value['plan'],
				'startplan'   => $value['startplan'],
				'expireplan'  => $value['expireplan'],
			];

			\lib\app\store\db::create($value['id'], $args);
			\content_transfer\say::info('Database jibres_'. $value['id']. ' For subdomain '. $value['subdomain']. ' Created');
		}
	}
}
?>