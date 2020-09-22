
<div class="avand-md">

  <form method="post" autocomplete="off">
    <div  class="box">
      <header><h2><?php echo T_("Connect store to your domain");?></h2></header>
      <div class="body">
        <p>
          <?php echo T_("You can connect one or more domains to your business. After connecting the domains") ?>
        </p>

        <label for="idomain"><?php echo T_("Domain"); ?> <span class="fc-red">*</span></label>
        <div class="input ltr">
          <input type="text" name="domain" id="idomain" <?php \dash\layout\autofocus::html() ?> required maxlength='100' minlength="1"  >
        </div>

      </div>
      <footer class="txtRa">
        <button  class="btn master" ><?php echo T_("Go"); ?></button>
      </footer>
    </div>
  </form>
</div>
