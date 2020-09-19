<?php
namespace content_a\form\edit;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Edit new contact form'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$form_id = \dash\request::get('id');

		// preview
		\dash\face::btnPreview(\lib\store::url(). '/f/'. $form_id);
		\dash\face::btnDuplicate(\dash\url::this(). '/duplicate?id='. $form_id);


		$items = \lib\app\form\item\get::items($form_id);

		if(\dash\request::get('fix'))
		{
			$insert = [];
			foreach ($items as $key => $value)
			{
				if(isset($value['choice']) && $value['choice'] && is_array($value['choice']))
				{
					foreach ($value['choice'] as $once_choice)
					{
						if(isset($once_choice['title']))
						{
							$insert[] =
							[
								'form_id'     => $value['form_id'],
								'item_id'     => $value['id'],
								'title'       => $once_choice['title'],
								// 'datecreated' => date("Y-m-d H:i:s"),
							];
						}

					}
				}
			}

			foreach ($insert as $key => $value)
			{
				$where = \dash\db\config::make_where($value);

				if(!\dash\db::get("SELECT * FROM form_choice WHERE $where LIMIT 1", null, true))
				{
					$value['datecreated'] = date("Y-m-d H:i:s");
					$set = \dash\db\config::make_set($value);
					\dash\db::query("INSERT INTO form_choice SET $set");
				}
			}

		}
		\dash\data::formItems($items);

	}
}
?>
