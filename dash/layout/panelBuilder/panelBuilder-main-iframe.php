<?php

$page_url = \dash\data::btnPreviewSiteBuilder();
$page_url_view = strtok($page_url, '?');

$section_list = [];

if(\dash\data::currentSectionList() && is_array(\dash\data::currentSectionList()))
{
  $section_list = \dash\data::currentSectionList();
}

$previewHTML = '';
foreach ($section_list as $key => $value)
{
  $previewHTML .= a($value, 'preview_layout');
}


$html = '';

$html .= '<div class="browserFrame h-full mx-auto shadow-lg overflow-hidden rounded-t-2xl rounded-b-md flex flex-col bg-white transition" data-size="desktop">';
$html .= '<div class="toolbar flex-grow-0 flex-none flex content-center mx-2">';
{
  // dots
  $html .= '<div class="relative flex flex-none items-center space-s-3 px-3">';
  {
    $html .= '<div class="w-3 h-3 bg-gray-300 hover:bg-gray-500 transition rounded-full"></div>';
    $html .= '<div class="w-3 h-3 bg-gray-300 hover:bg-gray-500 transition rounded-full"></div>';
    $html .= '<div class="w-3 h-3 bg-gray-300 hover:bg-gray-500 transition rounded-full"></div>';
  }
  $html .= '</div>';
  // address line
  $html .= '<div class="ltr relative flex flex-grow items-center px-7 bg-gray-100 hover:bg-gray-200 rounded-full my-3 text-gray-700 transition">';
  {
    $html .= '<a class="address flex-grow text-xs" href='. $page_url. '>';
    $html .= $page_url_view;
    $html .= '</a>';

    if(!\lib\store::is_connected_to_domain())
    {
      $html .= '<a class="connectDomain text-xs" href="'.\lib\store::admin_url().'/a/setting/domain">'. T_("Connect to your Domain"). '</a>';
    }

    $html .= '<div class="mx-2 relative flex items-center space-x-1 px-3 bg-green-200 text-gray-900 rounded-full text-sm">';
    $html .= '<div class="w-3 h-3 mx-1 bg-green-800 rounded-full animate-ping2 opacity-50"></div>';
    $html .= '<div>'. T_("Live"). '</div>';
    $html .= '</div>';
  }
  $html .= '</div>';
  // zoom icon
  $html .= '<div class="resizePreview relative flex flex-none items-center space-x-3 px-5">';
  {
    $html .= '<div data-mode="mobile" class="sf-mobile rounded-full hover:bg-gray-300 text-gray-700 hover:text-gray-900 transition cursor-pointer"></div>';
    $html .= '<div data-mode="desktop" class="sf-monitor rounded-full hover:bg-gray-300 text-gray-700 hover:text-gray-900 transition cursor-pointer"></div>';
  }
  $html .= '</div>';
}
$html .= '</div>';
$html .= '<div class="browserInside h-full relative overflow-x-hidden overflow-y-auto">';
{
  // $html .= '<iframe id="liveIframe" class="flex-grow w-full h-full" src="'. $page_url. '"></iframe>';
  $html .= $previewHTML;
}
$html .= '</div>';
$html .= '</div>';

echo $html;
?>