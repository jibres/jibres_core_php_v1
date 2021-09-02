<?php
namespace content_sudo\fix\sitebuilder;


class view
{
	use news;
	use gallery;
	use header;
	use footer;
	use product;
	use text;
	use quote;

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

		$skipp_subdomain =
		[
			// 'rezamohiti',
			// 'tresssst',
		];

		\dash\code::time_limit(0);

		foreach ($list as $key => $value)
		{
			// if(a($value, 'subdomain') !== 'rezamohiti')
			// {
			// 	continue;
			// }

			if(in_array(a($value, 'subdomain'), $skipp_subdomain))
			{
				self::counter('skipped business');
				return;
			}

			\dash\temp::set("CurrentBusiness", $value);

			\dash\engine\store::force_lock($value);

			self::conver_one_business();

			\dash\db::close();
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


	private static function conver_one_business()
	{
		self::counter('i');



		$query = "	SELECT * FROM pagebuilder where pagebuilder.folder IS NULL ";
		$query = "	SELECT * FROM pagebuilder where 1";

		$old_record_pagebuilder = \dash\db::get($query);

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

			$skipp_section = true;
			switch (a($pagebuilder_record, 'type'))
			{
				// in new sitebuilder we have blog! in old sitebuilder we have news
				case 'blog':
					// var_dump('new sitebuilder section key!', $pagebuilder_record, func_get_args());exit;
					break;

				case 'news':
					// $preview = self::conver_news($pagebuilder_record, $new_record);
					// self::counter('news_converted');
					$skipp_section = false;
					break;

				case 'image':
					$preview = self::conver_gallery($pagebuilder_record, $new_record);
					// self::counter('gallery_converted');
					$skipp_section = false;
					break;


				case 'h0':
				case 'h100':
				case 'h300':
					// $preview = self::conver_header($pagebuilder_record, $new_record);
					break;

				case 'f0':
				case 'f100':
				case 'f201':
				case 'f300':
					// $preview = self::conver_footer($pagebuilder_record, $new_record);
					break;

				case 'products':
					// $preview = self::conver_product($pagebuilder_record, $new_record);
					break;

				case 'text':
					$preview = self::conver_text($pagebuilder_record, $new_record);
					break;

				case 'quote':
					// $preview = self::conver_quote($pagebuilder_record, $new_record);
					break;

				case null:
				case '':
					// maybe new sitebuilder
					break;

				case 'rafiei':
					// enterprise
					break;

				default:
					var_dump($pagebuilder_record);
					var_dump(__LINE__);exit;
					break;
			}

			if($skipp_section)
			{
				// self::counter('skipp section');
				continue;
			}

			$new_record['sort']           = a($pagebuilder_record, 'sort');
			$new_record['sort_preview']   = a($pagebuilder_record, 'sort');
			$new_record['status']         = 'enable';
			$new_record['status_preview'] = 'enable';
			$new_record['preview']        = json_encode($preview);
			$new_record['body']           = $new_record['preview'];



			// \dash\pdo\query_template::update('pagebuilder', $new_record, a($pagebuilder_record, 'id'));


		}
	}




}
?>