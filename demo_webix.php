<?php
header("Content-Type: text/html; charset=UTF-8");

//redis에 모두 넣기
//require_once "/data/www/lib/php/vendor/autoload.php";
$CFG = require_once("../common/include/incConfig.php");

?><!DOCTYPE html>
<html lang="en">
<head>
    <title id='Description'>webix3</title>
    <meta name="description" content="JavaScript Grid with rich support for Data Filtering, Paging, Editing, Sorting and Grouping" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <link rel="stylesheet" hr ef="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/webix/codebase/webix.min.css" type="text/css" charset="utf-8">

    <link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/webix/codebase/skins/mini.min.css" type="text/css" charset="utf-8">

    <script type="text/javascript" src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/lodash.min.js"></script>

    <script sr c="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/webix/codebase/webix.js" type="text/javascript" charset="utf-8"></script>
    <script src="test_webix_trial.js" type="text/javascript" charset="utf-8"></script>
    

    <!--bt 4-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/axios@0.19.2/dist/axios.min.js"></script>

    <link rel="stylesheet" href="/common/common_webix.css" type="text/css" charset="utf-8">
    <script src="/common/common_webix.js"></script>
    <style type="text/css">

        /* even odd 
        https://forum.webix.com/discussion/2395/alternating-styles-for-even-and-odd-rows

        .webix_column > div:nth-child(2n) {
            background-color: #F7F7F7;
        }
        .webix_column > div.webix_cell_select:nth-child(2n), .webix_column > div.webix_column_select:nth-child(2n), .webix_column > div.webix_row_select:nth-child(2n) {
            color: #fff;
            background: #27ae60;
        }
        */
    </style>
</head>
<body>
    <input type=button onclick="isMasterChecked()" value="isMasterChecked?">
    <input type=button onclick="grida.add({},0)" value="addRow">
    <input type=button onclick="loadData()" value="loadData">
    <input type=button onclick="getChangedData()" value="getChangedData">
    <input type=button onclick="getMasterCheckupData()" value="getMasterCheckupData">
    <input type=button onclick="getAllData()" value="getAllData">
    <input type=button onclick="addRow()" value="addRow">
    <input type=button onclick="delRow()" value="delRow">
    <input type=button onclick="saveOk()" value="saveOk">
    <input type=button onclick="removeOk()" value="removeOk"><br>
    <input type=button onclick="changeId(99999)" value="changeId(99999)">
    <input type=button onclick="getSelectedItem()" value="getSelectedItem">
    <input type=button onclick="getDataStore()" value="getDataStore">
    <input type=button onclick="getSerialize()" value="getSerialize">
    <input type=button onclick="loadCombo()" value="loadCombo">
    <input type=button onclick="resizeWidth()" value="resizeWidth">
    <input type=button onclick="codesearchChange()" value="codesearchChange">

    <div id="grpG1"  style="width:50%;background-color:silver;">
        <div id="testA" style="width:100%;background-color:yellow;"></div>
    </div>
</body>
<script>

var grida = null;

function goGridPopOpen(t1,t2,t3,t4,t5){
    alog("goGridPopOpen()........................start");
    alog("t1=" + t1);
    alog("t2=" + t2);
    alog("t3=" + t3);
    alog("t4=" + t4);
    alog("t5=" + t5);
    
}

function codesearchChange(){
    rowId = $$("webix_dt").getSelectedId(false);
    var rowItem = $$("webix_dt").getItem(rowId);

    rowItem.codesearch1 = "cd변경^nm변경";
    rowItem.changeState = true;
    rowItem.changeCud = "updated";

    $$("webix_dt").updateItem(rowId, rowItem);
}

function resizeWidth(){
    $$("webix_dt").resize();
}

function getSelectedItem(){
    alog("getSelectedItem()...........................start");
    rowId = $$("webix_dt").getSelectedId(false);
    alog("  rowId=" + rowId);
    var rowItem1 = $$("webix_dt").getItem(rowId);
    alog("rowItem = " + JSON.stringify(rowItem1));
}
function getDataStore(){
    alog($$("webix_dt").data);
}
function getSerialize(){
    alog($$("webix_dt").serialize(true));
}



function getCode1() {
  return axios.get('demo_webix_code1.php');
}

function getCode2() {
  return axios.get('demo_webix_code2.php');
}




