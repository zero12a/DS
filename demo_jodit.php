<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>jodit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.4.18/jodit.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.4.18/jodit.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    

</head>
<body onload="bodyInit();">
1
<textarea id="editor" name="editor"></textarea>

2
<input type=button onclick="alert(editor.value);" value="getValue">
<input type=button onclick="editor.value='<b>SetValue</b>';" value="setValue">
<input type=button onclick="getHeight();" value="getHeight">

<script>
function getHeight(){
    alog("getHeight()........................start");
    var editObj = $( ".jodit-workplace:eq(0)" );

    var oldHeight = parseInt(editObj.css("height"));
    alog("oldHeight=" + oldHeight);

    var newHeight = oldHeight - 2;
    alog("newHeight=" + newHeight);

    alog( editObj.css("height",newHeight) );
}
function bodyInit(){
    alog("bodyInit()........................start");
    alog($( ".jodit-workplace:eq(0)" ));
    var editObj = $( ".jodit-workplace:eq(0)" );

    var oldHeight = parseInt(editObj.css("height"));
    alog("oldHeight=" + oldHeight);
    var newHeight = oldHeight - 2;
    alog("newHeight=" + newHeight);

    //editObj.css("height",newHeight);
    //.css( "border", "3px solid red" )
}

$('#editor').each(function () {
    var editor = new Jodit(this,{
        enableDragAndDropFileToEditor: true,
        height: 300, // 미정시 auto가 되고, auto로 해야 하단 푸터 보더라인이 정상 노출됨. 제작자의 이슈에 해당 이슈 글 작성함 ( 2020.8.10에 )
        buttons: [ 'undo', 'redo', '|','bold', 'italic', '|', 'ul', 'ol', '|', 'font', 'fontsize', 'brush', 'paragraph', '|','image', 'video', 'table', 'link', '|', 'left', 'center', 'right', 'justify', '|',  'hr', 'eraser', 'fullsize','source'],
        uploader: {
            url: 'demo_jodit_upload.php?action=fileUpload',
            format: 'json',
            imagesExtensions: ["jpg", "png", "jpeg", "gif"],
            method: "POST",
            error: function(e){
                alog("error...............start");
                alog(e);
                this.j.e.fire("errorMessage",e.message,"error",4e3);
            }
        },
        events: {
            afterInit: function (editorT) {
                alog("jodit afterInit........................start");
            }
            ,createEditor: function (editorT){
                alog("jodit createEditor........................start");
            }
            ,ready: function (editorT){
                alog("jodit ready........................start");
            }
            ,init: function (editorT){
                alog("jodit init........................start");
            }
        }        
    });
    editor.value = '<p>start</p>';

    editor.events.on('focus', function (data) {
        alog("jodit focus");
    });    
    editor.events.on('resize', function (data) {
        alog("jodit resize");
    });
    editor.events.on('change.view', function (data) {
        alog("jodit change.view");
    });
});




function alog(t){if(console)console.log(t);}
</script>

</body>
</html>
