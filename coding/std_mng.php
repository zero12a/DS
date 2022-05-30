<?php

//echo $_GET["list_seq"];
require_once __DIR__ . "/../../common/include/incUtil.php";

$userId = $_GET["userid"];
if($userId == "") $userId = getRndVal(6);
$userColor = $_GET["usercolor"];
if($userColor == "") $userColor = "red";
$userName = $_GET["username"];
if($userCuserNameolor == "") $userName = getRndVal(10);

?>
<html>
<head>
    <title>std mng</title>

    <meta charset="utf-8" />
    <!-- Firebase -->
    <script src="https://www.gstatic.com/firebasejs/5.5.4/firebase.js"></script>
    <!-- CodeMirror and its JavaScript mode file -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.17.0/codemirror.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.17.0/mode/javascript/javascript.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.17.0/codemirror.css" />

    <!-- Firepad -->
    <link rel="stylesheet" href="https://firepad.io/releases/v1.5.10/firepad.css" />
    <script src="../lib/firepad.js?<?=rand(1000000,9999999);?>"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/stomp.js/2.3.3/stomp.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/split.js/1.6.0/split.min.js"></script>

    <script src="./lib/std_mng.js?<?=rand(1000000,9999999);?>"></script>

    <!--asesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>



    <style> 
    html,
    body {
        height: 100%;
        padding: 0;
        margin: 0;
    }




    .split {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        overflow-y: hidden;
        overflow-x: hidden;
    }
    
    .gutter {
        background-color: black;
        background-repeat: no-repeat;
        background-position: 50%;
    }
    
    .gutter.gutter-horizontal {
        cursor: col-resize;
        background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAFAQMAAABo7865AAAABlBMVEVHcEzMzMzyAv2sAAAAAXRSTlMAQObYZgAAABBJREFUeF5jOAMEEAIEEFwAn3kMwcB6I2AAAAAASUVORK5CYII=');
    }
    
    .gutter.gutter-vertical {
        cursor: row-resize;
        background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUAAAAeCAYAAADkftS9AAAAIklEQVQoU2M4c+bMfxAGAgYYmwGrIIiDjrELjpo5aiZeMwF+yNnOs5KSvgAAAABJRU5ErkJggg==');
    }
    
    .split.split-horizontal,
    .gutter.gutter-horizontal {
        height: 100%;
        float: left;
    }



    .fa-solid:hover{
        color:red
    }






    ul {
        list-style-type: none;
        margin-left: 0px ;
        padding: 0px;
    }

    ul > li > ul, ul > li > ul > li > ul {
        padding: 0px 0px 0px 24px; 
    }

    ul .ui-selecting { background: #FECA40; }
    ul .ui-selected { background: #F39814; color: white; }

    
    /* mouse over */
    .optionsecoptions {
        background: #eceded;
        cursor: pointer;
    }
    .optionsecoptions:hover { background-color: #bfe5ff; }  
    .optionsecoptions:active { background-color: #2d546f; color: #ffffff; }

    .selected { background-color: #226fa3; color: #ffffff; }
    .selected:hover { background-color: #4d99cc; }
    </style>
</head>
<body onload="init();">
    <div class="split">
        <div id="file" class="split split-horizontal" st-yle="background-color:yellow;">
            file viewer
            <i class='fa-solid fa-arrow-rotate-right' onclick='reload(event,this);'></i>
            <i class='fa-solid fa-file-circle-plus' onclick='addFile(event,this);'></i> 
            <i class='fa-solid fa-folder-plus' onclick='addFolder(event,this);'></i> 
            <i class='fa-solid fa-trash-can' onclick='remove(event,this);'></i> 
            <i class='fa-solid fa-file-pen' onclick='rename(event,this);'></i> 

            <ul id="fileRoot"></ul>
        </div>

        <div id="one" class="split split-horizontal" st-yle="background-color:yellow;">
            <div id="topnavi" style="height:23px;background-color:silver;width:100%;">
            <i class='fa-solid fa-folder-tree' id="btnFileView" ></i> 
            <span id="selectPath">folder /</span><span id="selectFileNm">std_run_ok.php</span>
            
            <div style="float:right">
                <i class='fa-solid fa-floppy-disk' id="btnSave" ></i> <i class='fa-solid fa-play' id="btnRun" ></i> 
            </div>
            </div>
            <div id="editor" style="background-color:green;height: calc(100% - 23px);">
                <div id="firepad-container" ></div>
            </div>
        </div>
        <div id="two"  class="split split-horizontal" st-yle="background-color:blue;">
            <div id="runview" class="split content" style="background-color:silver;"><iframe id="runView"
                style="border:0px;position:relative;border:none;height:100%;width:100%;border-width:0px;border-color:green;"
                frameborder="0"
                src="std_empty_runview.php"  
                ></iframe></div>
            <div id="consolelog" class="split content" 
            style="background-color:white;font-size:8pt;"><textarea id="logs" readonly style="border: none;width:100%;height:100%;background-color:black;color:silver;font-size:10pt;"
            ></textarea></div>
        </div>
    </div>
    <script>
    var colSplit = Split(['#file', '#one', '#two'], {
        sizes: [20, 40, 40],
        gutterSize: 8,
        minSize: [0,100,100],
        cursor: 'col-resize',
    });
    var rowSplit = Split(['#runview', '#consolelog'], {
        direction: 'vertical',
        sizes: [80, 20],
        gutterSize: 8,
        cursor: 'row-resize'
    });


    //global var
    var codeMirror;

    // Helper to get hash from end of URL or generate a random one.
    function getExampleRef() {
      var ref = firebase.database().ref();
      var hash = window.location.hash.replace(/#/g, '');
      if (hash) {
        ref = ref.child(hash);
      } else {
        ref = ref.push(); // generate unique location.
        window.location = window.location + '#' + ref.key; // add it as a hash to the URL.
      }
      if (typeof console !== 'undefined') {
        console.log('Firebase data: ', ref.toString());
      }
      return ref;
    }
    
    
    function init() {
        init_editor();
        init_log();
        init_btn();

        //파일 목록 읽기
        reload();
    }

    function init_btn(){
        $( "#btnRun" ).click(function() {
            //$('#runView').attr('src', "about:blank");
            //alert(codeMirror.getValue());

            var rootPath = "./pjt1_sb";

            path = $("#selectPath").text();
            file = $("#selectFileNm").text();

            runFullPath = rootPath + path + file;

            alog(runFullPath);

            $('#runView').attr('src', runFullPath);
        });

        $( "#btnSave" ).click(function() {
            alog("btnSave()--------------------------start");
            
            path = $("#selectPath").text();
            file = $("#selectFileNm").text();

            $.ajax({
                url: "sbfilemng/sbfilemng.php?CMD=update&PATH=" + path  + "&FILENM=" + file,
                dataType: "json",
                type: "POST",
                data: { "DATA": codeMirror.getValue() },
                privatePath: path,
                privateFileNm: file
            })
            .done(function( data ) {
                alog(data);
                if(data.RTN_CD != "200"){
                    alert(data.RTN_MSG);
                }else{
                    alert(data.RTN_MSG);
                }

            })
            .fail(function(xhr, status, errorThrown) { 
                alert(errorThrown);
            });

        });

        $( "#btnFileView" ).click(function() {
            alog("btnFileView()----------------------start");
            alog("  size = " + colSplit.getSizes()[0]);

            if(colSplit && colSplit.getSizes()[0] < 1){
                colSplit.setSizes([20,40,40]);//첫번째 배열을 minSize로 변경하기
            }else{
                colSplit.collapse(0);//첫번째 배열을 minSize로 변경하기
            }
            

            //colSplit.setSizes([0,50,50]);
        });        
    }

    function init_editor(){
        //// Initialize Firebase.
        alog("init_editor().............................start");
      //// TODO: replace with your Firebase project configuration.
      var config = {
        apiKey: "AIzaSyASCqU2V2DN_wdYYMXw0CGuNOGafIFZCPc",
            authDomain: "firepad-54e91.firebaseapp.com",
            databaseURL: "https://firepad-54e91-default-rtdb.firebaseio.com"
      };
      firebase.initializeApp(config);

      //// Get Firebase Database reference.
      var firepadRef = getExampleRef();

      //// Create CodeMirror (with line numbers and the JavaScript mode).
      codeMirror = CodeMirror(document.getElementById('firepad-container'), {
        lineNumbers: true,
        //lineWrapping: true,
        mode: 'javascript'
      });
      codeMirror.setSize("100%", "100%");

      //// Create Firepad.
      var firepad = Firepad.fromCodeMirror(firepadRef, codeMirror, {
        defaultText: '// JavaScript Editing with Firepad!\nfunction go() {\n  var message = "Hello, world.";\n  console.log(message);\n}'
        ,userId: '<?= $userId ?>'
        ,userColor: '<?= $userColor ?>'
        ,userName: '<?= $userName ?>'
      });
    }




    function init_log(){
        alog("init_log().............................start");
        var ws = new WebSocket('ws://localhost:15674/ws');
        var client = Stomp.over(ws);

        var on_connect = function() {
            alog('connected');
            
            client.subscribe("/exchange/logs", on_message);
            client.send("/exchange/logs",{"content-type":"text/plain"}, "hi");

        };
        var on_error =  function() {
            alog('error');
        };

        var on_message = function(message) {
            // called when the client receives a STOMP message from the server
            alog(message)
            if (message.body) {
                alog("got message with body : " + message.body)
            } else {
                alog("got empty message");
            }
            $("#logs").append( message.body + "\n" );

            //$("#logs").scrollTop = $("#logs").scrollHeight;

            logTa = document.getElementById("logs")
            logTa.scrollTop = logTa.scrollHeight;

        };

        client.connect('test', '1234', on_connect, on_error, '/');
    }
    
    function alog(a){
        if(console)console.log(a);
    }
    </script>
</body>
</html>