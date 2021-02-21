<?php
namespace dash\validate;
/**
 * Class for validate args
 */
class html
{

	public static function html($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = $_data;
		// php 7.3
		$allow_tag = '';
		$allow_tag .= '<a>';
		$allow_tag .= '<b>';
		$allow_tag .= '<strong>';
		$allow_tag .= '<i>';
		$allow_tag .= '<p>';
		$allow_tag .= '<br>';
		$allow_tag .= '<ul>';
		$allow_tag .= '<ol>';
		$allow_tag .= '<li>';
		$allow_tag .= '<h1>';
		$allow_tag .= '<h2>';
		$allow_tag .= '<h3>';
		$allow_tag .= '<h4>';
		$allow_tag .= '<table>';
		$allow_tag .= '<thead>';
		$allow_tag .= '<tbody>';
		$allow_tag .= '<tr>';
		$allow_tag .= '<td>';
		$allow_tag .= '<th>';
		$allow_tag .= '<figure>';
		$allow_tag .= '<figcaption>';
		$allow_tag .= '<img>';
		$allow_tag .= '<oembed>';
		$allow_tag .= '<blockquote>';

		$data = strip_tags($data, $allow_tag);

		return $data;
	}


	public static function html_basic($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = $_data;

		// Check if there is no invalid character in _data
	    if(preg_match('/\;base64\,/', $_data))
	    {
	    	if($_notif)
			{
				\dash\notif::error(T_("Can not send base64 image in this field"), ['element' => $_element, 'code' => 1605]);
				\dash\cleanse::$status = false;
			}
			return false;
	    }

		// php 7.3
		$allow_tag = '<b><strong><i><p><br><ul><ol><li><h1><h2><h3><h4>';

		$data = strip_tags($data, $allow_tag);

		return $data;
	}

}
?>