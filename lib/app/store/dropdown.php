<?php
namespace lib\app\store;


class dropdown
{
	/**
	 * This function call everywhere need to get product list in dropdown mode
	 * in sale page or buy page
	 */
	public static function dropdown()
	{
		if(\dash\request::get('json') !== 'true')
		{
			return;
		}

		$notif_result = [];
		$result       = [];
		$meta         = [];
		$msg          = T_("Store not found."). ' ';


		$query = \dash\validate::search(\dash\validate::search_string(), false);


		if($query)
		{
			$resultRaw    = \lib\app\store\search::list_admin($query, $meta);

			foreach ($resultRaw as $key => $value)
			{
				$result['results'][] = self::getNeededField($value);
			}
		}
		else
		{
			$result['results'][] = ['text' => T_("No result found!"), 'id' => null, "disabled"  => true];
		}

		if(!$result)
		{
			$notif_result['message'] = $msg;
		}

		if(!$result)
		{
			$result = [];
			$result['results'][] = ['text' => T_("No result found!"), 'id' => null, "disabled"  => true];
		}

		\dash\code::jsonBoom($result);

	}

	private static function getNeededField($_data)
	{

		$result   = [];
		$id       = null;
		$name     = null;
		$datalist = [];
		$priceTxt = '<span class="description ltr">';

		if(isset($_data['logo']))
		{
			$name .= '<img class="avatar image" src="'.  $_data['logo'] .'"> ';
		}

		if(isset($_data['id']))
		{
			$id = $_data['id'];
			$datalist['id'] = $_data['id'];
			$name .= '<span class="pRa10">'. \dash\store_coding::encode_raw($_data['id']). '</span>';
		}

		if(isset($_data['title']))
		{
			$datalist['title'] = $_data['title'];
			$name .= '<span class="pRa10">'. $_data['title']. '</span>';
		}


		// add price to name of item
		$name   .= $priceTxt. '</span>';
		$result =
		[
			// select22
			'html'     => $name,
			'id'       => $id,
			'datalist' => $datalist,
		];

		return $result;
	}

}

?>