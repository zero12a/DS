<html>
    <head>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <style>
    ul {
        list-style-type: none;
        margin-left: 0px ;
        padding: 0px;
    }

    ul > li > ul, ul > li > ul > li > ul {
        padding: 0px 0px 0px 24px; 
    }
    </style>
    <script>
        function init(){
            reload();
        }

        function reload(e,t){
            $.ajax({
                url: "sbfilemng/sbfilemng.php?CMD=list&PATH=/",
                dataType: "json",
                privitePath: "/"
            })
            .done(function( data ) {
                alog(data);
                //alert(data);
                ul = $("#fileRoot");
                ul.empty();//비우기
                for(i=0;i<data.length;i++){
                    //var li=document.createElement('li');
                    if(data[i].dir == "Y"){
                        ul.append(mkFoldTag(this.privitePath, data[i].nm)); //ul_list안쪽에 li추가
                        //li.innerHtml = mkFoldTag(this.privitePath, data[i].nm);
                    }else{
                        ul.append(mkFileTag(this.privitePath, data[i].nm));
                        //li.innerHtml = mkFileTag(this.privitePath, data[i].nm);
                    }
                    //ul.appendChild(li);
                }

            })
            .fail(function(xhr, status, errorThrown) { 
                alert(errorThrown);
            });
        }

        function mkFoldTag(path,nm){
            //alog("mkFoldTag()__________________________________start");
            //alog("  끝이 뭐냐 : = " + path.slice(-1));
            if(path.slice(-1,1) != "/")path = path + "/";
            //alog("  변환함 = " + path);
            return "<li onclick='viewChildList(event, \"" + path + nm + "\" ,this);'> <i class='fa-solid fa-caret-right' onclick='fold(event,this)'></i> <i class='fa-solid fa-folder' style='margin-right:10px;'></i>" + nm + "</li>";                    
        }
        function mkFileTag(path,nm){
            if(path.slice(-1,1) != "/")path = path + "/";
            return "<li onclick='viewFile(event, \"" + path + "\", \"" + nm + "\");'> <i class='fa-solid fa-file' style='margin-left:14px;margin-right:13px;'></i>" + nm + "</li>";
        }

        function viewFile(e, path,file){
            alert("viewFile() " + path + file);
        }

        function fold(e,iObj){
            //alog("fold()................start");
            //alog(iObj);

            //caret-right 아이콘 회전
            if($(iObj).hasClass("fa-rotate-90")){
                $(iObj).removeClass("fa-rotate-90");
            }else{
                $(iObj).addClass("fa-rotate-90");
            }

            liObj = iObj.parentNode;
            //중북 클릭 이벤트방지
            var evt = e ? e:window.event;
            if (evt.stopPropagation)    evt.stopPropagation();
            if (evt.cancelBubble!=null) evt.cancelBubble = true;

            if (liObj.hasChildNodes()){
                //alog(111);
                // 그래서, 먼저 개체가 찼는 지(자식 노드가 있는 지) 검사
                var isHaveChild = false;
                var children = liObj.childNodes;
                for (var i = 0; i < children.length; i++){
                    // children[i]로 각 자식에 무언가를 함
                    // 주의: 목록은 유효해(live), 자식 추가나 제거는 목록을 바꿈
                    //alog(i + "---------------");
                    //alog(children[i])
                    if(children[i].nodeName == "UL") {
                        //alog("차일드 UL이 이미 있음");
                        //children[i].remove();

                        childUl = $(children[i]);

                        if( childUl.css("display") == "none" ){
                            childUl.show();
                        }else{
                            childUl.hide();
                        }
                    }
                }
            }else{
                //alog(222)
            }
    

        }

        function viewChildList(e, path, liObj){
            alog("viewChildList()................start");
            //중북 클릭 이벤트방지
            var evt = e ? e:window.event;
            if (evt.stopPropagation)    evt.stopPropagation();
            if (evt.cancelBubble!=null) evt.cancelBubble = true;
        
            //liObj.children().remove();
            alog(liObj.lastChild);


            if (liObj.hasChildNodes()){
                // 그래서, 먼저 개체가 찼는 지(자식 노드가 있는 지) 검사
                var isHaveChild = false;
                var children = liObj.childNodes;
                for (var i = 0; i < children.length; i++){
                    // children[i]로 각 자식에 무언가를 함
                    // 주의: 목록은 유효해(live), 자식 추가나 제거는 목록을 바꿈
                    alog(i + "---------------");
                    alog(children[i])
                    if(children[i].nodeName == "UL") {
                        isHaveChild = true;
                        alog("차일드 UL이 이미 있음");
                        children[i].remove();
                    }
                }
            }


            $.ajax({
                url: "sbfilemng/sbfilemng.php?CMD=list&PATH=" + path,
                dataType: "json",
                privitePath: path,
                privateLiObj: liObj
            })
            .done(function( data ) {
                alog(data);
                //alert(data);
                //ul을 먼저 추가
                //var ul=document.createElement('ul');
                var ul = $("<ul></ul>");
                for(i=0;i<data.length;i++){
                    //var li=document.createElement('li');

                    if(data[i].dir == "Y"){
                        //li.innerHTML = mkFoldTag(this.privitePath, data[i].nm);
                        ul.append(mkFoldTag(this.privitePath, data[i].nm));
                    }else{
                        //li.innerHTML = mkFileTag(this.privitePath, data[i].nm);
                        ul.append( mkFileTag(this.privitePath, data[i].nm));
                    }
                    //ul.appendChild(li);
                }
                //this.privateLiObj.appendChild(ul);
                alog(ul);
                //this.privateLiObj.append(ul[0].innerHTML);
                $(this.privateLiObj).append(ul);

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
<i class='fa-solid fa-arrow-rotate-right' onclick='reload(event,this);'></i>
<i class='fa-solid fa-file-circle-plus' onclick='reload(event,this);'></i> 
<i class='fa-solid fa-folder-plus' onclick='reload(event,this);'></i> 
<i class='fa-solid fa-trash-can' onclick='reload(event,this);'></i> 

<ul id="fileRoot"></ul>
</body>
</html>