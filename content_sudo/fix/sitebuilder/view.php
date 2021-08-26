<?php
namespace content_sudo\fix\sitebuilder;


class view
{
	use news;

	public static function config()
	{
		\dash\face::title("Backend Fix ;) ");

		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		self::fix_store();

	}

	private static function error()
	{
		var_dump(func_get_args());
		exit;
	}

	private static $counter = [];
	private static function counter($_key)
	{
		if(isset(self::$counter[$_key]))
		{
			self::$counter[$_key]++;
		}
		else
		{
			self::$counter[$_key] = 1;
		}
	}


	private static function fix_store()
	{
		$start = microtime(true);

		$list = \lib\db\store\get::all_store_fuel_detail();


		\dash\code::time_limit(0);

		foreach ($list as $key => $value)
		{
			self::one_business($value['id'], $value['fuel'], $value['subdomain']);

			\dash\db\mysql\tools\connection::close();
		}

		var_dump(self::$counter);
		var_dump(microtime(true) - $start);
		var_dump('Complete in '. \dash\utility\human::time(microtime(true) - $start));
		exit();
	}


	private static function ready($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{
			if(substr($value, 0, 1) === '{' || substr($value, 0, 1) === '[')
			{
				$result[$key] = json_decode($value, true);
			}
			else
			{
				$result[$key] = $value;
			}
		}

		return $result;
	}


	private static function one_business($store_id, $fuel, $subdomain)
	{
		self::counter('i');

		if(!$store_id || !$fuel || !$subdomain)
		{
			self::error('No input from function :'. __FUNCTION__, __LINE__);
		}

		$skipp_subdomain =
		[
			// 'rezamohiti',
			// 'tresssst',
		];

		if(in_array($subdomain, $skipp_subdomain))
		{
			self::counter('skipped business');
			return;

		}

		$dbname = \dash\engine\store::make_database_name($store_id);

		$query = "	SELECT * FROM pagebuilder where pagebuilder.folder IS NULL ";

		$old_record_pagebuilder = \dash\db::get($query, null, false, $fuel, ['database' => $dbname]);

		if(!$old_record_pagebuilder)
		{
			// var_dump(func_get_args());exit;
			self::counter('business empty pagebuilder records');
			return;
		}

		foreach ($old_record_pagebuilder as $pagebuilder_record)
		{
			$new_record                   = [];

			$preview = [];

			$pagebuilder_record = self::ready($pagebuilder_record);

			self::counter('i');

			self::counter(a($pagebuilder_record, 'type'));

			$skipp_section = false;
			switch (a($pagebuilder_record, 'type'))
			{
				// in new sitebuilder we have blog! in old sitebuilder we have news
				case 'blog':
					var_dump('new sitebuilder section key!', $pagebuilder_record, func_get_args());exit;
					break;

				case 'news':
					$preview = self::conver_news($pagebuilder_record, $new_record);
					break;

				default:
					$skipp_section = true;
					break;
			}

			if($skipp_section)
			{
				self::counter('skipp section');
				continue;
			}

			$new_record['sort']           = a($pagebuilder_record, 'sort');
			$new_record['sort_preview']   = a($pagebuilder_record, 'sort');
			$new_record['status']         = 'enable';
			$new_record['status_preview'] = 'enable';
			$new_record['preview']        = json_encode($preview);
			$new_record['body']           = $new_record['preview'];



			\dash\pdo\query_template::update('pagebuilder', $new_record, a($pagebuilder_record, 'id'), $fuel, $dbname);


			var_dump($new_record);exit;
		}
	}




}
?>