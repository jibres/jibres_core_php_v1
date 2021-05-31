<?php
  echo '<div class="browserFrame w-full h-full shadow-lg overflow-hidden rounded-t-2xl rounded-b-md flex flex-col bg-white">';
  echo '<div class="toolbar flex-grow-0 flex-none flex content-center">';
  {
    // dots
    echo '<div class="relative flex items-center space-x-3 px-5">';
    {
      echo '<div class="w-3 h-3 bg-gray-300 hover:bg-gray-500 transition rounded-full"></div>';
      echo '<div class="w-3 h-3 bg-gray-300 hover:bg-gray-500 transition rounded-full"></div>';
      echo '<div class="w-3 h-3 bg-gray-300 hover:bg-gray-500 transition rounded-full"></div>';
    }
    echo '</div>';
    // address line
    echo '<div class="relative flex flex-grow items-center px-7 bg-gray-100 hover:bg-gray-200 rounded-full my-3 text-xl text-gray-700 transition">';
    {
      echo '<a class="flex-grow" href='. \dash\url::pwd(). '>';
      echo \dash\url::pwd();
      echo '</a>';

      echo '<div class="mx-2 relative flex items-center space-x-1 px-3 bg-green-200 text-gray-900 rounded-full text-base">';
      echo '<div class="w-3 h-3 mx-1 bg-green-800 rounded-full animate-ping2 opacity-50"></div>';
      echo '<div>'. T_("Live"). '</div>';
      echo '</div>';
    }
    echo '</div>';
    // zoom icon
    echo '<div class="relative flex items-center space-x-3 px-5">';
    {
      echo '<div class="sf-mobile rounded-full hover:bg-gray-300 text-gray-700 hover:text-gray-900 text-3xl transition cursor-pointer"></div>';
      echo '<div class="sf-monitor rounded-full hover:bg-gray-300 text-gray-700 hover:text-gray-900 text-3xl transition cursor-pointer"></div>';
    }
    echo '</div>';
  }
  echo '</div>';
  // echo '<iframe src="http://rafiei.local/"></iframe>';
  echo '<iframe class="flex-grow w-full h-full" src="http://jibres.local/billboard"></iframe>';
  echo '</div>';
?>