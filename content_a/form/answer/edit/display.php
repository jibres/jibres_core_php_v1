<?php

$html = '';

$html .= '<div class="alert-info text-center font-bold">';
{
	$html .= T_("You are in edit form answer");
}
$html .= '</div>';


$html .= \lib\app\form\generator::edit_html(\dash\request::get('id'), \dash\request::get('aid'));

echo $html;
?>