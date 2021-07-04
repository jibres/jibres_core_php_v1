<div class="container bg-white mx-auto">
  <div class="grid grid-cols-1 gap-8 p-5">
<?php foreach (\content_site\color\color::color_name() as $color) { ?>
    <div>
      <div class="flex flex-col space-y-3 sm:flex-row sm:space-y-0 sm:space-x-4">
        <div class="min-w-0 flex-1 grid grid-cols-10 gap-x-4 gap-x-2">
<?php foreach (\content_site\color\color::color_opacity() as $opacity) { ?>
          <div class="space-y-1.5">
            <div class="h-12 w-full rounded ring-1 ring-inset ring-black ring-opacity-0 bg-<?php echo $color. '-'. $opacity; ?>"></div>
            <div class="px-0.5 md:flex md:justify-between md:space-x-2 2xl:space-x-0 2xl:block">
              <div class="font-medium text-lg text-gray-900"><?php echo $color.'-'.$opacity; ?></div>
            </div>
          </div>
<?php } ?>
        </div>
      </div>
    </div>
<?php } ?>
  </div>

</div>

