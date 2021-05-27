 <div id="jHeaderRafiei" class="relative pt-6">
  <a class="logo block mx-auto mb-3 sm:w-8/12 lg:w-5/12 max-w-lg" href="<?php echo \dash\url::kingdom(); ?>">
    <h1 class="hidden"><?php \dash\face::site() ?></h1>
   <img class="block" src="<?php echo \dash\url::cdn(); ?>/enterprise/rafiei/header/rafiei-header-v1.png" alt="<?php echo \dash\face::site(); ?>">
  </a>
 <?php
  $menuOpt =
  [
    'container_class' => 'block mx-auto my-0 pb-14 text-center',
    // 'menu_class' => 'inline-block',
    'item_class' => 'inline-block',
    'link_class' => 'block mx-1 px-2 py-4 transition text-white hover:text-yellow-300 focus:text-yellow-400',
  ];
  echo \lib\pagebuilder::menu('header_menu_1', $menuOpt);
?>

  <svg class='bottom' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 2000 100" xml:space="preserve"><path class="header_curve1" fill="rgba(5,51,83,0.7)" d="M0,0v100C312.4,32.9,649.1,1.4,1000,1.4s687.6,31.4,1000,98.6V0H0z"/><path class="header_curve1" fill="rgba(5,51,83,0.7)" d="M0,0v73.5C312.4,26.9,649.1,1.4,1000,1.4s687.6,25.4,1000,72V0H0z"/><path class="header_curve2" fill="rgba(5,51,83,1)" d="M0,0v47C312.4,17.5,649.1,1.4,1000,1.4s687.6,16.1,1000,45.5V0H0z"/></svg>
</div>
