<!doctype html>
<html>
<head>
        <meta charset="utf-8" />
        <title>APUS GAMES - APUSGroup</title>

        <meta name="author" content="AUPSGroup" />
        <meta name="copyright" content="Copyright (c) 2014. www.apusapps.com All rights reserved." />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <!-- Favicon -->
        <link rel="icon" href="http://www.apusapps.com/image/favicon32x32.ico" type="image/x-icon">

        <!-- CSS -->

        <link rel="stylesheet" type="text/css" href="http://icon.apuslauncher.com/appbox/gamecenter_style_20151010.css" />
        <style type="text/css">
        <!--
                body{margin: 45px 0 0;}
        -->
        </style>

</head>
<body>

        <!-- User Center -->
        <div id="tabSlider" class="tabSlider">
                <div class="tabSlider-tab">
                        <ul class="tabSlider-hd line">
                                <li class="curr"><span>My favourite</span></li>
                                <li style="display:none"><span>Recently Played</span></li>
                        </ul>
                        <a class="go-back" href="web_game.php">GO BACK</a>
                </div>
                <div class="tabSlider-bd">
                        <div class="tabSlider-wrap">
                                <!-- My favourite -->
                                <div class="tabSlider-box curr">
                                        <div class="games-layer uc-my-favourite" id="div_fav">


                                        </div>


                                </div>



                        </div>
                </div>
        </div>

        <script src="http://icon.apuslauncher.com/activities/jquery-1.9.1.min.js"></script>
        <script>

                //init storage 
                var storage = window.localStorage; 
                var favkey  = "favkey";
                var hiskey  = "hiskey";
                var favarr = [];
                var hisarr = [];
                var ajax_ids = '';

                //init data
                function init_data(){
                        var favstr = storage.getItem(favkey);
                        if(favstr!=null){
                                favarr = JSON.parse(favstr);    
                        }               
                        for(i in favarr){
                                ajax_ids += favarr[i]+',';
                        }                                       
                        //console.log(ajax_ids);
                        if(ajax_ids == ''){
                                return false;
                        }
                        $.post("web_game_ajax.php",{ ids:ajax_ids },function(data){
                                var c = 0;
                                var back = eval('('+data+')');
                                var html = '';
                                for(i in back){
                                        html += '<div class="game-des">';
                                        html += '<a class="game" href="jump_v3.php?id='+i+'">';
                                        html += '<div class="game-icon-layer">';
                                        html += '<img class="icon-space-img" src="'+back[i]['img']+'" />';
                                        html += '</div>';
                                        html += '<div class="game-name">'+back[i]['name']+'</div>';
                                        html += '</a>';
                                        html += '<div  class="favourite gc_'+i+' favourite-img" style="display:" id="fav_'+i+'" onclick="do_fav('+i+',\'fav_'+i+'\')">Favourite</div>';
                                        html += '</div>';
                                        c = c + 1;
                                        if(c%4 == 0){
                                                html += '<div class="clear"></div>';
                                        }
                                }
                                if(c%4 != 0 ){
                                        html += '<div class="clear"></div>';
                                }

                                $('#div_fav').html(html);

                        });
                }
                init_data();

                // Favourite
                function do_fav(id,n){
                        if($('#'+n).hasClass("favourite-none-img")){
                                //无收藏
                                $(".gc_"+id).removeClass("favourite-none-img").addClass("favourite-img");
                                if($.inArray(id,favarr) == -1){
                                        favarr.push(id);                
                                        storage.setItem(favkey,JSON.stringify(favarr));                 
                                        //console.log(favarr);
                                }
                        }else{
                                //已收藏
                                $(".gc_"+id).removeClass("favourite-img").addClass("favourite-none-img");
                                if($.inArray(id,favarr) != -1){
                                        favarr.splice($.inArray(id,favarr),1)                
                                        storage.setItem(favkey,JSON.stringify(favarr));                 
                                        //console.log(favarr);
                                }
                                
                        }
                }
        </script>
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
         
          ga('create', 'UA-61066345-2', 'auto');
          ga('send', 'pageview');
         
        </script>

</body>
</html>
