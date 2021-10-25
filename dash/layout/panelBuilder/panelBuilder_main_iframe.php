<?php

$page_url = \dash\data::btnPreviewSiteBuilder();
$page_url_view = strtok($page_url, '?');
$page_url_click = strtok($page_url, '#');

$section_list = [];

if(\dash\data::currentSectionList() && is_array(\dash\data::currentSectionList()))
{
  $section_list = \dash\data::currentSectionList();
}

// $previewHTML = '';
// foreach ($section_list as $key => $value)
// {
//   $previewHTML .= a($value, 'preview_layout');
// }
$data_size = " data-size='desktop'";
$myDisplayMode = \dash\data::pageBuilderIframeSize();

if($myDisplayMode)
{
  $data_size = " data-size='". $myDisplayMode. "'";
}

$html = '';

$html .= "<div class='browserFrame h-full mx-auto shadow-lg overflow-hidden rounded-t-2xl rounded-b-md flex flex-col bg-white transition' $data_size>";
$html .= '<div class="toolbar flex-grow-0 flex-none flex content-center px-2 bg-gray-50">';
{
  // dots
  $html .= '<div class="relative flex flex-none items-center px-2">';
  {
    $html .= '<div class="w-3 h-3 bg-gray-300 hover:bg-gray-500 transition rounded-full mRa5"></div>';
    $html .= '<div class="w-3 h-3 bg-gray-300 hover:bg-gray-500 transition rounded-full mRa5"></div>';
    $html .= '<div class="w-3 h-3 bg-gray-300 hover:bg-gray-500 transition rounded-full mRa5"></div>';
  }
  $html .= '</div>';
  // address line
  $html .= '<div class="ltr relative flex flex-grow items-center px-2 bg-gray-100 hover:bg-gray-200 rounded-full my-1.5 text-gray-700 transition">';
  {
    $html .= '<a target="_blank" class="address flex-grow text-xs mx-2" href="'. $page_url_click. '">';
    $html .= $page_url_view;
    $html .= '</a>';

    if(!\lib\store::is_connected_to_domain())
    {
      $html .= '<a class="connectDomain text-xs" href="'.\lib\store::admin_url().'/a/setting/domain">'. T_("Connect to your Domain"). '</a>';
    }

    $html .= '<div class="mx-2 relative flex items-center space-x-1 px-2 py-1 bg-green-200 text-gray-900 rounded-full text-sm">';
    $html .= '<div class="w-3 h-3 mx-1 bg-green-800 rounded-full animate-ping2 opacity-50"></div>';
    $html .= '<div>'. T_("Live"). '</div>';
    $html .= '</div>';
  }
  $html .= '</div>';
  // zoom icon
  $html .= '<div class="resizePreview relative flex flex-none items-center">';
  {
    $sizeDesktopClass = 'rounded-full transition cursor-pointer p-2';
    $sizeMobileClass = $sizeDesktopClass. ' mx-2';

    if($myDisplayMode === 'desktop')
    {
      $sizeDesktopClass .= ' bg-gray-200 hover:bg-gray-200';
      $sizeMobileClass .= ' bg-gray-100 hover:bg-gray-200';
    }
    else if($myDisplayMode === 'mobile')
    {
      $sizeDesktopClass .= ' bg-gray-100 hover:bg-gray-200';
      $sizeMobileClass .= ' bg-gray-200 hover:bg-gray-200';
    }

    $html .= '<div data-mode="mobile" class="'. $sizeMobileClass. '">';
    {
      $html .= '<img class="w-5" src="'. \dash\utility\icon::url('mobile'). '" alt="Mobile">';
    }
    $html .= '</div>';
    $html .= '<div data-mode="desktop" class="'. $sizeDesktopClass. '">';
    {
      $html .= '<img class="w-5" src="'. \dash\utility\icon::url('desktop'). '" alt="Mobile">';
    }
    $html .= '</div>';
  }
  $html .= '</div>';
}
$html .= '</div>';
$html .= '<div class="browserInside h-full relative overflow-x-hidden overflow-y-auto">';
{
  $html .= '<iframe id="liveIframe" class="flex-grow w-full h-full" src="'. $page_url. '" style="zoom:0.75"></iframe>';
  // $html .= $previewHTML;
}
$html .= '</div>';
$html .= '</div>';

echo $html;
?>