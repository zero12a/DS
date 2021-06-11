<?php
header("Content-Type: text/html; charset=UTF-8");

//redis에 모두 넣기
//require_once "/data/www/lib/php/vendor/autoload.php";
$CFG = require_once("../common/include/incConfig.php");

?>
<!DOCTYPE html>
<html>
<head>
    <title>vuetify baseline</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

  <!--css-->
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">

  <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">

  <!--js-->
  <script type="text/javascript" src="<?=$CFG["CFG_URL_LIBS_ROOT"]?>lib/lodash.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
  <script
			  src="https://code.jquery.com/jquery-3.5.1.min.js"
			  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
			  crossorigin="anonymous"></script>

    <style>
    /*
    우측 스크롤 문제 생기는거 해결
    https://stackoverflow.com/questions/46522331/scroll-bar-in-the-main-section-of-a-v-app
    */
    html{
      overflow-y: hidden;
    }
  </style>

</head>

<body>

<div id="app">

    <v-app id="inspire">
      <v-navigation-drawer
        v-model="drawer"
        app
        clipped
      >
        <v-list dense>

        
          <v-subheader>Menus</v-subheader>

          <!--그냥 메뉴-->
          <div v-for="m in myMenu" :key="m.id">
          
          <v-list-item v-if="m.submenus.length == 0" link  @click="addTab(m.id,m.nm,m.url);">
            <v-list-item-icon>
             <v-icon>{{m.icon}}</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title>{{m.nm}}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>


          <!--하위메뉴 있는 메뉴폴더 -->
          <v-list-group v-else no-action>
            <template v-slot:activator  @click="addTab(m.id,m.nm,m.url);">
              <v-list-item-icon>
                <v-icon>{{m.icon}}</v-icon>
              </v-list-item-icon>
              <v-list-item-content>
                <v-list-item-title>{{m.nm}}</v-list-item-title>
              </v-list-item-content>
            </template>
            <v-list-item v-for="s in m.submenus" :key="s.id" link   @click="addTab(s.id,s.nm,s.url);">
              <v-list-item-content>
                <v-list-item-title>{{s.nm}}</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-group>

          </div>

        </v-list>
      </v-navigation-drawer>
  
      <v-app-bar
        app
        clipped-left
      >
        <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        <v-toolbar-title>Application</v-toolbar-title>

        <v-spacer></v-spacer>

        <v-switch 
        class="pt-5"
        v-model="dark_theme" @change="changeTheme" label="Dark theme"></v-switch>
        <v-btn icon>
          <v-badge
            color="green"
            content="6"
            overlap
          >
          <v-icon>mdi-bell</v-icon>
        </v-btn>        
        <v-btn icon>
          <v-icon>mdi-location-exit</v-icon>
        </v-btn>
      </v-app-bar>
  
      <v-main>
        <v-container
          class="pa-0 fill-height"
          fluid
        >

        <v-layout
          justify-center
          align-center 
          class=""
        >
          <v-flex id="vflex" text-xs-center fill-height>
            <v-tabs
                dark
                background-color="teal darken-3"
                show-arrows
                v-on:change="changeTabs"
                v-model="active_tab"
                next-icon="mdi-arrow-right-bold-box-outline"
                prev-icon="mdi-arrow-left-bold-box-outline"
            >
                <v-tabs-slider color="teal lighten-3"></v-tabs-slider>

                <v-tab
                v-for="i in mytab"
                :key="i.id"
                class="pr-0"
                @click="changeTab(i.id)"
                >
                {{ i.name }}&nbsp;<v-btn icon small @click.prevent="closeTab(i.id)"><v-icon small>fas fa-times</v-icon></v-btn>
                </v-tab>
            </v-tabs>
        
            <v-tabs-items v-model="active_tab" style="height:calc(100% - 24px);">
                <v-tab-item
                v-for="i in mytab"
                :key="i.id"  style="height:100%;"
                :transition="false" :reverse-transition="false"
                ><iframe width="100%" :src="i.url" 
                style="border:0px;position:relative;border:none;height:100%;width:100%;border-width:0px;border-color:silver;"
                frameborder="0"></iframe>
                </v-tab-item>
            </v-tabs-items>


            </v-flex>
        </v-layout>
        
        </v-container>
      </v-main>
    </v-app>

</div>

<script>


