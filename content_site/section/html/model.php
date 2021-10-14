<?php
namespace content_site\section\html;


class model extends \content_site\section\model
{
	public static function post()
	{
		\content_site\model::check_homepage_permission();

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

			$load_section_lock = \lib\db\sitebuilder\get::by_id_lock($section_id);

			if(!$load_section_lock)
			{
				\dash\pdo::rollback();

				\dash\notif::error(T_("Section not found"). ' '. __LINE__);

				return false;
			}

			if($_mode === 'html')
			{
				\lib\db\sitebuilder\update::record(['text_preview' => $html], $section_id);
			}
			else
			{
				$preview           = json_encode(['type' => 'html', 'key' => 'html', 'heading' => $title]);

				\lib\db\sitebuilder\update::record(['preview' => $preview], $section_id);
			}

			\dash\pdo::commit();

			\dash\notif::ok(T_("Saved"));

			\dash\redirect::pwd();
		}
		else
		{
			if(!$title)
			{
				$title = T_("Custom HTML Code");
			}

			if(!$html)
			{
				$html = \dash\validate::real_html_full(\dash\file::read(__DIR__. '/sample.html'));
				$html  = stripslashes($html);

			}

			$preview           = json_encode(['heading' => $title]);

			$args =
			[
				'folder'        => 'body',
				'section'       => 'html',
				'model'         => 'html1',
				'preview_key'   => null,
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