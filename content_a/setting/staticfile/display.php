<?php
$storeData = \dash\data::store_store_data();
?>

  <div class="row">
    <div class="c-xs-12 c-sm-6 c-md-6">
      <form method="post" autocomplete="off">
        <div  class="box">
          <header><h2><?php echo T_("Route static file verification");?></h2></header>
          <div class="body">
            <p>
              <?php echo T_("You can set some file to route in your domain") ?>
            </p>

            <label for="filename"><?php echo T_("The file name"); ?> <span class="fc-red">*</span></label>
            <div class="input ltr">
              <input type="text" name="filename" id="filename" <?php \dash\layout\autofocus::html() ?> required maxlength='70' minlength="1"  >
            </div>


            <label for="filecontent"><?php echo T_("The file name"); ?> <span class="fc-red">*</span></label>
            <div class="input ltr">
              <input type="text" name="filecontent" id="filecontent" <?php \dash\layout\autofocus::html() ?> required maxlength='70' minlength="1"  >
            </div>

          </div>
          <footer class="txtRa">
            <button  class="btn master" ><?php echo T_("Route"); ?></button>
            </footer>
          </div>
        </form>
      </div>

      <div class="c-xs-12 c-sm-6 c-md-6">

        <?php if(\dash\data::fileList()) {?>
          <h4><?php echo T_("Static file"); ?></h4>

            <?php foreach (\dash\data::fileList() as $key => $value) {?>
              <div class="box">
                <div class="body">
                  <div class="f">
                    <div class="cauto">
                      <a class="btn link" href="<?php echo \lib\store::url(). '/'.$key; ?>"><?php echo T_("Show file") ?></a>
                    </div>
                    <div class="c"></div>
                    <div class="cauto">
                      <code><?php echo $key; ?></code>
                    </div>
                  </div>

                  <p class="txtB ltr">
<pre>
<?php echo $value; ?>
</pre>
                  </p>


                </div>
                <footer class="txtRa">
                    <div class="btn linkDel" data-confirm data-data='{"remove": "file", "name": "<?php echo $key; ?>", "content" : "<?php echo $value; ?>"}'><?php echo T_("Remove"); ?></div>
                </footer>
              </div>
            <?php }// endfor ?>
          </div>
        <?php } // endif ?>
      </div>
    </div>
  </div>