new Vue({
  el: '#app',
  vuetify: new Vuetify(),
    props: {
        source: String,
    },

    data: () => ({
        drawer: null,
        active_tab : null, //0, 1, 2, 3 ~ 숫자 인덱스 순서임
        mytab : [],
        myMenu : [],
        dark_theme : false
    }),

    created () {
        this.$vuetify.theme.dark = this.dark_theme
    },
    mounted () {
      alog("vue.mounted()...............................start");
      this.loadTabs();
    },
    methods:{
        changeTheme: function(){
          alog("methods.changeTheme()...............................start");
          this.$vuetify.theme.dark = this.dark_theme;
          return !this.dark_theme;
        },
        loadTabs: function(){
          this.myMenu = 
            [
              {id:"tab1", nm:"nm1", url:"demo_webix.php", icon:"mdi-home", submenus: [] }
              ,{id:"tab2", nm:"nm2", url:"demo_webixtab.php", icon:"mdi-cloud", submenus: [] }
              ,{id:"tab3", nm:"nm3", url:"demo_jqwidgets.php", icon:"mdi-view-dashboard",
                submenus: [
                  {id:"tab4", nm:"nm4", url:"demo_webix.php"}
                  ,{id:"tab5", nm:"nm5", url:"demo_webixtab.php"}
                ]
              }
              ,{id:"tab6", nm:"nm6", url:"demo_jqwidgets.php", icon:"mdi-view-dashboard",
                submenus: [
                  {id:"tab7", nm:"nm7", url:"demo_webix.php"}
                  ,{id:"tab8", nm:"nm8", url:"demo_webixtab.php"}
                ]
              }
              ,{id:"tab9", nm:"nm9", url:"demo_webixtab.php", icon:"mdi-cloud", submenus: [] }
              
            ];
        },
        changeTabs: function(tHref){
            alog("changeTabs().........................start");
            alog(this);
            //alog("  tHref=" + tHref);

            //alert(tmp);
        },          
        addTab: function(tId,tNm,tUrl){
            alog("addTab().........................start");

            //이미 추가된 메뉴이면 활성화 시키기
            findIndex = _.findIndex(this.mytab, ['id', tId]);
            //alert(findIndex);
            if(findIndex >= 0){
                this.active_tab = findIndex;
            }else{
                this.mytab.push({id: tId, name: tNm, url:tUrl});
                this.active_tab = this.mytab.length-1;
            }


        }, 
        changeTab: function(tId){
            alog("changeTab().........................start");

            //alert(tmp);
        },
        closeTab: function(tId){
            alog("closeTab().........................start");
            var closeTabIdx=null;
            for(t=0;t<this.mytab.length;t++){
                //alog(this.items[t]);
                if(this.mytab[t].id == tId){
                    closeTabIdx = t;
                }
            }
            alog("closeTabIdx = " + closeTabIdx);

            alog("active_tab = " + this.active_tab);
            tabMoveBefore = 0;
            tabMoveAfter = 0;
            if(this.active_tab == closeTabIdx){
                if(this.active_tab  == this.mytab.length-1 && this.mytab.length>1){
                    //마지막 액티브탭을 닫으면 별도 처리 없어도 자동으로 1감소
                }else{
                    //액티브탭이랑 클로즈탭이 같으면 포커스 잃고 맨마지막으로 가는데, 그거 보다는 1작아 지는게 나음
                    tabMoveAfter--;
                }
            }
            if(this.active_tab > closeTabIdx){
                //잘되기 때문에 처리해줄게 없음
                if(this.active_tab-1 == closeTabIdx){
                    //포커스 잃고 맨 마지막 탭으로 이동하기 때문에 그거 보다 나은 조치(아무처리 안함)
                }else{
                    //가만 두면 앱티브탭이 그보다 1큰 탭으로 교체되기 때문에 1줄여주기
                    tabMoveAfter--;
                }
            }
            if(this.active_tab < closeTabIdx){
                //잘되기 때문에 처리해줄게 없음
            }

            alog("active_tab1 = " + this.active_tab);
            this.active_tab = this.active_tab + tabMoveBefore;
            alog("tabMoveBefore = " + tabMoveBefore);
            alog("tabMoveAfter = " + tabMoveAfter);
            //this.items.splice(closeTabIdx,1);
            Vue.delete(this.mytab, closeTabIdx);
            this.active_tab = this.active_tab + tabMoveAfter;

            alog("active_tab2 = " + this.active_tab);            
            
        }
    }
});

function alog(t){
    if(console)console.log(t);
}

$( window ).resize( function() {
  alog("window.resize()......................start");
  // do somthing
  var vflexHeight = $("#vflex").height() - 48;

  $(".divTab").css("height",vflexHeight);

});
$( document ).ready(function() {
  alog("document.ready()......................start");

  var vflexHeight= $("#vflex").height() - 48;

  
  $(".divTab").css("height",vflexHeight);
});

</script>
</body>
</html>
