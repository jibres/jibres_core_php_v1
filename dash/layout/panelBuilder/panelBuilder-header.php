<div class="h-full flex flex-wrap content-center">

  <a class="backBtn pe-5 ps-2 mx-5 rounded-xl w-50 text-2xl text-gray-600 hover:text-gray-900 focus:text-gray-900 transition bg-gray-50 hover:bg-gray-200 focus:bg-gray-200" href="<?php echo \dash\data::back_link(); ?>">
<?php
if(\dash\language::dir() === 'rtl')
{
 echo \dash\utility\icon::svg('ChevronRight', 'minor');
}
else
{
 echo \dash\utility\icon::svg('ChevronLeft', 'minor');
}
?>
    <span class="inline-block transition-none"><?php echo \dash\data::back_text(); ?></span>
  </a>
  <div class="flex-grow mx-5"><?php echo \dash\face::title(); ?></div>

<?php if(\dash\data::action_link() && \dash\data::action_text()) {?>
  <a href="<?php echo \dash\data::action_link(); ?>" class="inline-block mx-5 px-10 text-center text-white transition bg-blue-400 rounded-lg shadow hover:shadow-lg hover:bg-blue-500 hover:text-gray-50 focus:outline-none cursor-pointer "><?php echo \dash\data::action_text(); ?></a>
<?php }?>

</div>