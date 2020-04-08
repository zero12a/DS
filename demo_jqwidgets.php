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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jqwidgets-scripts@9.0.0/jqwidgets/jqxscrollbar.js"></script>

    <style type="text/css">
        .fontbold {
            font-weight: bold;
        }

        .fontnormal {
            font-weight: normal;
        }

    </style>
    <script type="text/javascript">

        
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
            //alog("cellclass2().................start");
            //alog("  rowIndex = " + rowIndex);
            //alog("  columnName = " + columnName);
            //alog("  value = " + value);
            //alog("  data = " + JSON.stringify(data));    
            //alog("records=" + dataAdapter.records[rowIndex].ProductName
            //     + ", cachedrecords=" + dataAdapter.cachedrecords[rowIndex].ProductName
            //      + ", originaldata=" + dataAdapter.originaldata[rowIndex].ProductName);
            if(
                dataAdapter.records[rowIndex].ProductName != dataAdapter.originaldata[rowIndex].ProductName
                || dataAdapter.records[rowIndex].QuantityPerUnit != dataAdapter.originaldata[rowIndex].QuantityPerUnit
                || dataAdapter.records[rowIndex].UnitPrice != dataAdapter.originaldata[rowIndex].UnitPrice
                || dataAdapter.records[rowIndex].UnitsInStock != dataAdapter.originaldata[rowIndex].UnitsInStock
                || dataAdapter.records[rowIndex].Discontinued != dataAdapter.originaldata[rowIndex].Discontinued                
            ){
                return "fontbold";   
            }else{
                return "fontnormal";   
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
        var dataAdapter = new $.jqx.dataAdapter(source, {
            downloadComplete: function (data, status, xhr) { },
            loadComplete: function (data) { },
            loadError: function (xhr, status, error) { },
            updaterow: function (rowid, rowdata, commit) {
                alog("dataAdapter updaterow()...................start");
                rowindex = $('#grid').jqxGrid('getrowboundindexbyid', rowid);

                //alert(1);
                //alog(rowdata);

                //alog("records=" + this.records[rowindex].ProductName
                // + ", cachedrecords=" + this.cachedrecords[rowindex].ProductName
                //  + ", originaldata=" + this.originaldata[rowindex].ProductName);

                //commit(false); false 하면 화면에 데이터 업데이트 되지 않고 취소됨.

                //alog("records=" + this.records[rowindex].ProductName
                // + ", cachedrecords=" + this.cachedrecords[rowindex].ProductName
                //  + ", originaldata=" + this.originaldata[rowindex].ProductName);

                //alog(this);
                //alog(rowdata);

                //oldVal = this.originaldata[rowindex].ProductName;


                                
            },
            addrow: function (rowid, rowdata, position, commit) {
                alog("dataAdapter addrow()...................start");                    
                alog("  rowid = " + rowid);
                //alog("  columnName = " + columnName);
                //alog("  value = " + value);
                //alog("  data = " + JSON.stringify(data));    
                commit(true);
            },
            deleterow: function (rowid, commit) {
                alog("dataAdapter deleterow()...................start");                            
                commit(true);
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
            selectionmode: 'singlerow',
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
            //alog(event);
            //alog(event.args.row.ProductName);
            //alert(event.args.rowindex);

            //alog(dataAdapter);
            $("#txtArea").val(JSON.stringify(dataAdapter,null,"\t"));
            // /alog(dataAdapter.records[0].QuantityPerUnit);
        });

        // events

        $("#grid").on('cellbeginedit', function (event) {
            //alog("cellbeginedit()......................start");
            //alog(event);                    
            var args = event.args;
            var rowindex = args.rowindex;
            
            //alog("records=" + dataAdapter.records[rowindex].ProductName
            //     + ", cachedrecords=" + dataAdapter.cachedrecords[rowindex].ProductName
            //      + ", originaldata=" + dataAdapter.originaldata[rowindex].ProductName);
            //alog("Event Type: cellbeginedit, Column: " + args.datafield + ", Row: " + (1 + args.rowindex) + ", Value: " + args.value);
        });            
        $("#grid").on('cellendedit', function (event) {
            //alog("cellendedit()......................start");
            //alog(event);                
            var args = event.args;
            var rowindex = args.rowindex;

            //alog("records=" + dataAdapter.records[rowindex].ProductName
            //     + ", cachedrecords=" + dataAdapter.cachedrecords[rowindex].ProductName
            //      + ", originaldata=" + dataAdapter.originaldata[rowindex].ProductName);
            //$("#row" + args.rowindex + "grid").children().css( "color", "red" );
            //alert(1);
            //oldVal = 
            //newVal = JSON.stringify(event.args.row);
            //alert(newVal);
            //$("#row" + args.rowindex + "grid").children(".jqx-grid-cell").css( "font-weight", "bold" );

            //alog("Event Type: cellendedit, Column: " + args.datafield + ", Row: " + (1 + args.rowindex) + ", Value: " + args.value);
        });

    });


    function addRow(){
        var value = $('#grid').jqxGrid('addrow', null, 
        {
            "ProductName" : "111",
            "QuantityPerUnit": 222,
            "UnitPrice": 3.3,
            "UnitsInStock": 4.4,
            "Discontinued": true,
        }, 
        0);
    }
    function alog(tmp){
        if(console)console.log(tmp);
    }
    </script>
</head>
<body class='default'>
<input type="button" onclick="addRow()" value="addrow"><br>
    <div style="float:left;width:50%;">
    <div id="grid"></div>
    </div>
    <div style="float:left;width:50%;">
        <textarea id="txtArea" style="width:100%;height:800px;"></textarea>
    </div>
    
</body>
</html>