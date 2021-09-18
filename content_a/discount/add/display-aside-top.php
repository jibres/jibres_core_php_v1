<?php
$html = '';

$html .= '<h2>'. T_("Summary"). '</h2>';
$html .= '<div>';
{
	$html .= T_("No information entered yet.");
}
$html .= '</div>';

$html .= '<h2>'. T_("PERFORMANCE"). '</h2>';
$html .= '<div>';
{
	$html .= T_("Discount is not active yet.");
}
$html .= '</div>';


echo $html;
?>