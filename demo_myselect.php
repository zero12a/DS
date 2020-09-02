<html>
<head>
<title> myselect </title>

<!-- Development version -->
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<style>
  #tooltip {
    background-color: #333;
    color: white;
    padding: 5px 10px;
    border-radius: 4px;
    font-size: 13px;

    display: none;
  }

    #tooltip[data-show] {
        display: block;
    }

</style>
</head>
<body>
<div style="width:500px;height:100px;background-color:gray">


</div>

<div style="width:500px;height:100px;background-color:silver">


</div>
<div style="width:500px;height:100px;background-color:gray">
<input type="button" id="btnLoadData" value="loadData">
<input type="button" id="btnSetValue" value="setValue">
<input type="button" id="btnGetValue" value="getValue">
    

</div>
<div style="width:500px;height:100px;background-color:silver">

    <div id="button" aria-describedby="tooltip" onclick="toggle()" style="cursor:pointer;background-color:white;width:150px;">I'm a button</div>
    <div id="tooltip" role="tooltip">
        <ul id="ul3" style="list-style-type: none; margin: 0;  padding: 0; ">
           
        </ul>
    </div>  
</div>


</body>

<script>
var button = document.querySelector('#button');
var tooltip = document.querySelector('#tooltip');


// Pass the button, the tooltip, and some options, and Popper will do the
// magic positioning for you:
Popper.createPopper(button, tooltip, {
    modifiers: [
        {
        name: 'offset',
        options: {
            offset: [-button.offsetWidth/2,0]
        }
        },
    ]
});

$( "#btnLoadData" ).click(function() {
    $("#ul3").empty();
    $("#ul3").append('<li id="liSelectAll" style="cursor:pointer;"><input id="chkSelectAll" type="checkbox">Select all</li>');
    for(j=0;j<10;j++){
        $("#ul3").append('<li id="li2" style="cursor:pointer;"><input id="chk1" type="checkbox">I m a tooltip' + j + '</li>');
    }

    $("#chkSelectAll").click(function(){
        alog('chkSelectAll.click()..........................start');
        $("input[id=chk1]").prop('checked', $(this).prop('checked'));
    });

});

$(document).on('click touchend', function(e){
    alog('document.click()..........................start');

    var liSelectAll = $('#liSelectAll');
    var chkSelectAll = $('#chkSelectAll');
    var chk1 = $('input[id=chk1]');
    var li2 = $('li[id=li2]');
    // alog(chkSelectAll);
    //alog(chk1.length);
    //alog(li2.length);

    var target = $(e.target);
    //alog(target);
    if(target.is(tooltip)){
        //alog(1);
    }else if(target.is(button)){
        //alog(2);
    }else if(target.is(liSelectAll)){
        //alog(3);
        //alog(chkSelectAll.prop('checked'));
        if(chkSelectAll.prop('checked')){
            chkSelectAll.prop('checked',false);
        }else{
            chkSelectAll.prop('checked',true);
        }
        $("input[id=chk1]").prop('checked', chkSelectAll.prop('checked'));
        
    }else if(target.is(chkSelectAll)){
        //alog(4);
    }else{
        //alog(5);
        for(j=0;j<chk1.length;j++){
            //alog("j = " + j);
            if(target.is(chk1[j])){
                //alog(chk1[j].checked);
                return; 
            }
        }
        //alog(6);
        for(i=0;i<li2.length;i++){
            //alog("i = " + i);
            if(target.is(li2[i])){
                //alog(chk1[i].checked);
                if(chk1[i].checked){
                    chk1[i].checked = false;
                }else{
                    chk1[i].checked = true;
                }
                return; 
            }
        }

        //alog(7);
        if(tooltip.getAttribute('data-show') != null){
            toggle();
        }
    }
;})  

function toggle() {
    alog(tooltip.getAttribute('data-show'));

    if(tooltip.getAttribute('data-show') == null){
        tooltip.setAttribute('data-show', '');
    }else{
        tooltip.removeAttribute('data-show');
    }
}


function alog(t){
    if(console)console.log(t);
}
</script>

</html>

