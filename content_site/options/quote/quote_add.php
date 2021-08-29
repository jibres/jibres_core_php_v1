<?php
namespace content_site\options\quote;


class quote_add
{

	public static function specialsave($_args)
	{
		$currentSectionDetail = \dash\data::currentSectionDetail();

		if(!$currentSectionDetail || !isset($currentSectionDetail['id']))
		{
			\dash\notif::error(T_("Invalid section detail"));
			return false;
		}

		\dash\pdo::transaction();

		$currentSectionDetail = \lib\db\pagebuilder\get::by_id_lock($currentSectionDetail['id']);

		if(!$currentSectionDetail || !is_array($currentSectionDetail) || !isset($currentSectionDetail['preview']))
		{
			\dash\pdo::rollback();

			\dash\notif::error(T_("Section not found"));

			return false;
		}

		$currentSectionDetail['preview'] = json_decode($currentSectionDetail['preview'], true);


		if(isset($currentSectionDetail['preview']['quote_list']) && is_array($currentSectionDetail['preview']['quote_list']))
		{
			// ok
		}
		else
		{
			$currentSectionDetail['preview']['quote_list'] = [];
		}

		// check max count by call maximum_capacity of quote\b1

		$maximum_capacity = 50;

		if(count($currentSectionDetail['preview']['quote_list']) > $maximum_capacity)
		{
			\dash\notif::error(T_("Maximum capacity of this section is full"));
			return false;
		}

		$index = self::generate_random_key();

		$currentSectionDetail['preview']['quote_list'][] =
		[
			'index'  => $index,
			'quote'     => null,
			'alt'       => T_("Image"),
			'isdefault' => true,
		];

		$preview = json_encode($currentSectionDetail['preview']);

		\dash\pdo\query_template::update('pagebuilder', ['preview' => $preview], $currentSectionDetail['id']);

		\dash\pdo::commit();

		\dash\notif::reloadIframe();

		$url = \dash\url::that(). '/quote_list'. \dash\request::full_get(['index' => $index]);

		\dash\redirect::to($url);

		return;
	}


	/**
	 * Generate random key
	 * use in this function and in quote to add default quote
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function generate_random_key()
	{
		return md5(rand(). \dash\user::id(). microtime(). rand(). time());
	}


	public static function admin_html()
	{
		$html = '';
		$html .= '<nav class="items">';
		{
	  		$html .= '<ul>';
	  		{
	    		$html .= '<li>';
	    		{
	    			$quote_add = json_encode(['specialsave' => 'specialsave', 'opt_quote_add' => '1']);

		      		$html .= "<div class='item f' data-ajaxify data-data='$quote_add'>";
		      		{
		        		$html .= '<img src="'. \dash\utility\icon::url('Add', 'major'). '">';
		        		$html .= '<div class="key">'. T_("Add quote"). '</div>';
		        		$html .= '<div class="go"></div>';
		      		}
		      		$html .= '</div>';
	    		}
	    		$html .= '</li>';
	  		}
	  		$html .= '</ul>';
		}
		$html .= '</nav>';

		return $html;
	}

}
?>