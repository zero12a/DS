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
        .redClass
        {
            background-color: Red;
        }
        .greenClass
        {
            background-color: Green;
        }
        .blueClass
        {
            background-color: Blue;
        }
    </style>
    <script type="text/javascript">

        var cellclassname = function (row, column, value, data) {
            if (data.UnitPrice < 10) {
                return "redClass";
            } else if (data.UnitPrice < 20) {
                return "greenClass";
            } else if (data.UnitPrice >= 20) {
                return "blueClass";
            };
        };
            
            
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
                loadError: function (xhr, status, error) { }
            });

            var list = ['1', '2', '3'];

            

            // initialize jqxGrid
            $("#grid").jqxGrid(
            {
                width: (document.body.offsetWidth - 50),
                source: dataAdapter,    
                height: 400,            
                pageable: false,
                autoheight: false,
                sortable: true,
                altrows: true,
                enabletooltips: true,
                editable: true,
                editmode: 'selectedrow', //click, dblclick, selectedcell
                columnsresize: true,
                selectionmode: 'singlerow',
                columns: [
                  { text: 'Product Name', datafield: 'ProductName', width: 250, pinned: true },
                  { text: 'Quantity per Unit', datafield: 'QuantityPerUnit', cellsalign: 'right', align: 'right', width: 200 },
                  { text: 'Unit Price',
                    columntype: 'dropdownlist', 
                    datafield: 'UnitPrice', 
                    align: 'right', 
                    cellsalign: 'right', 
                    cellsformat: 'c2', 
                    width: 200,
                    cellclassname: cellclassname,
                    createeditor: function (row, column, editor) {
                            editor.jqxDropDownList({ checkboxes: true, autoDropDownHeight: true, source: list });
                    }
                  },
                  { text: 'Units In Stock', datafield: 'UnitsInStock', cellsalign: 'right', cellsrenderer: cellsrenderer, width: 100 },
                  { text: 'Discontinued', columntype: 'checkbox', datafield: 'Discontinued' }
                ]
            });

            $("#grid").on('rowselect', function (event) {
                //alog(event);
                //alog(event.args.row.ProductName);
                //alert(event.args.rowindex);



                alog(dataAdapter);
                $("#txtArea").val(JSON.stringify(dataAdapter,null,"\t"));
                alog(dataAdapter.records[0].QuantityPerUnit);
            });

            // events
            $("#grid").on('cellbeginedit', function (event) {
                var args = event.args;
                

                alog("Event Type: cellbeginedit, Column: " + args.datafield + ", Row: " + (1 + args.rowindex) + ", Value: " + args.value);
            });
            $("#grid").on('cellendedit', function (event) {
                var args = event.args;

                $("#row" + args.rowindex + "grid").children().css( "color", "red" );
                $("#row" + args.rowindex + "grid").children().css( "background-color", "blue" );

                alog("Event Type: cellendedit, Column: " + args.datafield + ", Row: " + (1 + args.rowindex) + ", Value: " + args.value);
            });

        });
    function alog(tmp){
        if(console)console.log(tmp);
    }
    </script>
</head>
<body class='default'>
    <div id="grid">
    </div>
    <textarea id="txtArea" style="width:100%;height:500px;"></textarea>
</body>
</html>