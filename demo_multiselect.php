<?php
//PGMID : ICONMNG
//PGMNM : 아이콘관리
header("Content-Type: text/html; charset=UTF-8"); //HTML

//설정 함수 읽기
$CFG = require_once '../common/include/incConfig.php';
?>
<html>
  <head>
    <title>multiselect</title>
    <style>

    </style>
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-3.4.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery.multiselect.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
    <script type="text/javascript" src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/lodash.min.js"></script>

    <link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery.multiselect.css?22" type="text/css" charset="UTF-8">

  </head>
  <body>
1
<div style="position:absolute;width:300px;left:100px;">
  <select id="tSelect" multiple style="width:300px">
      <option value="cd1">nm1</option>
      <option value="cd2">nmaaaaa2</option>
      <option value="cd3">nm3</option>
      <option value="cd4">nm4</option>
      <option value="cd5">nm5</option>
      <option value="cd6">nm6</option>
      <option value="cd7">nm7</option>
      <option value="cd8">nmaa8</option>
      <option value="cd9">nm9</option>
      <option value="cd10">nmaaaaa10</option>
  </select>
</div>
<input type="button" onclick="getVal();" value="getVal">
<input type="button" onclick="setVal('cd1,cd2');" value="setVal('cd1,cd2')">
2<hr><hr><hr><hr><hr><hr><hr>
</body>
<script>
  function getVal(){
    alert($("#tSelect").val());
  }

  tarr = [
    {"cd":"cd1","nm":"nm1"},
    {"cd":"cd2","nm":"nm2"},
    {"cd":"cd3","nm":"nm3"},
    {"cd":"cd4","nm":"nm4"},
    {"cd":"cd5","nm":"nm5"},
    {"cd":"cd6","nm":"nm6"},
    {"cd":"cd7","nm":"nm7"},
    {"cd":"cd8","nm":"nm8"},
    {"cd":"cd9","nm":"nm9"},
    {"cd":"cd10","nm":"nm10"},
  ];

  function setVal(tCds){
    tArrCds = tCds.split(",");
    for(i=0;i<tArrCds.length;i++){
      alog(i + " = " + tArrCds[i]);
      alog($("#tSelect > option[value=" + tArrCds[i] + "]"));
      $("#tSelect > option[value=" + tArrCds[i] + "]").attr("selected",true);

      //$("#tSelect").val(tArrCds[i]).prop("selected",true);
    }
  }

    $('#tSelect').multiselect({
        columns: 1,     // how many columns should be use to show options
        search : false, // include option search box

        // search filter options
        searchOptions : {
            delay        : 250,                  // time (in ms) between keystrokes until search happens
            showOptGroups: false,                // show option group titles if no options remaining
            searchText   : true,                 // search within the text
            searchValue  : false,                // search within the value
            onSearch     : function( element ){} // fires on keyup before search on options happens
        },

        // plugin texts
        texts: {
            placeholder    : 'Select options', // text to use in dummy input
            search         : 'Search',         // search input placeholder text
            selectedOptions: ' selected',      // selected suffix text
            selectAll      : 'Select all',     // select all text
            unselectAll    : 'Unselect all',   // unselect all text
            noneSelected   : 'None Selected'   // None selected text
        },

        // general options
        selectAll          : true, // add select all option
        selectGroup        : false, // select entire optgroup
        minHeight          : 300,   // minimum height of option overlay
        maxHeight          : null,  // maximum height of option overlay
        maxWidth           : null,  // maximum width of option overlay (or selector)
        maxPlaceholderWidth: null, // maximum width of placeholder button
        maxPlaceholderOpts : 10, // maximum number of placeholder options to show until "# selected" shown instead
        showCheckbox       : true,  // display the checkbox to the user
        optionAttributes   : [],  // attributes to copy to the checkbox from the option element

        // Callbacks
        onLoad        : function( element ){},           // fires at end of list initialization
        onOptionClick : function( element, option ){},   // fires when an option is clicked
        onControlClose: function( element ){},           // fires when the options list is closed
        onSelectAll   : function( element, selected ){}, // fires when (un)select all is clicked
        onPlaceholder : function( element, placeholder, selectedOpts ){}, // fires when the placeholder txt is up<a href="https://www.jqueryscript.net/time-clock/">date</a>d

        // @NOTE: these are for future development
        minSelect: false, // minimum number of items that can be selected
        maxSelect: false, // maximum number of items that can be selected

        });


function alog(tLog){
  if(typeof console == "object")console.log(tLog);
}
</script>

</html>