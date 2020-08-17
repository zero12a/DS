<?php
//PGMID : PISQLR
//PGMNM : PISQLR
header("Content-Type: text/html; charset=UTF-8"); //HTML

//설정 함수 읽기
$CFG = require_once '../../common/include/incConfig.php';

//default lib Autoload
require_once($CFG["CFG_LIBS_VENDOR"]);

//LIBS
require_once('../../common/include/incUtil.php');//CG UTIL
require_once('../../common/include/incRequest.php');//CG REQUEST
require_once('../../common/include/incDB.php');//CG DB
require_once('../../common/include/incSec.php');//CG SEC
require_once('../../common/include/incAuth.php');//CG AUTH
require_once('../../common/include/incUser.php');//CG USER

//인증 게이트웨이
require_once('../../common/include/incLoginOauthGateway.php');//CG USER
?><!doctype html>
<html>
<head>
<title>PISQLR</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta http-equiv="Context-Type" context="text/html;charset=UTF-8" />
<!--CSS/JS 불러오기-->
<!--JS 불러오기-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/feather.min.js" type="text/javascript" charset="UTF-8"></script> <!--FEATHER ICON JS-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-3.4.1.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY CORE-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-ui.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY UI-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/cleave.min.js" type="text/javascript" charset="UTF-8"></script> <!--CLEAVE JS-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery.multiselect.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY DROPDOWN-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/select2.min.js" type="text/javascript" charset="UTF-8"></script> <!--SELECT2 JS-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/toastr.min.js" type="text/javascript" charset="UTF-8"></script> <!--TOASTR JS-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jqwidgets/jqx-all.js" type="text/javascript" charset="UTF-8"></script> <!--JQXGRID LIB JS-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/json2.min.js" type="text/javascript" charset="UTF-8"></script> <!--JQUERY JSON-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/lodash.min.js" type="text/javascript" charset="UTF-8"></script> <!--LOADASH.JS-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/hashmap.js" type="text/javascript" charset="UTF-8"></script> <!--HASHMAP-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/dhtmlxSuite/codebase/dhtmlx.js" type="text/javascript" charset="UTF-8"></script> <!--DHTMLX CORE-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/Chart.min.js" type="text/javascript" charset="UTF-8"></script> <!--Chart.js-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/signature_pad.min.js" type="text/javascript" charset="UTF-8"></script> <!--SIGNATURE PAD-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/moment.min.js" type="text/javascript" charset="UTF-8"></script> <!--Moment Date-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/webix/codebase/webix.js" type="text/javascript" charset="UTF-8"></script> <!--WEBIX JS-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jodit.min.js" type="text/javascript" charset="UTF-8"></script> <!--JODIT JS-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/lib/codemirror.js" type="text/javascript" charset="UTF-8"></script> <!--CODE MIRROR1-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/mode/sql/sql.js" type="text/javascript" charset="UTF-8"></script> <!--CODE MIRROR2-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/addon/selection/active-line.js" type="text/javascript" charset="UTF-8"></script> <!--CODE MIRROR3-->
<script src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/xlsx.full.min.js" type="text/javascript" charset="UTF-8"></script> <!--EXCEL import JS-->

<!--CSS 불러오기-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/select2.min.css" type="text/css" charset="UTF-8"><!--SELECT2 CSS-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/toastr.min.css" type="text/css" charset="UTF-8"><!--TOASTR CSS-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jqwidgets/styles/jqx.base.min.css" type="text/css" charset="UTF-8"><!--JQXGRID LIB CSS-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery.multiselect.css" type="text/css" charset="UTF-8"><!--JQUERY DROPDOWN CSS-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/dhtmlxSuite/codebase/dhtmlx.css" type="text/css" charset="UTF-8"><!--DHTMLX CORE-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jquery/jquery-ui.min.css" type="text/css" charset="UTF-8"><!--JQUERY UI-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/webix/codebase/skins/mini.min.css" type="text/css" charset="UTF-8"><!--WEBIX CSS-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/jodit.min.css" type="text/css" charset="UTF-8"><!--JODIT CSS-->
<link rel="stylesheet" href="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/codemirror/lib/codemirror.css" type="text/css" charset="UTF-8"><!--CODE MIRROR CSS-->
<!--공통 js/css-->
<script>
var CFG_CGWEB_URL = "<?=$CFG["CFG_CGWEB_URL"]?>";  // 형식 http://url:port/
var CFG_URL_LIBS_ROOT = "<?=$CFG["CFG_URL_LIBS_ROOT"]?>";  // 형식 http://url:port/
var CFG_URL_CODE_API = "<?=$CFG["CFG_URL_CODE_API"]?>"; // /d.s/CG/codeapiController?
</script>
<script src="/common/chartjs_util.js"></script>
<script src="/common/common.js?<?=getRndVal(10)?>"></script>
<script type="text/javascript" src="/common/common_dhtmlx.js"></script>
<script type="text/javascript" src="/common/common_jqwidgets.js"></script>
<script type="text/javascript" src="/common/common_webix.js"></script>

