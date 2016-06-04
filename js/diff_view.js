//$('#diffview-button').hide();



$('#diffview-button').off('click').on('click', function(){
  var DiffText = [];
  $('#ccm-panel-detail-page-versions').find('iframe').each( function(){
      var active = $(this).parent().css('display') == 'block' ? true : false;
      DiffText.push( {
        text: this.contentDocument.body.innerHTML,
        active : active,
        frame : this
        }
      );
  });
  //alert(  );
  if(DiffText.length == 2) {
    var Diff = htmldiff(DiffText[1].text, DiffText[0].text);
  }

  for(d in DiffText){
    //alert(DiffText[d].active);
    if(DiffText[d].active) {
      $(DiffText[d].frame).css('border','1px solid red');
      console.log( $(DiffText[d].frame.contentDocument.body).html(Diff) );
    }
  }
});



//console.log( $(window.top.document).find('a[data-launch-panel="page"]') );

/*
$(document).ready(function(){

  $('a[data-launch-panel="page"]').on('click', function(e){
    //alert("Hunky dory!");
    //console.log( window.frames );
    //console.log( $('#ccm-panel-page') );

    $(document).ajaxComplete(function(e, x, s){

      var subPanel = $(e.target.activeElement).data('launch-sub-panel-url');

      if(typeof subPanel != 'undefined' && subPanel.indexOf('/ccm/system/panels/page/versions') > -1) {

          $('a[data-tab="diff-view"]').on('click', function(){
            alert("Hey");
          });


        //$('#diffview-button').show();
        //console.log( subPanel.indexOf('/ccm/system/panels/page/versions') );
      }

      //data-launch-sub-panel-url="http://word.ebmud.com:8057/ccm/system/panels/page/versions"
    });

  });

});
*/

//(window.top.document).find

//console.log( this );

//#ccm-tab-content-view-version-5

//


//
//ccm-panel-page-versions-version-checked

//ccm-flat-checkbox

/**

  html[version] = $(this.contentDocument.body.innerHTML + ' div.ccm-page').html();



    $('#ccm-panel-page-versions tr input.ccm-flat-checkbox').off('change').on('change', function(e){
      console.log( $(this).data('version-active') );
      $('#diffview-button').show();

      $('#ccm-panel-detail-page-versions').find('iframe').each( function(){
          console.log( this.src );
      } );
    });


//


#ccm-panel-detail-page-versions .ccm-panel-page-version-approved





var version = $('#ccm-panel-detail-page-versions li.active').find('a').data('tab').replace(/[\D]+/,'')


$('#ccm-panel-page-versions .ccm-flat-checkbox[value=' + version + ']').parents('tr').hasClass('ccm-panel-page-version-approved')


*/