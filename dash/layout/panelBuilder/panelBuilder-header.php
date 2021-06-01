<div class="h-full flex flex-wrap content-center">

  <a class="backBtn px-5 w-50 text-2xl text-gray-600 hover:text-gray-400 transition" href="<?php echo \dash\data::back_link(); ?>">
    <i class="inline-block transition-none sf-chevron-left"></i>
    <span class="inline-block transition-none"><?php echo \dash\data::back_text(); ?></span>
  </a>
  <div class="flex-grow mx-5"><?php echo \dash\face::title(); ?></div>

  <button href="<?php echo \dash\data::action_text(); ?>" class="inline-block mx-5 px-10 text-center text-white transition bg-blue-400 rounded-lg shadow hover:shadow-lg hover:bg-blue-500 focus:outline-none cursor-pointer "><?php echo \dash\data::action_text(); ?></button>

</div>