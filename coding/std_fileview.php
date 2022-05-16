<html>
    <head>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script>
        function init(){
            $.ajax({
                url: "sbfilemng/sbfilemng.php?CMD=list&PATH=/",
                dataType: "json",
                privitePath: "/"
            })
            .done(function( data ) {
                alog(data);
                //alert(data);
                ul = $("#fileRoot");
                for(i=0;i<data.length;i++){
                    if(data[i].dir == "Y"){
                        ul.append("<li onclick='viewChildList(\"" + this.privitePath + data[i].nm + "\" ,this);'>[]" + data[i].nm + "</li>"); //ul_list안쪽에 li추가
                    }else{
                        ul.append("<li onclick='viewFile(\"" + this.privitePath + "\", \"" + data[i].nm + "\");'>" + data[i].nm + "</li>"); //ul_list안쪽에 li추가
                    }
                }

            })
            .fail(function(xhr, status, errorThrown) { 
                alert(errorThrown);
            });
        }
        function viewFile(path,file){
            alert("viewFile() " + path + file);
        }

        function viewChildList(path, liObj){
            //liObj.children().remove();
            alog(liObj.lastChild);

            if(liObj.lastChild) {
                alog("liObj - remove");
                alog(liObj.lastChild);
                if(liObj.lastChild.nodeName == "UL"){
                    liObj.removeChild(liObj.firstChild);
                }else{
                    alog("text node는 삭제하지 않음");
                }

            }
            //return;

            $.ajax({
                url: "sbfilemng/sbfilemng.php?CMD=list&PATH=" + path,
                dataType: "json",
                privitePath: path
            })
            .done(function( data ) {
                alog(data);
                //alert(data);
                //ul을 먼저 추가
                var ul=document.createElement('ul');
                for(i=0;i<data.length;i++){
                    var li=document.createElement('li');

                    if(data[i].dir == "Y"){
                        li.innerHTML = "<li onclick='viewChildList(\"" + this.privitePath + data[i].nm + "\" ,this);'>[]" + data[i].nm + "</li>"; //ul_list안쪽에 li추가
                    }else{
                        li.innerHTML = "<li onclick='viewFile(\"" + this.privitePath + "\", \"" + data[i].nm + "\");'>" + data[i].nm + "</li>"; //ul_list안쪽에 li추가
                    }
                    ul.appendChild(li);
                }
                liObj.appendChild(ul);

            })
            .fail(function(xhr, status, errorThrown) { 
                alert(errorThrown);
            });
        }
        
        function alog(t){
            if(console)console.log(t);
        }
    </script>
    </head>
<body onload="init();">
file viewer
<input type="button" value='reload'><input type="button" value="add file"><input type="button" value="add folder">
        <input type="button" value="delete">
        <ul id="fileRoot"></ul>
</body>
</html>