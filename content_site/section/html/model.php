<?php
namespace content_site\section\html;


class model extends \content_site\section\model
{
	public static function post()
	{
		if(\dash\request::post('savehtml') === 'html')
		{
			self::save_html();
		}
		elseif(\dash\request::post('savehtmltitle'))
		{
			self::save_html('title');
		}
		else
		{
			parent::post();
		}
	}


	private static function save_html($_mode = 'html')
	{

		$page_id = \dash\request::get('id');
		$page_id = \dash\coding::decode($page_id);

		$title = \dash\validate::title(\dash\request::post('htmltitle'));

		if(!$page_id)
		{
			\dash\notif::error(T_("Invali page id"));
			return false;
		}

		$html = null;
		if($_mode === 'html')
		{
			$html = \dash\request::post_html();
			$html = \dash\validate::real_html_full($html);

			if(!$html)
			{
				\dash\notif::error(T_("HTML is required"));
				return false;
			}

			$html  = stripslashes($html);
		}


		if(\dash\data::mySectionID())
		{
			$section_id = \dash\data::mySectionID();


			// reload section detail to get last update
			// for example in upload file need this line
			\dash\pdo::transaction();

			$load_section_lock = \lib\db\pagebuilder\get::by_id_lock($section_id);

			if(!$load_section_lock)
			{
				\dash\pdo::rollback();

				\dash\notif::error(T_("Section not found"). ' '. __LINE__);

				return false;
			}

			if($_mode === 'html')
			{
				\dash\pdo\query_template::update('pagebuilder', ['text_preview' => $html], $section_id);
			}
			else
			{
				$preview           = json_encode(['type' => 'html', 'key' => 'html', 'heading' => $title]);

				\dash\pdo\query_template::update('pagebuilder', ['preview' => $preview], $section_id);
			}

			\dash\pdo::commit();

			\dash\notif::ok(T_("Saved"));
		}
		else
		{
			if(!$title)
			{
				$title = T_("Raw HTML");
			}

			$preview           = json_encode(['type' => 'html', 'key' => 'html', 'heading' => $title]);

			$args =
			[
				'mode'          => 'body',
				'key'           => 'html',
				'page_id'       => $page_id,
				'preview'       => $preview,
				'update_record' => null,
				'text_preview'  => $html,
			];

			$id = \content_site\section\model::add_new_section_db($args);

			if(!$id)
			{
				return false;
			}

			$url = \dash\url::this(). '/';
			$url .= 'html';
			$url .= \dash\request::full_get(['sid' => $id, 'folder' => null, 'section' => null,]);

			\dash\redirect::to($url);

		}
	}
}
?>