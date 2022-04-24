<?php

//echo $_GET["list_seq"];

$userId = $_GET["userid"];
$userColor = $_GET["usercolor"];
$userName = $_GET["username"];

?>
<html>
<head>
    <title>std_detail</title>

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

    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/split.js/1.6.0/split.min.js"></script>

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
        overflow-y: auto;
        overflow-x: hidden;
    }
    
    .gutter {
        background-color: transparent;
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

    </style>
</head>
<body onload="init();">
    <div class="split">
        <div id="one" class="split split-horizontal" style="background-color:yellow;">
            <div id="topnavi" style="height:30px;background-color:silver;width:100%;">
                top navi
            </div>
            <div id="editor" style="background-color:green;height: calc(100% - 30px);">
                <div id="firepad-container" ></div>
            </div>
        </div>
        <div id="two"  class="split split-horizontal" style="background-color:blue;">
            <div id="runview" class="split content" style="background-color:silver;">
                run view
            </div>
            <div id="consolelog" class="split content" style="background-color:white;">
                console log
            </div>
        </div>
    </div>
    <script>
    Split(['#one', '#two'], {
        sizes: [50, 50],
        gutterSize: 8,
        cursor: 'col-resize',
    });
    Split(['#runview', '#consolelog'], {
        direction: 'vertical',
        sizes: [80, 20],
        gutterSize: 8,
        cursor: 'row-resize'
    });



    function init() {
      //// Initialize Firebase.
      alog("init().............................start");
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
      var codeMirror = CodeMirror(document.getElementById('firepad-container'), {
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
    
    
    function alog(a){
        if(console)console.log(a);
    }
    </script>
</body>
</html>