function loadCombo(){
    alog("loadCombo()..............................start")

    alog(grida.getColumnConfig("rank"));
    Promise.all([getCode1(), getCode2()])
        .then(function (results) {
            alog("axios.then()............................start");
            alog(results);

            const code1 = results[0];
            const code2 = results[1];

            //alog($$("webix_dt").getColumnConfig("rank"));
            $$("webix_dt").getColumnConfig("rank").options = code2.data;
            //$$("webix_dt").refreshColumns(); //필수호출해야함.

            $$("webix_dt").getColumnConfig("year").options = code1.data;
            //$$("webix_dt").refreshColumns(); //필수호출해야함.

            $$("webix_dt").getColumnConfig("combo1").options = code1.data;
            $$("webix_dt").refreshColumns(); //필수호출해야함.

            alog("axios.then()............................end");
        }
    );


    alog("loadCombo()..............................end")

}

function changeId(tmp){
    alog("changeId()...........................start");
    // https://snippet.webix.com/2d8d744c
    // https://forum.webix.com/discussion/31269/update-the-id-in-datatable
    var rowId = $$("webix_dt").getSelectedId(false);
    if(typeof rowId != "undefined" && rowId != null){
        //$$("webix_dt").data.changeId(rowId,tmp);

        var rowItem1 = $$("webix_dt").data.getItem(rowId);
        alog("old rowItem = " + JSON.stringify(rowItem1));

        alog("call before oldid="+ rowId + ",newid=" + tmp);
        $$("webix_dt").data.changeId(rowId,tmp);  
        //$$("webix_dt").data.refresh(); 
        //rowItem1.id = tmp;
        //$$("webix_dt").data.updateItem(rowId, rowItem1);
        //$$("webix_dt").updateItem(rowId, rowItem1);
        //$$("webix_dt").data.changeId(rowId,tmp);  

        var rowItem2 = $$("webix_dt").data.getItem(tmp);
        alog("new rowItem = " + JSON.stringify(rowItem2));

        alog($$("webix_dt").data.order);
        alog($$("webix_dt").data.pull);
        allData = $$("webix_dt").serialize(true);
        alog(allData);
        //$$("webix_dt").refresh();
    }
}
function removeOk(){
    alog("removeOk()...........................start");
    rowId = $$("webix_dt").getSelectedId(false);

    $$("webix_dt").remove(rowId); // removes the item with ID=1
}
function saveOk(){
    alog("saveOk()...........................start");
    rowId = $$("webix_dt").getSelectedId(false);

    $$("webix_dt").removeRowCss(rowId, "fontStateUpdate");
    $$("webix_dt").removeRowCss(rowId, "fontStateDelete");
    $$("webix_dt").removeRowCss(rowId, "fontStateInsert");
    
    rowItem = $$("webix_dt").getItem(rowId);
    rowItem.changeState = null;
    rowItem.changeCud = "";
}

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


function delRow(){
    rowId = $$("webix_dt").getSelectedId(false);
    alog(rowId);
    if(typeof rowId != "undefined"){
        $$("webix_dt").addRowCss(rowId, "fontStateDelete");

        rowItem = $$("webix_dt").getItem(rowId);
        rowItem.changeState = true;
        rowItem.changeCud = "deleted";
    }else{
        alert("삭제할 행을 선택하세요.");
    }
}

function addRow(){
    rowId = $$("webix_dt").add({
        id: webix.uid(),
        title: "제목입니다.",
        year: "1980",
        votes: 1000,
        rank:5,
        start:"2020-10-10",
        popup:"good",
        combo1: "1978"
    },0);

    $$("webix_dt").addRowCss(rowId, "fontStateInsert");
    alog("add row rowId : " + rowId);
    rowItem = $$("webix_dt").getItem(rowId);
    rowItem.changeState = true;
    rowItem.changeCud = "inserted";
}
function getChangedData(){
    allData = $$("webix_dt").serialize(true);
    alog(allData);
    chgData = _.filter(allData,['changeState',true]);

    alog(chgData);
}

function getMasterCheckupData(){
    allData = $$("webix_dt").serialize(true);
    alog(allData);
    chkData = _.filter(allData,['mastercheck1','on']);
    for(i=0;i<chkData.length;i++){
        chkData[i].changeState = true;
        chkData[i].changeCud = "updated";
    }
    alog(chkData);
}

function getAllData(){
    const allData = $$("webix_dt").serialize(true);
    alog(allData);
    //alert(allData);
}

