<?php
header("Content-Type: text/html; charset=UTF-8");

//redis에 모두 넣기
//require_once "/data/www/lib/php/vendor/autoload.php";
$CFG = require_once("../common/include/incConfig.php");

?><!DOCTYPE html>
<html lang="en">
<head>
    <title id='Description'>webix</title>
    <meta name="description" content="JavaScript Grid with rich support for Data Filtering, Paging, Editing, Sorting and Grouping" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <link rel="stylesheet" href="https://cdn.webix.com/site/webix.css?v=7.3.3" type="text/css" charset="utf-8">
    <script src="https://cdn.webix.com/site/webix.js?v=7.3.3" type="text/javascript" charset="utf-8"></script>

	<style type="text/css">
        .myhover{
            background: #F0DCB6;
        }
    </style>
</head>
<body>
<input type=button onclick="isMasterChecked()" value="isMasterChecked?">
<div id="testA"></div>
</body>
<script>
function check(){
    $$("dt").getHeaderContent("mc1").check();
};
function uncheck(){
    $$("dt").getHeaderContent("mc1").uncheck();
};
function isMasterChecked(){
    var state = $$("dt").getHeaderContent("mc1").isChecked();
    webix.message(state?"checked":"unchecked");
};

function logEvent(type, message, args){
    webix.message({ text:message, expire:2500 });
    console.log(type);
    console.log(args);
};

webix.ready(function(){
    var years = [];
    for (var i = 1970; i < 2015; i++)years.push({ id:i, value: i+"년" });

    webix.i18n.calendar = {
        monthFull:["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
        monthShort:["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
        dayFull:["일", "월", "화", "수", "목", "금", "토"],
        dayShort:["일", "월", "화", "수", "목", "금", "토"]
    };
    webix.i18n.calendar.clear = "지우기";
    webix.i18n.calendar.today = "오늘";
    webix.i18n.setLocale();


    grida = webix.ui({
        container:"testA",
        view:"datatable",
        height:100, 
        width:200,
        scroll:true,
        editable:true,
        editaction:"dblclick",
        id:"dt",
        leftSplit:2,
        select:"row",
        hover:"myhover",
        css:"webix_data_border webix_header_border webix_footer_border",
        columns:[
            { id:"ch1", header:{ content:"masterCheckbox", contentId:"mc1" }, checkValue:'on', uncheckValue:'off', template:"{common.checkbox()}", width:40},
            { editor:"select", options:["1", "2", "3", "4", "5"],		id:"rank",	header:"", css:"rank",  		width:50, sort:"int"},
            { editor:"text",	id:"title",	header:"Film title",    width:200, sort:"string"},
            { editor:"text",	id:"year",	header:"Released" ,     width:80, sort:"string"},
            { editor:"text",	id:"votes",	header:"Votes", 	width:100, sort:"int", numberFormat:"1,111.00"},
            { editor:"date",	id:"start",	header:"start", 	width:100, sort:"date", format:webix.Date.dateToStr("%Y-%m-%d")},
            { editor:"popup",	id:"popup",	header:["popup", {content:"textFilter"}], 	width:100, sort:"string"},
            { editor:"combo",	id:"combo1",	header:["combo1", {content:"selectFilter"}], 	width:100, sort:"int", collection:years}
        ],
        resizeColumn:true,
        autoheight:true,
        autowidth:true,
        on:{
            onSelectChange:function(){
                var text = "Selected: "+grida.getSelectedId(true).join();
                console.log(text);
            },
            onItemClick:function(){  logEvent("click","Cell clicked",arguments);  },
            onAfterSelect:function(){  logEvent("select:after","Cell selected",arguments);  },
            onCheck:function(){  logEvent("check","Checkbox",arguments);  },
            onAfterEditStart:function(){  logEvent("edit:afterStart","Editing started",arguments);  },
            onAfterEditStop:function(){  logEvent("edit:afterStop","Editing ended",arguments);  }
		},
        url:"demo_webix_data.php"
    });	
});
</script>
</html>