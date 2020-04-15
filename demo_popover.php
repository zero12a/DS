<?php
//PGMID : ICONMNG
//PGMNM : 아이콘관리
header("Content-Type: text/html; charset=UTF-8"); //HTML

//설정 함수 읽기
$CFG = require_once '../common/include/incConfig.php';
?>
<html>
  <head>
    <title>Popper Tutorial</title>
    <style>

    </style>
    <script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-3.4.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.15/lodash.min.js"></script>


  </head>
  <body>
    <div class="dropdown">
        <div id="button1" class="dropDownList" 
        style="height:23px;overflow:hidden;border:solid 1px;float:left;width:200px;background-color:gray;">My button1</div>
        <div id="button2" class="dropDownList" style="height:23px;overflow:hidden;border:solid 1px;float:left;width:150px;background-color:silver;">My button2</div>
        <div id="button3" class="dropDownList" style="height:23px;overflow:hidden;border:solid 1px;float:left;background-color:silver;">My button3</div>
        <div id="button4" class="dropDownList" style="height:23px;overflow:hidden;border:solid 1px;float:left;background-color:silver;">My button4</div>
        <div id="button5" class="dropDownList" style="height:23px;overflow:hidden;border:solid 1px;float:left;background-color:silver;">My button5</div>
        <div id="button6" class="dropDownList" style="height:23px;overflow:hidden;border:solid 1px;float:left;width:150px;background-color:silver;">My button6</div>

    </div>
    <br>
    <div class="dropdown" id="dropDownView"
     style="background-color:blue;visibility:hidden;display:none;position:absolute;overflow:hidden;">
        <input type=hidden id="lastRowId" value="">
        <ul id="tooltip" role="tooltip" class="dropdown" style="list-style:none;padding:3px 5px 3px 0px;">
            <li>
                <input id="chk1" type="checkbox" value="Apple" />Apple
            </li>
            <li>
                <input id="chk1" type="checkbox" value="Blackberry" />Blackberry
            </li>
            <li>
                <input id="chk1" type="checkbox" value="HTC" />HTC
            </li>
            <li>
                <input id="chk1" type="checkbox" value="Sony Ericson" />Sony Ericson
            </li>
            <li>
                <input id="chk1" type="checkbox" value="Motorola" />Motorola
            </li>
            <li>
                <input id="chk1" type="checkbox" value="Nokia" />Nokia
            </li>
        </ul>
    </div>
    <hr><hr><hr><hr><hr><hr><hr><hr>

    <script>


    $(document).ready(function(){



        $('input[id="chk1"]').on('click', function() {
            alog(" checkbox click().................................start");

            txt = "";
            $('input[id="chk1"]').each(function() {
                if(this.checked){//checked 처리된 항목의 값
                    if(txt !="" )txt = txt + ",";
                    txt = txt + this.value;
                }
            });

            $("#" + $("#lastRowId").val()).text(txt);

        });
        
        $(".dropDownList").on('click',function(e){
            //alert($(e.target).text());
            clickObjId = $(e.target)[0].id;

            alog($(e.target)[0]);
            alog($(e.target)[0].offsetLeft);
            alog($(e.target)[0].offsetTop);

            toTop = $(e.target)[0].offsetTop + $(e.target)[0].offsetHeight + 1;
            toLeft =  $(e.target)[0].offsetLeft ;
            toWidth = $(e.target)[0].offsetWidth ;

            alog(clickObjId);
            $("#lastRowId").val(clickObjId);

            button = document.querySelector('#' + clickObjId);
            create(toTop,toLeft,toWidth);

            tarr = $(e.target).text().split(",");
            //alog($(e.target)[0].id);

            $('input[id="chk1"]').each(function() {
                //alog(this.value);
                //alog(_.indexOf(tarr,this.value));
                alog(this);
                if(_.indexOf(tarr,this.value) >= 0){
                    this.checked = true;
                }else{
                    this.checked = false;
                }

            });

            show();
        });

        $(document).bind('click', function(e) {
            alog("click()....................start");
            var $clicked = $(e.target);
            if (!$clicked.parents().hasClass("dropdown")) hide();
        });


    });



    function create(toTop, toLeft, toWidth){
        $("#dropDownView").css("top",toTop);
        $("#dropDownView").css("left",toLeft);
        $("#dropDownView").css("width",toWidth);

    }
    
    function show() {

        $("#dropDownView").css("visibility","");
        $("#dropDownView").css("display","");
    }

    function hide() {

        $("#dropDownView").css("visibility","hidden");
        $("#dropDownView").css("display","none");
        
    }


    function alog(tLog){
        if(typeof console == "object")console.log(tLog);
    }

    </script>
  </body>
</html>