function loadData(){
    alog("loadData()..........................start");
    $$("webix_dt").clearAll();
    var date1 = new Date()



    $$("webix_dt").load("demo_webix_data.php","json",function(){
        alog("  load()..............................callback");
        var date2 = new Date()
        alog("diff = " + (date2 - date1));
    });



    alog("loadData()..........................end");
    //alog(atob("d2ViaXguY29tLw=="));
    //alog(atob("d2ViaXhjb2RlLmNvbS8="));
    //alog(atob("VGhpcyB2ZXJzaW9uIG9mIFdlYml4IGlzIG5vdCBpbnRlbmRlZCBmb3IgdXNpbmcgb3V0c2lkZSBvZiB3ZWJpeC5jb20="));
}



webix.ready(function(){


    webix.i18n.calendar = webixConfig.calendar;
    webix.i18n.dateFormat = webixConfig.dateFormat;
    //webix.i18n.timeFormat = "%H:%i";
    //webix.i18n.longDateFormat = "%Y-%m-%d";
    //webix.i18n.fullDateFormat = "%Y-%m-%d %H:%i:%s";
    webix.i18n.setLocale();
    //webix.i18n.setLocale("ko-KR");

    webix.editors.$popup.text = webixConfig.popup_text;//팝업 가로/세로 커스텀

    // filter
    // 기본 : textFilter selectFilter numberFilter dateFilter 
    // 프로 : richSelectFilter multiSelectFilter multiComboFilter datepickerFilter dateRangeFilter excelFilter
    // datepickerFilter, dateRangeFilter : json은 리털밸류가 문자, 숫자만 있기 때문에 날짜인식을 위해서는 map을 이용해 (date)타입으로 변환필요
    //  기본 map 형식은 map: "(date)#colid1#"이나 id와 동일컬럼인 경우 "(date)" 날짜타입 변환만 표기 
    // multiSelectFilter : 선택전에는 콤보오브젝트 표시되고 선택후, 라벨에 선택된 아이템목록 모두 출력
    // multiComboFilter : 선택전에는 텍스트입력 오브젝트 표시되고 선택후, 라벨에 선택된 아이템수만 출력

    grida = webix.ui({
        container:"testA",
        view:"datatable",
        height:520, 
        //width:750,
        autowidth:true,
        scroll:true,
        editable:true,
        editaction:"dblclick", //dblclick, click, custom
        id:"webix_dt",
        leftSplit:2,
        select:"row", //cell, row, column, true, false
        hover:"myhover",
        resizeColumn:true,
        autoheight:false,
        autowidth:false,
        multiselect:true,
        css:"webix_data_border webix_header_border webix_footer_border",
        columns:[
            { id:"mastercheck1", header:{ content:"masterCheckbox", contentId:"mc1" }, checkValue:'on', uncheckValue:'off', template:"{common.checkbox()}", width:40},
            { id:"mastercheckup2", header:{ content:"masterCheckbox", contentId:"mc2" }, checkValue:'on', uncheckValue:'off', template:"{common.checkbox()}", width:40},
            { id:"chk", header: "chk", checkValue:'on', uncheckValue:'off', template:"{common.checkbox()}", width:40, sort: "string"},
            { editor:"select", options:null,		id:"rank",	header:"rank", css:"rank",  		width:50, sort:"int"},
            { editor:"text",	id:"title",	header:"Film title",    width:100, sort:"string", css:{"text-align":"right"}},
            { editor:"multiselect",	id:"year",
                optionslist: true,
                options: null,
                header: ["Released",{content:"multiSelectFilter"}] ,     
                width: 120, 
                sort:"string"},
            { editor:"text",	id:"votes",	header:"Votes", 	width:100, sort:"int", numberFormat:"1,111.00"},
            { editor:"date",	id:"start",	header:["start", {content:"dateRangeFilter"}], 	width:100, sort:"date"
                //, format:webix.i18n.dateFormatStr
                , format:webix.Date.dateToStr("%Y-%m-%d")
                , map: "(date)"
            },
            { editor:"popup",	id:"popup",	header:["popup", {content:"textFilter"}], 	width:100, sort:"string"},
            { editor:"combo",	id:"combo1",	header:["combo1", {content:"selectFilter"}], 	width:100, sort:"int", options:null},
            { editor:"codesearch", id:"codesearch1", header:"codesearch1", width:100, sort:"string"
                ,css:{"text-align":"right"}
                ,template:function(obj){
                    //alog("codesearch.template().............................start");
                    //alog(this);
                    //alog(obj);
                    t=obj.codesearch1; //형식 nm^cd (정렬시 nm이 먼저활용되게 하기 위함)
                    tCd = t.split("^")[1];
                    tNm = t.split("^")[0];
                    grpId = "G1";
                    dataId = obj.id;
                    colId = this.id;
                    var rtnVal = "<div style='float:left;' id='" + tCd + "'>" + tNm + "</div>";
                    rtnVal += "<div style='float:right;'>";
                    rtnVal += "<img onclick=\"goGridPopOpen('" + grpId + "','" + dataId + "','" + colId + "','" +  tNm + "','" + tCd + "',this)\" src='http://localhost:8070/img/search.png' align='absmiddle' style='width:26px;height:26px;'>";
                    rtnVal += "</div>"
                    return rtnVal;
                }
            },
            { editor:"link",	id:"link1",	header:["link", {content:"textFilter"}], 	width:100, sort:"string"
                , template:function(obj){
                    //alog("link1.template().............................start");
                    //alog(this);
                    //alog(obj);
                    t=obj.link1; //형식 nm^link^target (정렬시 nm이 먼저활용되게 하기 위함)

                    tNm = t.split("^")[0];
                    tLink = t.split("^")[1];
                    tTarget = t.split("^")[2];
                    var rtnVal = "<div style='float:left;'><a href='" + tLink + "' target='" + tTarget + "'>" + tNm + "</a></div>";
                    return rtnVal;
                }
            }
        ],
        on:{
            onSelectChange:function(){
                var text = "Selected: "+grida.getSelectedId(true).join();
                console.log(text);
            },
            onAfterSelect:function(){  logEvent("select:after","Cell selected",arguments);  },
            //onCheck:function(){  logEvent("check","Checkbox",arguments);  },
            onAfterEditStart:function(){  logEvent("edit:afterStart","Editing started",arguments);  },
            onAfterEditStop:function(state, editor, ignoreUpdate){
                alog("onAfterEditStop()................................start");
                alog(state);
                alog(editor);
                alog(ignoreUpdate);
                
                if(state.value != state.old){
                    webix.message("Cell value " + editor.row + " was changed");

                }  

            },
		},
        //url:"demo_webix_data.php"
    });	
    grida.attachEvent("onItemClick", function(rowItem, e, htmlObj){
        alog("onItemClick()............................start");
        alog(rowItem);
        alog(e);
        alog(htmlObj);

        //alert($$("webix_dt").getFilter("start").value);
    });


    grida.attachEvent("onBeforeFilter", function(id, value, config){
        alog("onBeforeFilter()............................start");
        alog(id);
        alog(value);

        alog(config);

        //alert($$("webix_dt").getFilter("start").value);
    });

    /*
    grida.attachEvent("onCheck", function(rowId, columnId, state){
        alog("onCheck()............................start");
        alog(rowId);
        alog(columnId);
        alog(state);


        var rowItem = $$("webix_dt").getItem(rowId);

        if(state == "on"){
            rowItem.changeState = true;
            rowItem.changeCud = "updated";
        }else{
            rowItem.changeState = null;
            rowItem.changeCud = null;
        }
        $$("webix_dt").updateItem(rowId, rowItem);

        if(state == "on"){
            $$("webix_dt").addRowCss(rowId, "fontStateUpdate");
        }else{
            $$("webix_dt").removeRowCss(rowId, "fontStateUpdate");
        }
        alog("onCheck()............................end");
    });
    */
    

    grida.data.attachEvent("onDataUpdate", function(id, newObj, oldObj){
        alog("onDataUpdate()............................start");
        alog(this);

        alog(id);
        alog("  old = " + JSON.stringify(oldObj));

        alog("  new1 = " + JSON.stringify(newObj));
        if(typeof newObj.changeState == "undefined" || newObj.changeState == null){
            $$("webix_dt").addRowCss(id, "fontStateUpdate");
            newObj.changeState = true;
            newObj.changeCud = "updated";
        }
        alog("  new2 = " + JSON.stringify(newObj));

        alog("onDataUpdate()............................end");
    });

    /*
    grida.data.attachEvent("onStoreUpdated", function(id, obj, mode){
        alog("onStoreUpdated()............................start");
        alog(id);
        alog(obj);
        alog(mode);
        alog("onStoreUpdated()............................end");
    });
    */

    
    grida.data.attachEvent("onIdChange", function(oldid, newid){
        alog("onIdChange()............................start");
        alog("  oldid=" + oldid);
        alog("  newid=" + newid);
    });

    //alog(grida.getColumnConfig("rank"));
});


function alog(tmp){
    if(console)console.log(tmp);
}
</script>
</html>