<link rel="stylesheet" href="/common/common_jqwidgets.css">
<link rel="stylesheet" href="/common/common_webix.css">
<link rel="stylesheet" href="/common/common.css?<?=getRndVal(10)?>" type="text/css" charset="UTF-8">

<script src="pisqlr.js?<?=getRndVal(10)?>"></script>
<script>
	//팝업창인 경우 오프너에게서 파라미터 받기
    var grpId = "<?=getFilter(reqPostString("GRPID",20),"SAFEECHO","")?>";
    var rowId = "<?=getFilter(reqPostString("ROWID",30),"SAFEECHO","")?>";
    var colId = "<?=getFilter(reqPostString("COLID",30),"SAFEECHO","")?>";
    var btnNm = "<?=getFilter(reqPostString("BTNNM",30),"SAFEECHO","")?>";
</script>
</head>
<body onload="initBody();">

<div id="BODY_BOX" class="BODY_BOX"><!--그룹별 IO출력-->
	<!--
	#####################################################
	## 컨디션  - START G.GRPID : G1-
	#####################################################
	-->
 	<div class="GRP_OBJECT" style="width:100%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
            <div class="GRP_INNER" style="height:74px;">	
		
	  		<div style="width:0px;height:0px;overflow: hidden"><form id="condition" onsubmit="return false;"></div>
		<div class="CONDITION_LABELGRP">
			<div class="CONDITION_LABEL"  style="">
				<b>* PISQLR</b>	
				<!--popup--><a href="?" target="_blank"><img src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>img/popup.png" height=10 align=absmiddle border=0></a>
				<!--reload--><a href="javascript:location.reload();"><img src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>img/reload.png" width=11 height=10 align=absmiddle border=0></a>
			</div>	
			<div class="CONDITION_LABELBTN">
				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G1_USERDEF" value="사용자정의" onclick="G1_USERDEF(uuidv4());">
				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G1_SEARCHALL" value="조회(전체)" onclick="G1_SEARCHALL(uuidv4());">
				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G1_SAVE" value="저장" onclick="G1_SAVE(uuidv4());">
				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G1_RESET" value="입력 초기화" onclick="G1_RESET(uuidv4());">
			</div>
		</div>
		<div style="height:32px;border-radius:3px;-moz-border-radius: 3px;" class="CONDITION_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
		<!--컨디션 IO리스트-->
					<!-- PGMSEQ -->
					<div class="CON_OBJECT" style="display:none">
						<input type="text" name="G1-PGMSEQ" value="<?=getFilter(reqGetString("PGMSEQ",30),"SAFEECHO","")?>" id="G1-PGMSEQ">
					</div>
					<!-- PJTSEQ -->
					<div class="CON_OBJECT" style="display:none">
						<input type="text" name="G1-PJTSEQ" value="<?=getFilter(reqGetString("PJTSEQ",20),"SAFEECHO","")?>" id="G1-PJTSEQ">
					</div>
				<!--I.COLID : SQLSEQ-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						SQLSEQ
					</div>
					<!-- style="width:50px;"-->
					<div class="CON_OBJECT">
						<!--SQLSEQ오브젝트출력-->
						<input type="text" name="G1-SQLSEQ" value="<?=getFilter(reqPostString("SQLSEQ",30),"SAFEECHO","")?>" id="G1-SQLSEQ" style="width:50px;" class="">
					</div>
				</div>
					<!-- SVCSEQ -->
					<div class="CON_OBJECT" style="display:none">
						<input type="text" name="G1-SVCSEQ" value="<?=getFilter(reqGetString("SVCSEQ",30),"SAFEECHO","")?>" id="G1-SVCSEQ">
					</div>
			</div><!-- is_br_tag end -->
		</div>
		<div style="width:0px;height:0px;overflow: hidden"></form></div>    
		</div></div>
	</div>
	<!--
	#####################################################
	## 그리드 - START
	#####################################################
	-->
    <div class="GRP_OBJECT" style="width:50%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
		<div  class="GRID_LABELGRP">
			<div class="GRID_LABELGRP_GAP">	<!--그리드만 필요-->
  			<div id="div_gridG2_GRID_LABEL"class="GRID_LABEL" >
	  				*       
			</div>
			<div id="div_gridG2_GRID_LABELBTN" class="GRID_LABELBTN"  style="">
				<span id="spanG2Cnt" name="그리드 ROW 갯수">N</span>
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_USERDEF" value="사용자정의" onclick="G2_USERDEF(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_RELOAD" value="새로고침" onclick="G2_RELOAD(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_EXCEL" value="엑셀다운로드" onclick="G2_EXCEL(uuidv4());">
			<input type="button" class="btn btn-secondary  btn-sm" name="BTN_G2_CHKSAVE" value="선택저장" onclick="G2_CHKSAVE(uuidv4());">
			</div>
			</div><!--GAP-->
		</div>
		<div  class="GRID_OBJECT"  style="">
<!--
data-toggle : 이 옵션이 있어야 데이터 load 처리시 동적으로 정상 처리됨
-->
<table id="btG2"
			data-toggle="table"
			data-height="457"
			data-virtual-scroll="true"
			data-click-to-select="false"
			data-resizable="true"
			class="table table-bordered table-striped"
			data-id-field="SQLRSEQ"			>
			<thead>
				<tr>
					<th
						data-field="ROWID"
						data-sortable="false"
						data-visible="false"
						data-align="right"
						data-width="100"
						data-width-unit="px"
						>ROWID</th>
					<th
						data-field="SQLRSEQ"
						data-width="70" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>SQLRSEQ
					</th>
					<th
						data-field="SVCSEQ"
						data-width="70" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>SVCSEQ
					</th>
					<th
						data-field="PJTSEQ"
						data-width="100" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>PJTSEQ
					</th>
					<th
						data-field="PGMSEQ"
						data-width="100" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>PGMSEQ
					</th>
					<th
						data-field="SQLSEQ"
						data-width="50" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>SQLSEQ
					</th>
					<th
						data-field="ORD"
						data-width="30" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>ORD
					</th>
					<th
						data-field="ADDDT"
						data-width="60" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>ADDDT
					</th>
					<th
						data-field="MODDT"
						data-width="60" 
						data-align="left"
						data-width-unit="px"
						data-sortable="true" 
						data-visible="true"
						data-halign="center"
					>MODDT
					</th>
					</tr>            
				</thead>
        </table>
		</div>
		</div>
	</div>
	<!--
	#####################################################
	## 그리드 - END
	#####################################################
	-->
	<!--
	#####################################################
	## 폼뷰  - START
	#####################################################
	-->
    <div class="GRP_OBJECT" style="width:50%;">
        <div class="GRP_GAP"><!--흰색 바깥 여백-->
            <div class="GRP_INNER" style="height:494px;">
				
			<div sty_le="width:0px;height:0px;overflow: hidden">
				<form id="formviewG3" name="formviewG3" method="post" enctype="multipart/form-data"  onsubmit="return false;">
				<input type="hidden" name="G3-CTLCUD"  id="G3-CTLCUD" value="">
			</div>	
		<div class="FORMVIEW_LABELGRP">
			<div class="FORMVIEW_LABEL"  style="">
				* 
			</div>
			<div class="FORMVIEW_LABELBTN"  style="">
				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G3_USERDEF" value="사용자정의" onclick="G3_USERDEF(uuidv4());">
				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G3_SAVE" value="저장" onclick="G3_SAVE(uuidv4());">
				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G3_RELOAD" value="새로고침" onclick="G3_RELOAD(uuidv4());">
				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G3_NEW" value="신규" onclick="G3_NEW(uuidv4());">
				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G3_MODIFY" value="수정" onclick="G3_MODIFY(uuidv4());">
				<input type="button" class="btn btn-secondary  btn-sm"  name="BTN_G3_DELETE" value="삭제" onclick="G3_DELETE(uuidv4());">
			</div>
		</div>
		<div style="height:452px;" class="FORMVIEW_OBJECT">
			<DIV class="CON_LINE" is_br_tag>
			<!--OBJECT LIST PRINT.-->
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
				<!--I.COLID : SQLRSEQ-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						SQLRSEQ
					</div>
					<!-- style="width:70px;"-->
					<div class="CON_OBJECT">
						<!--SQLRSEQ오브젝트출력-->
						<input type="text" name="G3-SQLRSEQ" value="" id="G3-SQLRSEQ" style="width:70px;" class="">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
				<!--I.COLID : SVCSEQ-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						SVCSEQ
					</div>
					<!-- style="width:70px;"-->
					<div class="CON_OBJECT">
						<!--SVCSEQ오브젝트출력-->
						<input type="text" name="G3-SVCSEQ" value="" id="G3-SVCSEQ" style="width:70px;" class="">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
				<!--I.COLID : PJTSEQ-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						PJTSEQ
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
						<!--PJTSEQ오브젝트출력-->
						<input type="text" name="G3-PJTSEQ" value="" id="G3-PJTSEQ" style="width:100px;" class="">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
				<!--I.COLID : PGMSEQ-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						PGMSEQ
					</div>
					<!-- style="width:100px;"-->
					<div class="CON_OBJECT">
						<!--PGMSEQ오브젝트출력-->
						<input type="text" name="G3-PGMSEQ" value="" id="G3-PGMSEQ" style="width:100px;" class="">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
				<!--I.COLID : SQLSEQ-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						SQLSEQ
					</div>
					<!-- style="width:50px;"-->
					<div class="CON_OBJECT">
						<!--SQLSEQ오브젝트출력-->
						<input type="text" name="G3-SQLSEQ" value="" id="G3-SQLSEQ" style="width:50px;" class="">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
				<!--I.COLID : ORD-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">
						ORD
					</div>
					<!-- style="width:30px;"-->
					<div class="CON_OBJECT">
						<!--ORD오브젝트출력-->
						<input type="text" name="G3-ORD" value="" id="G3-ORD" style="width:30px;" class="">
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
				<!--I.COLID : ADDDT-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">	
					ADDDT	
					</div>
					<!-- style="width:60;"-->
					<div class="CON_OBJECT">
						<div name="G3-ADDDT" id="G3-ADDDT" style="background-color:white; width:60px;height:22px;line-height:22px;vertical-align:middle;padding:0px 0px 0px 3px"></div>
					</div>
				</div>
			</DIV><!--is_br_tab end-->
			<DIV class="OBJ_BR"></DIV>
			<DIV class="CON_LINE" is_br_tag>
				<!--I.COLID : MODDT-->
				<div class="CON_OBJGRP" style="">
					<div class="CON_LABEL" style="width:100px;text-align:left;">	
					MODDT	
					</div>
					<!-- style="width:60;"-->
					<div class="CON_OBJECT">
						<div name="G3-MODDT" id="G3-MODDT" style="background-color:white; width:60px;height:22px;line-height:22px;vertical-align:middle;padding:0px 0px 0px 3px"></div>
					</div>
				</div>
			</DIV><!--is_br_tab end-->
		</div>
		<div style="width:0px;height:0px;overflow: hidden"></form></div>    
		</div>
		</div>
	</div>
	<!--
	#####################################################
	## 폼뷰 - END
	#####################################################
	-->
<div style="width:0px;height:0px;overflow: hidden">
	<form name="excelDownForm" id="excelDownForm">
	<input type="hidden" name="DATA_HEADERS" id="DATA_HEADERS">
	<input type="hidden" name="DATA_WIDTHS" id="DATA_WIDTHS">
	<input type="hidden" name="DATA_ROWS" id="DATA_ROWS">
	</form>
</div>
<div style="width:0px;height:0px;overflow: hidden">
	<form name="popupForm" id="popupForm">
	<input type="text" name="GRPID" id="GRPID">
	<input type="text" name="ROWID" id="ROWID">	
	<input type="text" name="COLID" id="COLID">
	<input type="text" name="BTNNM" id="BTNNM">
	</form>
</div>
</div>



</body>
</html>
