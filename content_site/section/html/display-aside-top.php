<form method="post" autocomplete="off" data-patch>
    <input type="hidden" name="savehtmltitle" value="1">
    <label for="htmltitle"><?php echo T_("Section title") ?></label>
    <div class="input">
        <input type="text" name="htmltitle" id="htmltitle" value="<?php echo \dash\data::myHtmlTitle() ?>">
    </div>
</form>

<div class="my-10">
  <h3 class="text-blue-800 text-lg">TailwindCSS</h3>
  <p class="text-gray-500 text-md leading-6"><?php echo T_("TailwindCSS is an absolutely amazing front end CSS library that allows you to create stunning CSS layouts. Using TailwindCSS in your Jibres Theme will help add beauty and simplicity to your design. It will also make your theme scalable and easy to manage. Working with TailwindCSS means using a set of utility classes that lets you work with exactly what you need.") ?></p>
  <a target="_blank" rel="nofollow noopener" href="https://tailwindcss.com/" class="btn mt-5"><?php echo T_("Read more"); ?></a>
</div>


<div class="jalert alert-error content-center p-5">
  <div class="flex-1">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-10 h-10 mx-2 stroke-current">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
    </svg>
    <label class="font-black"><?php echo T_("Don't use < script > tag") ?></label>
  </div>
</div>
