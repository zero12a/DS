<?php
header("Content-Type: text/html; charset=UTF-8");

//redis에 모두 넣기
//require_once "/data/www/lib/php/vendor/autoload.php";
$CFG = require_once("../common/include/incConfig.php");

?><!DOCTYPE html>
<html lang="en">
<head>
    <title id='Description'>jqxGrid</title>
    <meta name="description" content="JavaScript Grid with rich support for Data Filtering, Paging, Editing, Sorting and Grouping" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.1.3/jqwidgets/styles/jqx.base.min.css" type="text/css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 minimum-scale=1" />
    <script type="text/javascript" src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.1.4/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.1.4/jqwidgets/jqxdata.js"></script> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.1.4/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.1.4/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.1.4/jqwidgets/jqxmenu.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.1.4/jqwidgets/jqxcheckbox.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.1.4/jqwidgets/jqxlistbox.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.1.4/jqwidgets/jqxcombobox.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.1.4/jqwidgets/jqxdropdownlist.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.1.4/jqwidgets/jqxcalendar.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.1.4/jqwidgets/jqxdatetimeinput.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.1.4/jqwidgets/jqxgrid.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.1.4/jqwidgets/jqxgrid.sort.js"></script> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.1.4/jqwidgets/jqxgrid.pager.js"></script> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.1.4/jqwidgets/jqxgrid.selection.js"></script> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.1.4/jqwidgets/jqxgrid.edit.js"></script> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.1.4/jqwidgets/jqxgrid.columnsresize.js"></script> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.1.4/jqwidgets/jqxgrid.filter.js"></script> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.1.4/jqwidgets/jqxscrollbar.js"></script>
    

    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.15/lodash.min.js"></script>

    

    <style type="text/css">
        .fontBold, .fontBold span {
            font-weight: bold;
        }

        .fontLineThrough, .fontLineThrough span {
            text-decoration: line-through;
            font-weight: bold;
        }

        .fontNormal, .fontNormal span {
            font-weight: normal;
        }

    </style>
    <script type="text/javascript">
    var dataAdapter;

    $(document).ready(function () {

        //https://www.jqwidgets.com/community/topic/refreshdata-refresh-and-render-methods/
        //refreshdata – refreshes the data. (데이터 어뎁터의 records는 다시불러오기함 -> 스크롤이 맨위로 감)
        //refresh – updates the grid’s size and layout.
        //render – re-renders the grid.
        //updatebounddata – refreshes the data and re-renders the grid. (소스데이터 변경하고 새로고침하기, 화면 변경사항은 모두 취소됨)

        //캘린더 등 지역화
        var getLocalization = function(){
            var localizationobj = {};
            var days = {
                // full day names
                names: ["일", "월", "화", "수", "목", "금", "토"],
                // abbreviated day names
                namesAbbr: ["일", "월", "화", "수", "목", "금", "토"],
                // shortest day names
                namesShort: ["일", "월", "화", "수", "목", "금", "토"]
            };
            var months =  {
                // full month names (13 months for lunar calendards -- 13th month should be "" if not lunar)
                names: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월", ""],
                // abbreviated month names
                namesAbbr: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월", ""]
            };
            localizationobj.days = days;
            localizationobj.months = months;
            localizationobj.firstDay = 0;//the first day of the week (0 = Sunday, 1 = Monday, etc)
            localizationobj.currencysymbol = "₩";
            localizationobj.currencysymbolposition = "before";

            return localizationobj;
        }


        var url = "demo_data.xml";
        // prepare the data
        var source =
        {
            datatype: "xml",
            datafields: [
                { name: 'ProductName', type: 'string' },
                { name: 'QuantityPerUnit', type: 'int' },
                { name: 'UnitPrice', type: 'string' },
                { name: 'UnitsInStock', type: 'string' },
                { name: 'Discontinued', type: 'bool' },
                { name: 'BirthDate', type: 'date', format: 'yyyy-MM-dd' },
                { name: 'changeState', type: 'bool'},
                { name: 'changeCud', type: 'string'}
            ],
            root: "Products",
            record: "Product",
            id: 'ProductID',
            url: url
        };

        var cellclass = function (rowIndex, columnName, value, data) {
            //alog("cellclass().................start");
            //alog("  rowIndex = " + rowIndex);
            //alog("  columnName = " + columnName);
            //alog("  value = " + value);
            //alog("  data = " + JSON.stringify(data));    
            //alog("records=" + dataAdapter.records[rowIndex].ProductName
            //     + ", cachedrecords=" + dataAdapter.cachedrecords[rowIndex].ProductName
            //      + ", originaldata=" + dataAdapter.originaldata[rowIndex].ProductName);

            changeCud = data.changeCud;

            if(changeCud == "updated" || changeCud == "inserted"){
                return "fontBold";   
            }else if(changeCud == "deleted"){
                return "fontLineThrough";   
            }else{
                return "fontNormal";   
            }

        };            

        
        dataAdapter = new $.jqx.dataAdapter(source, {
            downloadComplete: function (data, status, xhr) { },
            loadComplete: function (data) { },
            loadError: function (xhr, status, error) { },
            updaterow: function (rowIndex, rowdata, commit) {
                alog("dataAdapter updaterow()...................start");
                alog("  rowIndex=" + rowIndex);

                commit(true);

                //기본이 변경
                rowdata.changeState = true;

                //변경과 삭제가 동일하게 updaterow이벤트 사용하기 때문에 주의 요망
                if(rowdata.changeCud == ""){
                    rowdata.changeCud = "updated";
                }
                                
            },
            addrow: function (rowIndex, rowdata, position, commit) {
                alog("dataAdapter addrow()...................start");                    
                //alog("  rowIndex = " + rowIndex);

                commit(true);

                rowdata.changeState = true;
                rowdata.changeCud = "inserted";
                //alog(this);
            },
            deleterow: function (rowIndex, commit) {
                alog("dataAdapter deleterow()...................start");      
                alog("  rowIndex = " + rowIndex);    
       
                commit(true);
            }                
        });

        var list = ['1', '2', '3'];
        var listJson = [
            { "nm" : "하이1", "cd" : "c01" },
            { "nm" : "하이2", "cd" : "c02" },
            { "nm" : "하이3", "cd" : "c03" },
            { "nm" : "하이4", "cd" : "c04" }
        ];

        var initeditor = function (row, cellvalue, editor, celltext, pressedChar) {
                console.log("initeditor");
            };

        var createeditor = function (rowindex, cellvalue, editor, celltext, cellwidth, cellheight) {
            console.log('createeditor');
        };

        var cellsrenderer = function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
            if (value < 20) {
                return '<span style="margin: 4px; margin-top:8px; float: ' + columnproperties.cellsalign + '; color: #ff0000;">' + value + '</span>';
            }
            else {
                return '<span style="margin: 4px; margin-top:8px; float: ' + columnproperties.cellsalign + '; color: #008000;">' + value + '</span>';
            }
        }

        var cellRendererComboBox = function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
            //alog("cellRendererComboBox().............................start");
            /*
            alog(row);
            alog(columnfield);
            alog(value);
            alog(defaulthtml);
            alog(columnproperties);
            alog(rowdata);
            */

            tmpObj = _.find(listJson, ['cd', value]);
            rtnStr = "";            
            //alog(tmpObj);
            if(tmpObj){
                rtnStr = rtnStr + tmpObj.nm;
            }                

            if(rtnStr==""){
                rtnStr=value;
                return '<span style="margin: 4px; margin-top:8px; float: ' + columnproperties.cellsalign + ';color:red;">' + rtnStr + "</span>";
            }else{
                return '<span style="margin: 4px; margin-top:8px; float: ' + columnproperties.cellsalign + ';">' + rtnStr + "</span>";
            }
        }
        
        var cellRendererDropDownListCheck = function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
            //alog("cellRendererDropDownListCheck().............................start");
            /*
            alog(row);
            alog(columnfield);
            alog(value);
            alog(defaulthtml);
            alog(columnproperties);
            alog(rowdata);
            */
            //alog(rowdata);
            tmpArr = value.split(",");
            rtnStr = "";
            for(i=0;i<tmpArr.length;i++){
                tmpObj = _.find(listJson, ['cd', tmpArr[i]]);
                //alog(tmpObj);
                if(tmpObj){
                    if(rtnStr == ""){
                        rtnStr = rtnStr + tmpObj.nm;
                    }else{
                        rtnStr = rtnStr +  "," + tmpObj.nm;
                    }
                }                
            }
            if(rtnStr==""){
                rtnStr=value;
                return '<span style="margin: 4px; margin-top:8px; float: ' + columnproperties.cellsalign + ';color:red;">' + rtnStr + "</span>";
            }else{
                return '<span style="margin: 4px; margin-top:8px; float: ' + columnproperties.cellsalign + ';">' + rtnStr + "</span>";
            }
        }


        // initialize jqxGrid
        $("#grid").jqxGrid(
        {
            width: ((document.body.offsetWidth - 13)/2),
            localization: getLocalization(),
            source: dataAdapter,    
            height: 800,            
            pageable: false,
            autoheight: false,
            sortable: true,
            altrows: true,
            enabletooltips: true,
            editable: true,
            editmode: 'dblclick', //click, dblclick, selectedcell, selectedrow
            columnsresize: true,
            selectionmode: 'checkbox', //'none', 'singlerow', 'multiplerows', 'multiplerowsextended', 
            //'multiplerowsadvanced', 'singlecell', multilpecells', 'multiplecellsextended', 'multiplecellsadvanced' and 'checkbox' 
            columns: [
                { cellclassname: cellclass, text: 'Product Name', datafield: 'ProductName', width: 100, pinned: true },
                { cellclassname: cellclass, text: 'Quantity per Unit', datafield: 'QuantityPerUnit', cellsalign: 'right', align: 'right', width: 50 },
                { cellclassname: cellclass, text: 'Unit Price',
                    cellsrenderer: cellRendererDropDownListCheck,
                    columntype: 'dropdownlist', 
                    datafield: 'UnitPrice', 
                    align: 'right', 
                    cellsalign: 'right', 
                    width: 80,
                    geteditorvalue: function (row, cellvalue, editor) {
                        alog("geteditorvalue1()...................start");
                        //alog(cellvalue);
                        //alog(editor.find('input').val());
                        // return the editor's value.
                        return editor.find('input').val();
                    },

                    cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
                        alog("cellvaluechanging1()...................start");
                        alog(newvalue);
                        return newvalue;
                    },

                    initeditor: function (row, cellvalue, editor, celltext){
                        alog("initeditor1()...................start");
                        //alog(row);
                        //alog(cellvalue);
                        //alog(editor);
                        //alog(celltext);       

                        //editor.jqxDropDownList('selectedIndex', 1);
                        //editor.jqxDropDownList('selectItem', 'c01');
                        var arrVal = cellvalue.split(",");
                        editor.jqxDropDownList('uncheckAll');
                        for(i=0;i<arrVal.length;i++){
                            //alog("체크 "+ i + " = " + arrVal[i]);
                            editor.jqxDropDownList('checkItem',arrVal[i]);
                        }
                    
                        alog("initeditor...................end");
                    },
                    createeditor: function (row, column, editor) {
                        alog("createeditor1()...................start");
                        //alog(row);
                        //alog(column);
                        //alog(editor);
                        
                        editor.jqxDropDownList({
                            openDelay: 100,
                            closeDelay: 100,
                            autoOpen: true,
                            checkboxes: true,
                            autoDropDownHeight: true, 
                            source: listJson, 
                            displayMember: "nm", 
                            valueMember: "cd",
                            placeHolder: "Select :"
                        });


                        editor.on('checkChange', function (event){
                            alog("checkChange1()....................start");
                            if (event.args) {
                                var item = event.args.item;
                                var value = item.value;
                                var label = item.label;
                                var checked = item.checked;
                            }
                            alog("checkChange()....................end");
                        });


                        alog("createeditor...................end");
                    }
                },
                { cellclassname: cellclass, text: 'Units In Stock', datafield: 'UnitsInStock', cellsalign: 'right'
                    , cellsrenderer: cellRendererComboBox
                    , columntype: 'combobox'
                    , width: 70 
                    , geteditorvalue: function (row, cellvalue, editor) {
                        alog("geteditorvalue2()...................start");
                        //alog(cellvalue);
                        //alog(editor);
                        //alog(editor.find('input').val());
                        var item = editor.jqxComboBox('getSelectedItem'); 
                        var selVal = "";
                        if(item){
                            selVal = item.value;
                        }
                        alog(selVal);

                        // return the editor's value.
                        return selVal;
                    },

                    cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
                        //alog("cellvaluechanging2()...................start");
                        //alog(newvalue);
                        return newvalue;
                    },

                    initeditor: function (row, cellvalue, editor, celltext){
                        alog("initeditor2()...................start");
                        //alog(row);
                        //alog(cellvalue);
                        //alog(editor);
                        //alog(celltext);       

                        editor.jqxComboBox('clearSelection'); //기존 선택 초기화
                        editor.jqxComboBox('selectItem',cellvalue);
                    
                        alog("initeditor2()...................end");
                    },
                    createeditor: function (row, column, editor) {
                        alog("createeditor2()...................start");
                        //alog(row);
                        //alog(column);
                        //alog(editor);
                        
                        editor.jqxComboBox({ 
                            openDelay: 100,
                            closeDelay: 100,
                            autoOpen: true, 
                            source: listJson, 
                            displayMember: "nm", 
                            valueMember: "cd",
                            autoComplete: true,
                            autoDropDownHeight: true,
                            placeHolder: "Select :"
                        });

                        alog("createeditor2()...................end");
                    }
                },
                { cellclassname: cellclass, text: 'Discontinued', columntype: 'checkbox', datafield: 'Discontinued' },
                { cellclassname: cellclass, text: 'BirthDate', columntype: 'datetimeinput', datafield: 'BirthDate'
                    , cellsformat:'yyyy-MM-dd'
                    ,cellvaluechanging: function (row, datafield, columntype, oldvalue, newvalue) {
                        alog("cellvaluechanging()...................start");
                        alog("  oldvalue=" + oldvalue);
                        alog("  newvalue=" + newvalue);
                        if(_.isDate(oldvalue) && _.isDate(newvalue) ){
                            dateDiff = Math.abs(oldvalue - newvalue);
                            if(dateDiff == 0){
                                return oldvalue;
                            }else{
                                return newvalue;
                            }
                        }else if(oldvalue == "" && newvalue == null){
                            return oldvalue;
                        }else{
                            //alog(newvalue);
                            return newvalue;
                        }
                    }
                }
            ]
        });

        //데이터 바인딩 완료
        $("#grid").on("bindingcomplete", function (event) {
            alog("bindingcomplete()......................start");            
            alog(dataAdapter);
        });  



        $('#grid').on('rowclick', function (event) {
            alog("rowclick()......................start");
            //체크박스일때랑 
            var args = event.args;
            // row's bound index.
            var boundIndex = args.rowindex;
            // row's visible index.
            var visibleIndex = args.visibleindex;
            // right click.
            var rightclick = args.rightclick; 
            // original event.
            var ev = args.originalEvent;                                                                                   
        }); 

        $("#grid").on('rowselect', function (event) {
            alog("rowselect()......................start");
            //alog(event);
            //alog(event.args.row);
            //alert(event.args.rowindex);

            //alog(dataAdapter);
            $("#txtArea").val("rowindex : " + event.args.rowindex + "\n\n" + JSON.stringify(event.args.row,null,"\t"));
            //$("#txtArea").val(JSON.stringify(dataAdapter,null,"\t"));
            // /alog(dataAdapter.records[0].QuantityPerUnit);
        });

        // events
        $('#grid').jqxGrid({ rendered: function(){
            alog("rendered.");
        }}); 

        $("#grid").on('cellbeginedit', function (event) {
            alog("cellbeginedit()......................start");
            alog(dataAdapter);
            //alog(event);                    
            var args = event.args;
            var rowindex = args.rowindex;            
        });            


        $("#grid").on('cellendedit', function (event) {
            alog("cellendedit()......................start");
            //alog(event);                
            var args = event.args;
            var rowindex = args.rowindex;


        });

    });

    function getCheckedRows(){
        alog("getCheckedRows()..........................start");
        var rowindexes = $('#grid').jqxGrid('getselectedrowindexes');

        //alog(rowindexes);
        //var allRows = $('#grid').jqxGrid('getrows');//sorting하면 바뀜 화면에 보이는순번이랑 dataadaptor랑 다름
        var allRows = $('#grid').jqxGrid('getboundrows');
        //alog(allRows);
        var checkedRows = [];
        for(i=0;i<rowindexes.length;i++){
            checkedRows[i] = allRows[rowindexes[i]];
        }


        alog(checkedRows);
    }

    function getChangedRows(){
        alog("getChangedRows()..........................start");
        var rows = $('#grid').jqxGrid('getrows');
        //alog(rows);
        //var filterRows = _.filter(rows,['changeState',true]);
        var filterRows = _.filter(rows,['changeState',true]); //loadash.js  (find는 1개만 찾고, filter를 모두 찾아줌)
        alog(filterRows);
    }

    function addFilter(){
        alog("addFilter()..........................start");
        var filtergroup = new $.jqx.filter();
        var filtervalue = 'Chai'; // Each cell value is compared with the filter's value.
        // filtertype - numericfilter, stringfilter, datefilter or booleanfilter. 
        // condition
        // possible conditions for string filter: 'EMPTY', 'NOT_EMPTY', 'CONTAINS', 'CONTAINS_CASE_SENSITIVE',
        // 'DOES_NOT_CONTAIN', 'DOES_NOT_CONTAIN_CASE_SENSITIVE', 'STARTS_WITH', 'STARTS_WITH_CASE_SENSITIVE',
        // 'ENDS_WITH', 'ENDS_WITH_CASE_SENSITIVE', 'EQUAL', 'EQUAL_CASE_SENSITIVE', 'NULL', 'NOT_NULL'
        // possible conditions for numeric filter: 'EQUAL', 'NOT_EQUAL', 'LESS_THAN', 'LESS_THAN_OR_EQUAL', 'GREATER_THAN', 'GREATER_THAN_OR_EQUAL', 'NULL', 'NOT_NULL'
        // possible conditions for date filter: 'EQUAL', 'NOT_EQUAL', 'LESS_THAN', 'LESS_THAN_OR_EQUAL', 'GREATER_THAN', 'GREATER_THAN_OR_EQUAL', 'NULL', 'NOT_NULL'                         
        var filter = filtergroup.createfilter('stringfilter', filtervalue, 'EQUAL');
        // To create a custom filter, you need to call the createfilter function and pass a custom callback function as a fourth parameter.
        // If the callback's name is 'customfilter', the Grid will pass 3 params to this function - filter's value, current cell value to evaluate and the condition.                        
        // operator - 0 for "and" and 1 for "or"
        filtergroup.addfilter(0, filter);
        // datafield is the bound field.
        // adds a filter to the grid.
        $('#grid').jqxGrid('addfilter', "ProductName", filtergroup);
        $("#grid").jqxGrid('applyfilters');

        var rows = $('#grid').jqxGrid('getrows');
        alog(rows);

        alog("addFilter()..........................end");

    }

    function deleteRow(){
        alog("deleteRow().............................start");
        //alog(JSON.stringify(dataAdapter.records));
        //var rowIndex = $('#grid').jqxGrid('getselectedrowindex');
        var rowindexes = $('#grid').jqxGrid('getselectedrowindexes');
        alog(rowindexes);
        //alert(rowindexes.length);

        if(rowindexes.length == 0){
            alert("선택된 행이 없습니다.");
            return;
        }
        //$('#grid').jqxGrid('deleterow', rowId);

        //rowindexes가 삭제하고 나면 변경되기 때문에 삭제하기 전에 먼저,rowId를 구매 놓음. 
        var rowIds = [];
        var rowRemoveIds = [];
        var rowDeleteIds = [];
        var rowDeleteDatas = [];
        for(i=0;i<rowindexes.length;i++){
            rowIndex = rowindexes[i];
            alog("  i=" + i + ", rowIndex=" + rowIndex);

            var rowId = $('#grid').jqxGrid('getrowid', rowIndex);
            if(dataAdapter.records[rowIndex].changeState == true
                && dataAdapter.records[rowIndex].changeCud == "inserted"
                ){
                //('#grid').jqxGrid('deleterow', rowId);
                rowRemoveIds[rowRemoveIds.length] = rowId;
            }else{
                rowDeleteIds[rowDeleteIds.length] = rowId;

                dataAdapter.records[rowIndex].changeState = true;
                dataAdapter.records[rowIndex].changeCud = "deleted";     
                rowDeleteDatas[rowDeleteDatas.length] = $('#grid').jqxGrid('getrowdatabyid', rowId);;
            }            
 
        }

        //alog( JSON.stringify( _.filter(dataAdapter.records,{'changeState':true, 'changeCud': 'deleted'}) ) );
        //alog( JSON.stringify( _.filter(dataAdapter.records,{'changeState':true, 'changeCud': 'add_deleted'}) ) );
        if(rowindexes.length > 0){
            $('#grid').jqxGrid('clearselection'); //선택한 체크 없애기
        }
        if(rowDeleteIds.length > 0){
            $('#grid').jqxGrid('updaterow', rowDeleteIds, rowDeleteDatas); //일괄 배열 삭제
        }
        if(rowRemoveIds.length > 0){
            $('#grid').jqxGrid('deleterow', rowRemoveIds); //일괄 배열 삭제
        }

        //$('#grid').jqxGrid('render'); //이거 했더니, 첫번째 행으로 스크롤위치가 변경됨. refreshdata를 해야 정렬했을때도 반영됨.
        //$('#grid').jqxGrid('refreshdata'); //이거 했더니, 첫번째 행으로 스크롤위치가 변경됨. refreshdata를 해야 정렬했을때도 반영됨.
            
        //alog(dataAdapter.records);
    }

    function daUpdate(){
        toUpdateObj = _.filter(dataAdapter.records,{'changeState':false, 'changeCud': 'deleted'});
        toUpdateObj.forEach(function(e){
            alog("변경 row id : " +  e.uid)
            newData = $('#grid').jqxGrid('getrowdatabyid', e.uid);

            $('#grid').jqxGrid('updaterow', e.uid, newData);
        });

        toDeleteObj = _.filter(dataAdapter.records,{'changeState':false, 'changeCud': 'add_deleted'});
        toDeleteObj.forEach(function(e){
            alog("삭제 row id : " +  e.uid)

        });
    }

    function reload(tmp){
        $('#grid').jqxGrid(tmp); //이걸로 해야 스크롤위치가 안바뀜.
    }

    function addRow(){
        alog("addRow().............................start");

        $('#grid').jqxGrid('clearselection'); //체크가 다른행으로 밀리기 때문에 선택한 체크 없애기

        var rowData = {
            "ProductName" : "111",
            "QuantityPerUnit": 222,
            "UnitPrice": '11',
            "UnitsInStock": '22',
            "Discontinued": true,
            "changeState": true,
            "changeCud": "inserted"
        };

        var value = $('#grid').jqxGrid('addrow', null, rowData, "first");

        //$('#grid').jqxGrid('refresh'); //이걸로 해야 스크롤위치가 안바뀜.
        //$('#grid').jqxGrid('render'); //이거 했더니, 첫번째 행으로 스크롤위치가 변경됨.
    }
    function alog(tmp){
        if(console)console.log(tmp);
    }
    </script>
</head>
<body class='default'>

<input type="button" onclick="getCheckedRows()" value="getCheckedRows">
<input type="button" onclick="getChangedRows()" value="getChangedRows">
<input type="button" onclick="addFilter1()" value="addFilter1">
<input type="button" onclick="deleteRow()" value="deleteRow">
<input type="button" onclick="reload('refreshdata')" value="freshdata">
<input type="button" onclick="reload('refresh')" value="refresh">
<input type="button" onclick="reload('render')" value="render">
<input type="button" onclick="reload('updatebounddata')" value="updatebounddata">
<input type="button" onclick="addRow()" value="addRow"><br>
    <div style="float:left;width:50%;">
    <div id="grid"></div>
    </div>
    <div style="float:left;width:50%;">
        <textarea id="txtArea" style="width:100%;height:800px;"></textarea>
    </div>
    
</body>
</html>