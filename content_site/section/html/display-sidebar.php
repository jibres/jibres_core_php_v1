<form method="post" autocomplete="off" data-patch>
    <input type="hidden" name="savehtmltitle" value="1">
    <label for="htmltitle"><?php echo T_("Section title") ?></label>
    <div class="input">
        <input type="text" name="htmltitle" id="htmltitle" value="<?php echo \dash\data::myHtmlTitle() ?>">
    </div>
</form>

<div>
  <h3 class="text-blue-800 text-lg mt-10">TailwindCSS</h3>
  <p class="text-gray-500 text-md leading-6"><?php echo T_("TailwindCSS is an absolutely amazing front end CSS library that allows you to create stunning CSS layouts. Using TailwindCSS in your Jibres Theme will help add beauty and simplicity to your design. It will also make your theme scalable and easy to manage. Working with TailwindCSS means using a set of utility classes that lets you work with exactly what you need.") ?></p>
  <a target="_blank" rel="nofollow noopener" href="https://tailwindcss.com/" class="btn mt-5"><?php echo T_("Read more"); ?></a>
</div>

