<!DOCTYPE html>
<html>
<head>
    <title>vuetify tab</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

  <!--css-->
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">

  <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">

  <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">

  <!--js-->
  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>

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
          <v-list-item link>
            <v-list-item-action>
              <v-icon>mdi-view-dashboard</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Dashboard</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item link>
            <v-list-item-action>
              <v-icon>mdi-cog</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Settings</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-navigation-drawer>
  
      <v-app-bar
        app
        clipped-left
      >
        <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        <v-toolbar-title>Application</v-toolbar-title>
      </v-app-bar>
  
      <v-main>
        <v-container
          class="pa-0 fill-height"
          fluid
        >

        <v-layout
          justify-center
          align-center 
          class="overflow-hidden"
        >
          <v-flex text-xs-center fill-height>
            <v-tabs
                dark
                background-color="teal darken-3"
                show-arrows
                v-on:change="changeTabs"
            >
                <v-tabs-slider color="teal lighten-3"></v-tabs-slider>

                <v-tab
                v-for="i in mytab"
                :key="i.id"
                :href="i.link"
                :target="'iframe-' + i.id"
                class="pr-0"
                @click="changeTab(i.id)"
                >
                {{ i.name }}&nbsp;<v-btn icon small @click.prevent="closeTab(i.id)"><v-icon small>fas fa-times</v-icon></v-btn>
                </v-tab>
            </v-tabs>

            <div v-for="i in mytab" 
            style="padding-bottom:48px;height:100%;"
            :id="'div-'+ i.id"
            v-show="i.isshow"
            >
                <iframe frameborder=”0″ marginwidth=”0″ marginheight=”0″ 
                style="height:100%;width:100%;border-width:0px;border-color:silver;"
                :id="'iframe-' + i.id" 
                :name="'iframe-' + i.id"
                src="">
                </iframe>
            </div>
            </v-card>
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
        mytab : [
            {id:"tab1",name:"name1",link:"demo_webix.php",isshow:false}
            , {id:"tab2",name:"name2",link:"demo_webixtab_t1.php",isshow:false}
            , {id:"tab3",name:"name3",link:"img_pari.png",isshow:false}
        ]    
    }),

    created () {
        this.$vuetify.theme.dark = false
    },

    methods:{
        changeTabs: function(tHref){
            alog("changeTabs().........................start");
            alog(this);
            alog("  tHref=" + tHref);

            //alert(tmp);
        },            
        changeTab: function(tId){
            alog("changeTab().........................start");
            alog(this);
            alog("  tId=" + tId);
            for(t=0;t<this.mytab.length;t++){
                if(this.mytab[t].id == tId){
                    this.mytab[t].isshow = true;
                }else{
                    this.mytab[t].isshow = false;
                }
            }
            //alert(tmp);
        },
        closeTab: function(tId){
            alog("closeTab().........................start");
            for(t=0;t<this.mytab.length;t++){
                if(this.mytab[t].id == tId){
                    this.mytab.splice(t,1);
                }
            }
        }
    }
})

function alog(t){
    if(console)console.log(t);
}
</script>
</body>
</html>
