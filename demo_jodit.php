<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>jodit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.4.18/jodit.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.4.18/jodit.min.js"></script>


</head>
<body>
1
<textarea id="editor" name="editor"></textarea>

2
<input type=button onclick="alert(editor.value);" value="getValue">
<input type=button onclick="editor.value='<b>SetValue</b>';" value="setValue">

<script>
var editor = new Jodit(document.getElementById('editor'),{
    enableDragAndDropFileToEditor: true,
    //height: 300, // 미정시 auto가 되고, auto로 해야 하단 푸터 보더라인이 정상 노출됨.
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
});
editor.value = '<p>start</p>';

function alog(t){if(console)console.log(t);}
</script>
</body>
</html>
