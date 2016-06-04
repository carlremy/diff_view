<?php
defined('C5_EXECUTE') or die('Access Denied.');

$val = Core::make('helper/validation/numbers');

$cID = 0;
if (isset($_REQUEST['cID']) && $val->integer($_REQUEST['cID'])) {
    $cID = $_REQUEST['cID'];
    $c = \Page::getByID($cID);
    $aCVID = $c->getVersionID();
}
if (!isset($_REQUEST['cvID']) || !is_array($_REQUEST['cvID'])) {
    die(t('Invalid Request.'));
}

?><div style="height: 100%"><?php
    $tabs = array();
    $checked = true;
    foreach ($_REQUEST['cvID'] as $key => $cvID) {
        if (!$val->integer($cvID)) {
            unset($_REQUEST['cvID'][$key]);
        } else {
            $tabs[] = array('view-version-' . $cvID, t('Version %s', $cvID), $checked);
            $checked = false;
        }
    }
    $tabs[] = array('diff-view', t('View Differences'));
    echo $ih->tabs($tabs);

    $display = 'block';
    foreach ($_REQUEST['cvID'] as $cvID) {
        ?><div id="ccm-tab-content-view-version-<?php echo $cvID?>" style="display: <?php echo $display?>; height: 100%">
            <iframe border="0" frameborder="0" height="100%" width="100%" src="<?php echo REL_DIR_FILES_TOOLS_REQUIRED?>/pages/preview_version?cvID=<?php echo $cvID?>&amp;cID=<?php echo $cID?>"></iframe>
        </div>
        <?php
        $display = 'none';
    }
?>
        <div id="ccm-tab-content-diff-view" style="display: none; height: 100%">
            <iframe border="0" frameborder="0" height="100%" width="100%" src="<?php echo REL_DIR_FILES_TOOLS_REQUIRED?>/pages/preview_version?cvID=<?php echo $aCVID?>&amp;cID=<?php echo $cID?>"></iframe>
        </div>
</div>
<script>
(function(){
  $('a[data-tab="diff-view"]').on('click', function(e){

  var DiffText = [];

  $('#ccm-panel-detail-page-versions').find('iframe:lt(2)').each( function(){

      DiffText.push( {
        text: this.contentDocument.body.innerHTML,
        }
      );
  });

  if(DiffText.length == 2) {

    var Diff = htmldiff(DiffText[1].text, DiffText[0].text);
    $('#ccm-tab-content-diff-view').find('iframe')[0].contentDocument.body.innerHTML = Diff;
    $( $('#ccm-tab-content-diff-view').find('iframe')[0].contentDocument.body).find('ins').css({color:'green',textDecoration:'none'});
    $( $('#ccm-tab-content-diff-view').find('iframe')[0].contentDocument.body).find('del').css({color:'#c00',textDecoration:'strikethrough'});

  }

  });
})();
</script>
<?php
