<?php
$url = \lib\store::url(). '/f/'. \dash\data::formId();
$html = '';

$html .= '<div class="alert-danger text-center font-bold">';
{
	$html .= T_("Your are in admin mode");
	$html .= '<br>';
	$html .= T_("Public address to access this form");
	$html .= ' <a target="_blank" class="block" data-copy="'. $url.'" href="'.$url. '">'. $url. '</a>';

}
$html .= '</div>';

echo $html;
echo \lib\app\form\generator::full_html(\dash\request::get('id'));
?>