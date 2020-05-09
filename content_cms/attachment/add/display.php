
<form class="f justify-center" method="post" autocomplete="off">
 <div class="c9 s12 pRa20">


<div class="dropzone">
  <h4><?php echo T_("Add file"); ?></h4>
  <label for='gallery' class="btn light"><?php echo T_("To add image gallery drop file here or"); ?></label>
  <input id="gallery" type="file" name="file" multiple>
  <div class="progress shadow" data-percent='30'>
    <div class="bar"></div>
    <div class="detail"></div>
  </div>
  <small><?php echo T_("Maximum file size"); ?> <b><?php echo \dash\data::maxUploadSize(); ?></b></small>
</div>

 </div>
</form>


