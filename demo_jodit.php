<html>
<head>
    <title>jodit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.4.15/jodit.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.4.15/jodit.min.js"></script>
</head>
<body>
1
<textarea id="editor" name="editor"></textarea>
2

<script>
var editor = new Jodit('#editor',{
    enableDragAndDropFileToEditor: true,
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
