<?php
namespace content_sudo\fix;


class sitebuilder
{

	private static function error()
	{
		var_dump(func_get_args());
		exit;
	}

	private static $counter = [];
	private static function counter($_key, $_meta = [])
	{
		if(isset(self::$counter[$_key]))
		{
			self::$counter[$_key]++;
		}
		else
		{
			self::$counter[$_key] = 1;
		}

		if($_meta && \dash\url::isLocal())
		{
			file_put_contents(__DIR__. '/temp.me.log', date("Y-m-d H:i:s"). "\n". json_encode($_meta, JSON_UNESCAPED_UNICODE). "\n", FILE_APPEND);
		}
	}


	public static function fix_store()
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
			if(a($value, 'subdomain') !== 'rezamohiti')
			{
				// continue;
			}

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

		\dash\log::to_supervisor('#Convert sitebuilder complete '. date("Y-m-d H:i:s"). ' In :'. (microtime(true) - $start). 's' );

		var_dump(self::$counter);
		var_dump(microtime(true) - $start);
		var_dump('Complete in '. \dash\utility\human::time(microtime(true) - $start));
		exit();
	}

	public static function who()
	{
		var_dump(\dash\temp::get('CurrentBusiness'));
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

		$query = "	SELECT * FROM posts where posts.type='pagebuilder' ";
		$all_page_builder = \dash\db::get($query);

		$visitcard_pages = [];
		$comingsoon_pages = [];

		foreach ($all_page_builder as $key => $value)
		{
			$temp = self::ready($value);
			if(a($temp, 'meta', 'template') === 'comingsoon')
			{
				self::counter('comingsoon_pages');
				// $comingsoon_pages[] = a($value, 'id');


				// $new_record                   = [];
				// $new_record['folder']         = 'body';
				// $new_record['section']        = 'headline';
				// $new_record['model']          = 'headline1';
				// $new_record['preview_key']    = 'p1';
				// $new_record['status']         = 'enable';
				// $new_record['sort']           = 1;
				// $new_record['sort_preview']   = 1;
				// $new_record['status_preview'] = 'enable';

				// $preview                      = \content_site\call_function::section_model_preview($new_record['section'], $new_record['model'], $new_record['preview_key']);
				// $new_record['preview']        = json_encode($preview['options']);
				// $new_record['body']           = json_encode($preview['options']);

				// $new_record['related']        = 'posts';
				// $new_record['related_id']     = a($value, 'id');
				// $new_record['datecreated']    = date("Y-m-d H:i:s");


				// if(!a($temp, 'meta', 'converted'))
				// {
				// 	\lib\db\sitebuilder\insert::new_record($new_record);
				// 	\dash\pdo\query_template::update('posts', ['meta' => json_encode(array_merge(a($temp, 'meta'), ['converted' => 1]))], a($value, 'id'));
				// }


			}

			if(a($temp, 'meta', 'template') === 'visitcard')
			{
				self::counter('visitcard_pages');
				// $visitcard_pages[] = a($value, 'id');




				// $new_record                   = [];
				// $new_record['folder']         = 'body';
				// $new_record['section']        = 'visitcard';
				// $new_record['model']          = 'visitcard1';
				// $new_record['preview_key']    = 'p1';
				// $new_record['status']         = 'enable';
				// $new_record['sort']           = 1;
				// $new_record['sort_preview']   = 1;
				// $new_record['status_preview'] = 'enable';

				// $preview                      = \content_site\call_function::section_model_preview($new_record['section'], $new_record['model'], $new_record['preview_key']);
				// $new_record['preview']        = json_encode($preview['options']);
				// $new_record['body']           = json_encode($preview['options']);

				// $new_record['related']        = 'posts';
				// $new_record['related_id']     = a($value, 'id');
				// $new_record['datecreated']    = date("Y-m-d H:i:s");


				// if(!a($temp, 'meta', 'converted'))
				// {
				// 	\lib\db\sitebuilder\insert::new_record($new_record);
				// 	\dash\pdo\query_template::update('posts', ['meta' => json_encode(array_merge(a($temp, 'meta'), ['converted' => 1]))], a($value, 'id'));
				// }

			}
		}

		return;


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

				case 'news':
					$preview = self::conver_news($pagebuilder_record, $new_record);
					self::counter($pagebuilder_record['type']. '::converted');
					$skipp_section = false;
					break;

				case 'h0':
				case 'h100':
				case 'h300':
					$preview = self::conver_header($pagebuilder_record, $new_record);
					self::counter($pagebuilder_record['type']. '::converted');
					$skipp_section = false;
					break;

				case 'f0':
				case 'f100':
				case 'f201':
				case 'f300':
					$preview = self::conver_footer($pagebuilder_record, $new_record);
					self::counter($pagebuilder_record['type']. '::converted');
					$skipp_section = false;
					break;


				case 'image':
					$preview = self::conver_gallery($pagebuilder_record, $new_record);
					self::counter($pagebuilder_record['type']. '::converted');
					$skipp_section = false;
					break;




				case 'products':
					$preview = self::conver_product($pagebuilder_record, $new_record);
					self::counter($pagebuilder_record['type']. '::converted');
					$skipp_section = false;
					break;

				case 'text':
					$preview = self::conver_text($pagebuilder_record, $new_record);
					self::counter($pagebuilder_record['type']. '::converted');
					$skipp_section = false;
					break;

				case 'quote':
					$preview = self::conver_quote($pagebuilder_record, $new_record);
					self::counter($pagebuilder_record['type']. '::converted');
					$skipp_section = false;
					break;


				/**
				 * Unknown !!
				 */

				// in new sitebuilder we have blog! in old sitebuilder we have news
				case 'blog':
				case 'b1':
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

			if(!a($new_record, 'status'))
			{
				$new_record['status']         = 'enable';
			}

			if(!a($new_record, 'status_preview'))
			{
				$new_record['status_preview']         = 'enable';
			}

			if(in_array(a($pagebuilder_record, 'related_id'), $comingsoon_pages) || in_array(a($pagebuilder_record, 'related_id'), $visitcard_pages))
			{
				$new_record['status_preview'] = 'hidden';
				$new_record['status']         = 'hidden';
			}

			$new_record['sort']           = a($pagebuilder_record, 'sort');
			$new_record['sort_preview']   = a($pagebuilder_record, 'sort');
			$new_record['preview']        = json_encode($preview);
			$new_record['body']           = $new_record['preview'];



			\lib\db\sitebuilder\update::record($new_record, a($pagebuilder_record, 'id'));

			// save page
			\content_site\page\model::save_page(\dash\coding::encode(a($pagebuilder_record, 'related_id')));


		}
	}




}
?>