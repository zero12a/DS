var myframe = myframe || {};

myframe.myselect = function (obj,cfg){
    alog("myframe.myselect()................................start");

    var self = this;// Can't use this inside the function

    //pop 레이서 생성
    alog(obj);
    this.cfg = cfg;

    //설정 관련
    if(this.cfg.data === undefined)this.cfg.data = [];
    if(this.cfg.height === undefined)this.cfg.height = "200px";
    if(this.cfg.list_height === undefined)this.cfg.list_height = "22px";
    if(this.cfg.text_selectall === undefined)this.cfg.text_selectall = "Select all";

    //오브젝트 관련
    this.obj = obj;
    this.obj_id = obj.attr('id');
    this.pop_div_id = this.obj_id + "_div";
    this.pop_selectall_div_id = this.obj_id + "_selectall_div";
    this.pop_selectall_chk_id = this.obj_id + "_selectall_chk";
    this.pop_ul_id = this.obj_id + "_ul";
    this.pop_li_id = this.obj_id + "_li";
    this.pop_chk_id = this.obj_id+ "_chk";

    var pop = '<div class="myselect" id="' + this.pop_div_id + '" style="height:' + this.cfg.height + ';position:absolute;overflow-y:auto;overflow-x:hidden;">';
    pop += '<input id="' + this.pop_selectall_chk_id + '" type="checkbox" style="float:left;"><div class="myselectSelectAllDiv" id=' + this.pop_selectall_div_id + ' style="cursor:pointer;text-decoration:underline;">' + this.cfg.text_selectall + '</div>';
    pop += '<ul id="' + this.pop_ul_id + '" class="myselectUl"></ul>';
    pop += '</div>';

    $('body').append(pop);

    //check all event
    $("#" + this.pop_selectall_chk_id).click(function(e){
        //e.preventDefault();
        alog('chkSelectAllChk.click()..........................start');
        $("input[id=" + self.pop_chk_id + "").prop('checked', $(this).prop('checked'));

        self.makeLabel();
    });

    //check all event
    $("#" + this.pop_selectall_div_id).click(function(){
        alog('chkSelectAllDiv.click()..........................start');
        chkObj = $("#" + self.pop_selectall_chk_id);
        chkObj.prop('checked', !chkObj.prop('checked'));

        $("input[id=" + self.pop_chk_id + "").prop('checked', chkObj.prop('checked'));

        self.makeLabel();
    });

    this.makeLabel = function(){
        alog("makeLabel()...........................start");

        var label = this.getLabel();
        if(label==""){
            this.obj.html(this.cfg.label);
        }else{
            this.obj.html(this.getLabel());
        }
    };

    this.getLabel = function(){
        alog("getLabel()...........................start");

        var chk1 = $('input[id=' + this.pop_chk_id + ']');

        var rtnVal = "";
    
        for(j=0;j<chk1.length;j++){
            //alog("j = " + j);
            if(chk1[j].checked){
                if(rtnVal != "")rtnVal += ", ";
                //alog(chk1[j]);
                //alog(chk1[j].parent("li"));
                //alog($(chk1[j]).parent("li"));

                rtnVal += $(chk1[j]).parent("li").text();
            }
        }
        return rtnVal;
    };

    this.loadData = function(t){
        alog("loadData()...........................start");
        //전체 선택 체크 해제
        $("#" + this.pop_selectall_chk_id).prop('checked',false);
       
        $("#" + this.pop_ul_id).empty();//데이터 비우기
        for(j=0;j<t.length;j++){
            cd = t[j].cd;
            nm = t[j].nm;
            $("#" + this.pop_ul_id).append('<li class="myclassLi" id="' + this.pop_li_id + '" style="height:' + this.cfg.list_height + ';cursor:pointer;"><input id="' + this.pop_chk_id + '" value="' + cd + '" type="checkbox">' + nm + '</li>');
        }

        //li click event
        $("li[id=" + this.pop_li_id + "]").click(function(e){
            alog('li.click()..........................start');
            //alog(e);
            //alog(e.target);
            var liObj = $(e.target);
            //alog(liObj.children());
            if(liObj.children().length > 0){
                //alog(liObj.children('input'));
                childObj = liObj.children('input')[0];

                if(childObj.checked){
                    childObj.checked = false;
                }else{
                    childObj.checked = true;
                }

                self.makeLabel();
            }
        });

        //li click event
        $("input[id=" + this.pop_chk_id + "]").click(function(e){
            alog('chk.click()..........................start');

            self.makeLabel();
        });

        //make labe
        this.makeLabel();
    };
    

    this.setValue = function(t){
        alog("setValue()...........................start");

        var chk1 = $('input[id=' + this.pop_chk_id + ']');

        var setVal = t.split(",");
    
        for(j=0;j<chk1.length;j++){
            alog("j = " + j);
            alog("chk1 value="+ chk1[j].value);
            chk1[j].checked = false;//체크해제
    
            for(t=0;t<setVal.length;t++){
                if(setVal[t] == chk1[j].value){
                    chk1[j].checked = true;
                }
            }
        }
        
        this.makeLabel(); //라벨 갱신
    };
    

    //data있으면 목록 생성
    if(cfg.data.length > 0){
        this.loadData(cfg.data);
    }

    this.getValue = function(){
        alog("getValue()...........................start");

        var chk1 = $('input[id=' + this.pop_chk_id + ']');

        var rtnVal = "";
    
        for(j=0;j<chk1.length;j++){
            alog("j = " + j);
            if(chk1[j].checked){
                if(rtnVal != "")rtnVal += ",";
                rtnVal += chk1[j].value
            }
        }
        return rtnVal;
    };



    this.click = function(){
        alog("click()...........................start");

        this.toggle();
    };

    this.toggle = function(){
        alog("obj.toggle()...........................start");


        var objoffset = this.obj.offset();
        alog("left: " + objoffset.left + ", top: " + objoffset.top + ", height: " + this.obj.height() );
    
    
        var left = objoffset.left;
        var top = objoffset.top + this.obj.height();
    
        alog("to left =" + left);
        alog("to top =" + top);
        
        alog("self.pop_div_id = " + this.pop_div_id);
        var pop = $("#" + this.pop_div_id);
        alog(pop);        
        pop.css("left",left);
        pop.css("top",top);

        if(pop.attr('data-show') == null){
            pop.attr('data-show', '');
        }else{
            pop.removeAttr('data-show');
        }        
    };

    obj.click(function() {
        alog("obj.click()...........................start");
        self.click();
    });

    //내 오브젝트들이 아니고 그외의 영역 클릭하면 토글해서 숨기기
    $(document).on('click touchend', function(e){
        alog('document.click()..........................start');
    
        
        var obj_btn = $("#" + self.obj_id);
        var obj_pop_div = $("#" + self.pop_div_id);
        var obj_pop_selectall_div = $("#" + self.pop_selectall_div_id);
        var obj_pop_selectall_chk = $("#" + self.pop_selectall_chk_id);
        var obj_pop_li = $("li[id=" + self.pop_li_id + "]");
        var obj_pop_chk = $("input[id=" + self.pop_chk_id + "]");
    
        var target = $(e.target);
    
        //alog(target);
        if(target.is(obj_btn)){
            alog(1);
        }else if(target.is(obj_pop_div)){
            alog(2);
        }else if(target.is(obj_pop_selectall_div)){
            alog(3);
        }else if(target.is(obj_pop_selectall_chk)){
            alog(4);
        }else if(target.is(obj_pop_li)){
            alog(5);
        }else if(target.is(obj_pop_chk)){
            alog(6);
        }else{
            alog(7);
            for(j=0;j<obj_pop_li.length;j++){
                //alog("j = " + j);
                if(target.is(obj_pop_li[j])){
                    //alog(chk1[j].checked);
                    return; 
                }
            }
            alog(8);
            for(i=0;i<obj_pop_chk.length;i++){
                //alog("i = " + i);
                if(target.is(obj_pop_chk[i]))return; 
            }
    
            alog(9);

            var pop = $("#" + self.pop_div_id);
            if(pop.attr('data-show') != null) pop.removeAttr('data-show'); //숨기기
        }
    ;})  
    

}