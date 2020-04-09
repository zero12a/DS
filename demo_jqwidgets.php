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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.0.0/jqwidgets/styles/jqx.base.css" type="text/css" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 minimum-scale=1" />
    <script type="text/javascript" src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.0.0/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.0.0/jqwidgets/jqxdata.js"></script> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.0.0/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.0.0/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.0.0/jqwidgets/jqxmenu.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.0.0/jqwidgets/jqxcheckbox.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.0.0/jqwidgets/jqxlistbox.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.0.0/jqwidgets/jqxdropdownlist.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.0.0/jqwidgets/jqxgrid.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.0.0/jqwidgets/jqxgrid.sort.js"></script> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.0.0/jqwidgets/jqxgrid.pager.js"></script> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.0.0/jqwidgets/jqxgrid.selection.js"></script> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.0.0/jqwidgets/jqxgrid.edit.js"></script> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.0.0/jqwidgets/jqxgrid.columnsresize.js"></script> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.0.0/jqwidgets/jqxgrid.filter.js"></script> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.0.0/jqwidgets/jqxscrollbar.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.15/lodash.min.js"></script>

    

    <style type="text/css">
        .fontBold {
            font-weight: bold;
        }

        .fontLineThrough {
            text-decoration: line-through;
            font-weight: bold;
        }

        .fontNormal {
            font-weight: normal;
        }

    </style>
    <script type="text/javascript">
    var dataAdapter;
        
    $(document).ready(function () {
        var url = "demo_data.xml";
        // prepare the data
        var source =
        {
            datatype: "xml",
            datafields: [
                { name: 'ProductName', type: 'string' },
                { name: 'QuantityPerUnit', type: 'int' },
                { name: 'UnitPrice', type: 'float' },
                { name: 'UnitsInStock', type: 'float' },
                { name: 'Discontinued', type: 'bool' }
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
        var cellsrenderer = function (row, columnfield, value, defaulthtml, columnproperties, rowdata) {
            if (value < 20) {
                return '<span style="margin: 4px; margin-top:8px; float: ' + columnproperties.cellsalign + '; color: #ff0000;">' + value + '</span>';
            }
            else {
                return '<span style="margin: 4px; margin-top:8px; float: ' + columnproperties.cellsalign + '; color: #008000;">' + value + '</span>';
            }
        }
        dataAdapter = new $.jqx.dataAdapter(source, {
            downloadComplete: function (data, status, xhr) { },
            loadComplete: function (data) { },
            loadError: function (xhr, status, error) { },
            updaterow: function (rowIndex, rowdata, commit) {
                alog("dataAdapter updaterow()...................start");
                alog("  rowIndex=" + rowIndex);

                commit(true);

                if(rowdata.changeState != true){
                    rowdata.changeState = true;
                    rowdata.changeCud = "updated";
                }
                                
            },
            addrow: function (rowIndex, rowdata, position, commit) {
                alog("dataAdapter addrow()...................start");                    
                //alog("  rowIndex = " + rowIndex);

                commit(true);

                if(rowdata.changeState != true){
                    rowdata.changeState = true;
                    rowdata.changeCud = "inserted";
                }
                //alog(this);
            },
            deleterow: function (rowIndex, commit) {
                alog("dataAdapter deleterow()...................start");      
                //alog("  rowIndex = " + rowIndex);    
       
                commit(false);

                //alog(this);
                if(this.records[rowIndex].changeState != true){
                    alog(1);
                    this.records[rowIndex].changeState = true;
                    this.records[rowIndex].changeCud = "deleted";        
                }else{
                    alog(2);
                }
                //alog(this);
            }                
        });

        var list = ['1', '2', '3'];

        
        // initialize jqxGrid
        $("#grid").jqxGrid(
        {
            width: ((document.body.offsetWidth - 13)/2),
            source: dataAdapter,    
            height: 800,            
            pageable: false,
            autoheight: false,
            sortable: true,
            altrows: true,
            enabletooltips: true,
            editable: true,
            editmode: 'selectedcell', //click, dblclick, selectedcell, selectedrow
            columnsresize: true,
            selectionmode: 'checkbox', //'none', 'singlerow', 'multiplerows', 'multiplerowsextended', 
            //'multiplerowsadvanced', 'singlecell', multilpecells', 'multiplecellsextended', 'multiplecellsadvanced' and 'checkbox' 
            columns: [
                { cellclassname: cellclass, text: 'Product Name', datafield: 'ProductName', width: 150, pinned: true },
                { cellclassname: cellclass, text: 'Quantity per Unit', datafield: 'QuantityPerUnit', cellsalign: 'right', align: 'right', width: 100 },
                { cellclassname: cellclass, text: 'Unit Price',
                columntype: 'dropdownlist', 
                datafield: 'UnitPrice', 
                align: 'right', 
                cellsalign: 'right', 
                cellsformat: 'c2', 
                width: 100,
                createeditor: function (row, column, editor) {
                        editor.jqxDropDownList({ checkboxes: true, autoDropDownHeight: true, source: list });
                }
                },
                { cellclassname: cellclass, text: 'Units In Stock', datafield: 'UnitsInStock', cellsalign: 'right', cellsrenderer: cellsrenderer, width: 100 },
                { cellclassname: cellclass, text: 'Discontinued', columntype: 'checkbox', datafield: 'Discontinued' }
            ]
        });




        $("#grid").on('rowselect', function (event) {
            alog("rowselect()......................start");
            //alog(event);
            //alog(event.args.row);
            //alert(event.args.rowindex);

            //alog(dataAdapter);
            $("#txtArea").val(JSON.stringify(event.args.row,null,"\t"));
            //$("#txtArea").val(JSON.stringify(dataAdapter,null,"\t"));
            // /alog(dataAdapter.records[0].QuantityPerUnit);
        });

        // events

        $("#grid").on('cellbeginedit', function (event) {
            //alog("cellbeginedit()......................start");
            //alog(event);                    
            var args = event.args;
            var rowindex = args.rowindex;
            
        });            
        $("#grid").on('cellendedit', function (event) {
            //alog("cellendedit()......................start");
            //alog(event);                
            var args = event.args;
            var rowindex = args.rowindex;

        });

    });

    function getCheckedRows(){
        alog("getCheckedRows()..........................start");
        var rowindexes = $('#grid').jqxGrid('getselectedrowindexes');

        alog(rowindexes);
        //var allRows = $('#grid').jqxGrid('getrows');//sorting하면 바뀜 화면에 보이는순번이랑 dataadaptor랑 다름
        var allRows = $('#grid').jqxGrid('getboundrows');
        alog(allRows);
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
        var rowIndex = $('#grid').jqxGrid('getselectedrowindex');
        var rowId = $('#grid').jqxGrid('getrowid', rowIndex);
        alog("  rowIndex=" + rowIndex);
        alog("  rowId=" + rowId);
        
        //$('#grid').jqxGrid('deleterow', rowId);
        alog(dataAdapter.records[rowIndex]);
        dataAdapter.records[rowIndex].changeState = true;
        dataAdapter.records[rowIndex].changeCud = "deleted";     
        
        var rowJson = $('#grid').jqxGrid('getrowdata', rowIndex);

        $('#grid').jqxGrid('updaterow', rowId, rowJson);

        alog(dataAdapter.records[rowIndex]);  
    }

    function addRow(){
        alog("addRow().............................start");
        var value = $('#grid').jqxGrid('addrow', null, 
        {
            "ProductName" : "111",
            "QuantityPerUnit": 222,
            "UnitPrice": 3.3,
            "UnitsInStock": 4.4,
            "Discontinued": true,
            changeState: true,
            changeCud: "inserted"
        }, 
        "first");
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
<input type="button" onclick="addRow()" value="addRow"><br>
    <div style="float:left;width:50%;">
    <div id="grid"></div>
    </div>
    <div style="float:left;width:50%;">
        <textarea id="txtArea" style="width:100%;height:800px;"></textarea>
    </div>
    
</body>
</html>