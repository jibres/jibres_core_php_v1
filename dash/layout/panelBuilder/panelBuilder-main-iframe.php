<?php

$page_url = \lib\store::url();
if(\dash\data::siteBuilder_url())
{
  $page_url = \dash\data::siteBuilder_url();
}
var_dump(\dash\data::currentSectionList());
var_dump(\dash\data::currentPageDetail());
return;

  echo '<div class="browserFrame h-full mx-auto shadow-lg overflow-hidden rounded-t-2xl rounded-b-md flex flex-col bg-white transition" data-size="desktop">';
  echo '<div class="toolbar flex-grow-0 flex-none flex content-center mx-2">';
  {
    // dots
    echo '<div class="relative flex flex-none items-center space-s-3 px-3">';
    {
      echo '<div class="w-3 h-3 bg-gray-300 hover:bg-gray-500 transition rounded-full"></div>';
      echo '<div class="w-3 h-3 bg-gray-300 hover:bg-gray-500 transition rounded-full"></div>';
      echo '<div class="w-3 h-3 bg-gray-300 hover:bg-gray-500 transition rounded-full"></div>';
    }
    echo '</div>';
    // address line
    echo '<div class="ltr relative flex flex-grow items-center px-7 bg-gray-100 hover:bg-gray-200 rounded-full my-3 text-xl text-gray-700 transition">';
    {
      echo '<a class="address flex-grow" href='. $page_url. '>';
      echo $page_url;
      echo '</a>';

      echo '<div class="mx-2 relative flex items-center space-x-1 px-3 bg-green-200 text-gray-900 rounded-full text-base">';
      echo '<div class="w-3 h-3 mx-1 bg-green-800 rounded-full animate-ping2 opacity-50"></div>';
      echo '<div>'. T_("Live"). '</div>';
      echo '</div>';
    }
    echo '</div>';
    // zoom icon
    echo '<div class="resizePreview relative flex flex-none items-center space-x-3 px-5">';
    {
      echo '<div data-mode="mobile" class="sf-mobile rounded-full hover:bg-gray-300 text-gray-700 hover:text-gray-900 text-3xl transition cursor-pointer"></div>';
      echo '<div data-mode="desktop" class="sf-monitor rounded-full hover:bg-gray-300 text-gray-700 hover:text-gray-900 text-3xl transition cursor-pointer"></div>';
    }
    echo '</div>';
  }
  echo '</div>';
  echo '<iframe id="liveIframe" class="flex-grow w-full h-full" src="'. $page_url. '"></iframe>';
  echo '</div>';
?>