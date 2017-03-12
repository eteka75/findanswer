
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title> <?= isset($titre) ? $titre . ' - Toutes les réponses à vos questions' : 'Questions et réponses pour vos clients'; ?></title>
        <meta charset="utf-8" >
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!--bigdataapp-160115 Latest compiled and minified CSS 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="./assets/css/ken.css" >
        <link rel="shortcut icon" href="favicon.ico">
        <link rel="apple-touch-icon image_src" href="favicon.ico">

        <script src="assets/js/jquery.min.js"></script>
        <!--script src="./ken-Ui/keen-ui.min.js"></script-->
        <!--<script src="assets/js/autocomplete/jquery.mockjax.js" type="text/javascript"></script>
        <script src="assets/js/autocomplete/jquery.autocomplete.js" type="text/javascript"></script>
        <link href="assets/js/autocomplete/jquery.autocomplete.css" rel="stylesheet" />
        <link href="../assets/addons/simple-line-icons-master/css/simple-line-icons.css" rel="stylesheet" />
        -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

        <style>
            body{
                font-family:-apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", "Helvetica", "Arial", sans-serif;
                margin: 0;
                font-size: 14px;
            }
             a:visited, a:visited{
                color: #609;
            }
            a{
                color: #1a0dab;
                text-decoration: none;
            }
            fieldset{
                margin: auto;
                background: #ffffff;
                padding: 15px;
                border: 1px solid #ddd;
                border-radius: 3px;

            }
            .no-link,.no-link a{
                text-decoration:  none;
                color: #333333;
            }
            .bloc_auto{
                margin: auto;
                max-width: 550px;
            }
            .pull-right{float: right}
            .btn3:hover{background: #f9f9f9}
            .btn3{
                border: 1px solid #dddddd;
                padding: 5px 10px;
                background: #fff;
                box-shadow: 0 1px 3px rgba(0,0,0,.2);
                border-radius: 3px;
            }
            .page-title{
                font-size:18px;
                padding: 10px ;
                border-bottom: 1px solid #dddddd;
                font-weight: bold;
                margin: 10px 0 5px 0;
            }
            fieldset>legend{
                font-size: 12px;
                font-weight: bold;
                color: #555
            }
            .mhr{border-top: 1px solid #eee;height: 1px;background: white}
            .bloc_login{
                width: 290px;
                margin:40px auto 0;
                padding:10px 15px ;
                text-align: center;

            }
            .img-logo-profil{
                //max-height: 100px;
                max-width: 150px;
                border-radius: 50%;
                margin: 10px auto;
            }
            .light{font-weight: 100;}
            .bloc_search_head{
                top: 0;
                width: 99%;
                padding-left: 1%;
                background: #ffffff;
                min-height: 40px;
                padding-top: 5px;
                padding-bottom: 10px;
                border-bottom: 1px solid #eee;
                clear: both;
                box-shadow: 0 0 2px rgba(0, 0, 0, 0.082), 0 0px 5px rgba(0, 0, 0, 0.1);
                border-bottom: 3px solid #47a3d1;
            }
            #bloc_resultat_recherche{
                min-height: 700px;
               /* background: #f0f0f0;*/
                padding-bottom: 50px;
            }
            .bloc_resultat1{
                min-width: 55%;
                max-width: 95%;
                width: 55%;
                margin: auto;
            }

            #mini-logo{
                max-height: 45px;
                margin: auto;
                max-width: 100%;
            }
            .bloc_logo1{
                float: left;
                height: 30px;
                width: auto;
                width: 30%;
            }
            .bloc_head_right{
                padding-left: 5px;
                float: left;
                width: 50%;
                width: 70%;
                text-align: right;
            }
            .bloc_search2{
                padding-left: 5px;
                float: left;
                width: 500px;

                max-width: 50%;
            }
            .bloc_search3{
                text-align: right;
                padding: 10px 30px 0 0;
            }
            .lire_suite,.lire_suite a{
                margin-top: 8px;
                padding: 4px 0;
                font-size: 12px;
                color: #999999;
                border-top: 0px solid #eee;
                text-align: right;
                text-decoration: none;
            }
            #logintitle{
                padding: 8px 10px;
                background: #f7f8f9;
                margin: 0 0 15px;
            }
            .l-table,.m-table{
                padding: 5px;
                border:0px solid #ddd;
                width:100%;
                border-collapse: collapse;

            }

            .m-table>tbody>tr>td{
               // white-space: nowrap;
            }
            .m-table tr:last-child,.m-table tr td:last-child{
                border-bottom: 1px dotted #ccc;

            }
            .l-table tr:last-child,.l-table tr td:last-child{
                border-bottom: 1px solid #eee;

            }
            .l-table tr,.l-table tr td{
                border-top: 1px solid #eee;
                padding: 8px 10px;
                background: #fff;
                background: rgba(255,255,255,.5);
            }
            .list_mini1{
                max-height: 200px;
                padding: 0 !important;
                overflow: auto;
                padding: 0;
            }
            .m-table tr,.m-table tr td{
                border-top: 1px dotted #ccc;
                padding: 5px 10px
            }
            .img-logo-home{
                height: 30px;
                width: 30px;
                border-radius: 50%;
                border:1px solid #ccc;
                float: left;
                margin:-5px 5px 0 0;
                background-color: #fff;
            }
            .white-card{
                padding:30px 10px ;

                background: #ffffff;
                border-radius: 5px;
                border: 1px solid #ececec;
            }
            .text-mini{font-size: 12px;}
            label{display: block;text-align: left}
            .text-left{text-align: left}
            .text-right{text-align: right}
            .text-center{text-align: center}
            .text-muted{color: #555555}
            .bold{font-weight: bold}
            .bloc_logo{
                //  padding: 30% auto 10px;                
                text-align: center;
                display: block;
                padding-top: 30%;
            }
            .bloc_logo2{
                margin: auto;
                border-bottom: 1px solid #ddd;
                padding: 10px 0;
                margin-bottom: 30px;
            }
            #bloc_middle{
                min-width: 40%;
                max-width: 80%;
                /*margin:0 auto 70px;*/
                margin-left: 3%;
                padding-bottom: 30px;
                min-height: 500px; 
            }
            .list-question{
                padding: 5px 8px;
                border-bottom: 1px solid #eee;
            }
            .list-question:nth-child(odd){
                background: #f5f5f5;
            }
            #bloc_middle2{
                min-width: 60%;
                max-width: 80%;
                /*margin:0 auto 70px;*/
                margin-left: auto;
                margin-right: auto;
                background: #fff;
                padding-bottom: 30px;
                /*background: red;*/
                min-height: 500px; 
            }
            .menu-onglet2,.menu-onglet{
                margin: 15px 0 0;
                padding: 0;
                display: inline-block;
                clear: both;
                border-bottom: 0px solid #ddd;
                height: 21px;
                width: 200px;;
            }
            .menu-onglet2 a,.menu-onglet li a{
                color: #333333;
                text-decoration: none;
                font-size: 14px;
            }
            .questionpage{
                color: #1d2129;
                font-size: 32px;
                font-weight: bold;
                line-height: 40px;
                margin-bottom: 4px;
                border-bottom: 0px solid #ccc;
                padding: 0 0 15px;
                margin: 0;
            }
            .info-image{
                max-width: 200px;
            }
            .menu-onglet li.active a{
                color: #2e91c3
            }

            .menu-onglet li.active{
                /* border:1px solid  #ddd;*/
                /*border-bottom: 2px solid #2e91c3;*/
                border-left: 4px solid #f44336;
                font-weight: bold;
            }
            .menu-onglet2 {width: auto;}
            .menu-onglet2 >li>ul>li,.menu-onglet2 >li{
                list-style-type: none;
            }
            .menu-onglet2 >li{

                padding: 5px 10px;
                font-weight: 500;
            }
            .menu-onglet2 >li>ul{
                padding:5px 0px ;
                font-size: 14px;
            }
            .menu-onglet2 >li>ul>li,.menu-onglet2 >li>ul>li a{
                color: #6abce0;
                line-height: 25px;
            }
            .menu-onglet li:hover a{
                color: #2e91c3;
            }
            .menu-onglet li{
                list-style-type: none;
                display: inline;
                padding: 7px 5px 6px ;
                text-align: left;
                font-size: 12px;
                display: block;                
            }
            .bge{background: #f9f9f9}
            .bloc_menu{
                max-width: 200px;
                float: left;
                clear: both; 
                min-height: 120%;
                border-right: 1px solid #ddd;
            }
            .bloc_menu2{
                //box-shadow:0 0 10px 0 rgba(0,0,0,.125);
                min-height: 550px;
                max-width: 300px;
                min-width: 220px;
                background: #fff
            }
            .bloc_menu{
                border-right: 0px solid #ddd;
            }
            .bloc_content2>div.bloc_content>div{padding:10px}
            .bloc_content{
                min-width: 550px;
                float: left;
                min-height: 120%;
                width: auto;
                max-width: 600px;
                background: #ffffff;
                padding-bottom: 50px;
                padding: 10px 20px;

            }
            .bloc_content2 a{
                color: #367cc2;
            }
            .bloc_content2{
              //  box-shadow:0 0 10px 0 rgba(0,0,0,.125);
                width: auto;
                 float: left;
                 padding: 10px 20px 50px;
                 background: #ffffff;
                 min-height: 550px;
                 border-left:1px solid #dddddd;
                     color: #4b4f56;
                font-size: 18px;
                line-height: 24px;
                max-width: 600px;
            }
            .categorie-page{
                background: -webkit-linear-gradient(#fff,#f6f7fa);
                background: linear-gradient(#fff,#f6f7fa);
                padding: 0px 10%;
                text-align: center;
                font-weight: 100;
                z-index: 50000;
            }
            .categorie-page h3{                
                font-size: 28px;
                line-height: 30px;
                margin: 0px 0;
                padding: 10px 0 15px;
            }
            .bloc_search{
                padding:  0;
                margin: auto;
                width: 100%;
                text-align: center;
            }
            .search-input:focus{

            } 
            .menu-login{
                padding: 0;
                margin: 0;
                /*max-width: 150px;
                overflow: hidden;
                background: red;
                float: right;
                clear: both;*/
                margin-top: -2px;
            }
            .menu-login li{
                padding: 2px 5px;
                font-weight: 500;
                width: 100px;
                overflow: hidden;
                white-space: nowrap;
                text-overflow:ellipsis;

            }
            .inline >li{list-style-type: none; display: inline}
            .bloc_search_head2{
                padding: 10px 5% 4px 10%;
                width: 85%;
                min-height: 30px;
                /*box-shadow: 0 0 4px #ddd;
                border-bottom: 1px solid #dddddd;
                background: -webkit-linear-gradient(#fff,#f6f7fa);
                background: linear-gradient(#fff,#f6f7fa);*/
            }
            .body_gradient{
                background: -webkit-linear-gradient(#fff,#f6f7fa);
                background: linear-gradient(#fff,#f6f7fa);
                min-height: 650px;
            }
            #mini-logo2{
                height: 25px;
            }
            .search-input,.search-input2{ 
                width: 90%;
                padding: 5px 10px;
                font-size: 15px;
                font-weight: 400;
                width: 100%;
                border: 1px solid #dddddd;
                margin: 0 auto;
                border-radius: 1px;
                margin: 4px auto;
                /*padding: 12px 20px 12px 10px;*/
                padding: 5px 10px 10px 5px;
                box-shadow: 0PX 0px 0px rgba(0,0,0,.084);
                border-radius: 2px;
                background: #ffffff;
                outline: none;
                color: #222;
                background: url(./assets/images/search_btn.png) no-repeat 98% 50%;
                background-size: 20px 20px;
            }
            .search-input2{
                padding: 10px 20px 10px 10px;
                -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
                -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
            }
            .search-input,.input-std{
                /*// padding: 5px 10px;
                font-size: 14px;
                width: 100%;
                border: 1px solid #ddd;
                margin: 0 auto;
                border-radius: 1px;
                margin: 5px auto;*/
            }
            .control{width: auto;}
            .btn1{
                background: #2495E0;
                border: 1px solid #6268E1;
            }
            a.btn1 ,a.btn2 {
                color: #ffffff !important;
            }
            .btn1,.btn2{
                padding: 8px 15px;

                margin: 10px 0 0;
                width: auto;
                color: #ffffff;
                font-weight: bold;
                font-size: 15px;
                border-radius: 2px;
            }
            .control{
                font-family: Arial;
                min-width: 280px;
                max-width: 380px;
                padding: 0;
                outline: none;
                display: block;
                max-width: 500px;
                min-height: 24px;
                padding: 3px 2%;
                font-size: 14px;
                line-height: 1.42857143;
                color: #555;
                background-color: #fff;
                background-image: none;
                border: 1px solid #dddddd;
                border-radius: 0px;
                margin: 5px 0;
                /* -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
                -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
                -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                */
            }
            .btn2{
                background: #0c9e13;
                border: 1px solid #13a01a;
                /*text-shadow: 0 1px 0px #000000;*/
            }
            .block{
                display: block;
                clear: both;
            }
            .w100{width: 100%}
            .pad10{padding: 10px;}
            .pad0{padding: 0px;width: 100%}
            .pad5_0{padding: 5px 0;width: 100%}
            .hidden{
                display: none ;
                background: #f9f9f9;
            }
            #menu-small{
                padding: 0;
                margin:  0;
                text-align: left;
            }
            #menu-small li{
                list-style-type: none;
                display: inline-table;
                display: inline-block;
                padding: 0px 5px;

            }
            #menu-small li a{
                font-size: 12px;
                color: #666666;
                text-decoration: none;
            }
            .error{
                margin: 10px 0;
                padding: 10px 0;
                color: brown;
                font-size: 12px;
                background: #fff2f2;
                border: 1px solid brown;
            }
            #header{
                top:0;
                width:100%;
                margin: auto;
                padding: 8px  10px;
                background: #111;
                border-top: 1px solid #ddd;
                border-bottom: 1px solid #eee;
                position: absolute;
                top: 95%;
                height: 20px;
                max-height: 40px;
                background-color:#fff;
                width:100%;
                /* box-shadow: 0px 1px 30px #ddd;*/
                position:fixed;
                bottom:0px;
            }
            .menu-head{
                width: 800px;
                margin: auto;

            }
            .list-entreprise{
                padding: 0;
                margin: 0;
            }
            .list-entreprise li:hover{
                background: #f7f8f9;
            }
            .img-app{
                float: left;
                padding: 2px ;
                height: 30px;
            }
            .list-entreprise li{
                list-style-type: none;
                padding: 5px 0px;
                border-bottom: 1px dotted #dddddd;
                cursor: pointer;
                min-height: 30px;
            }
            .puce1{
                height: 20px;
                width: 20px;
                border: 1px solid #ccc;
                float: right;
            }
            .list-entreprise li small{
                display: block;
                color: #888888;
            }
            
            #search-list  h3{

            }
            #search-list  h3{
                padding: 10px 0 0px;
                margin:  0;
                font-size: 18px;
                display: block;
                overflow: hidden;
                text-overflow: ellipsis;
                -webkit-text-overflow: ellipsis;
                white-space: nowrap;
                font-weight: normal;
            }
            #iconsearch{
                display: block;
                margin: 20px auto 10px auto;

            }
            .question_liste{                
                font-weight: bold;
                color: #15881a;
                font-size: 12px;
            }
            .reponse_liste, .question_liste{
                padding: 10px;
                margin: 0;
            }
            .reponse_liste{
                color: #333;
                font-size: 15px;
            }
            #search-list{
                margin: 0;
                padding: 0;
                padding-left: 15px;
            }
            #search-list>li:hover{
                //box-shadow: rgba(10, 10, 10, 0.1980392) 0px 2px 10px;
                transition: all ease 2s;
            }
             #search-list>li:nth(old){

             }
             #search-list>li:nth(old){
                
             }
            .bloc_mot_search small{color: #2e91c3}
            .bloc_mot_search{
                padding: 10px 10px 10px 15px;
                border-bottom: 0px solid #ddd;
                margin: 0;
                color: #797474;
                /*background: #f3fbff;*/
                /*background: #fff;*/
            }
            .cadre-entreprise{
                min-height: 100px;
                background:  #555;
                color: #fefefe;
                padding: 10px 0 20px;
            }
            .cadre-entreprise h1{
                font-size: 35px;
                text-align: center;
                display: block;
                margin: 0;
                margin:0px 0;
                padding-top: 10px;
            }
          .question_liste2,  .question_liste2 a{
                margin: 0;
                padding: 0;
                font-size: 15px;
                font-weight: 400;
                color: #408e22;
            }
            #search-list li>p{
                padding: 4px 0 0 ;
                margin: 0;
            }
            #search-list>li{
                /*padding: 10px 15px;*/
                width: auto;
                color: #777777;
                list-style-type: none;
                border-bottom: 0px solid #ddd;
               /* background: #FFF;
                box-shadow: rgba(10, 10, 10, 0.0980392) 0px 2px 3px;*/
                margin-bottom: 3px;
            }
            .no-content{
                font-size: 18px;
                text-align: center;
                min-height: 300px;
                padding: 20px ;
                color: #999999;
                margin: auto;
            }
            .card,.card2{
                max-width: 600px;
                box-shadow: 0 1px 2px 1px rgba(0,0,0,.08), 0 3px 6px rgba(0,0,0,.08);
                box-shadow: 0 1px 2px 1px rgba(0,0,0,.08), 0 3px 6px rgba(0,0,0,.08);
                color: #2e2e2e;
                background-color: #fff;
                border-color: #d5d5d5;
                outline: 0;
                -webkit-tap-highlight-color: rgba(0,0,0,0);
                margin: 0 auto 4.5em;
                padding:5px  3em;
                border: 1px solid rgba(20,53,80,0.14);
                font-size: 14px;
            }
            .no-shadow{
                box-shadow: none !important;
                margin-top: 0px;
                border-width: 0;
            }
            .autocomplete-suggestions { -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; border: 1px solid #999; background: #FFF; cursor: default; overflow: auto; -webkit-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); -moz-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); }
            .autocomplete-suggestion { padding: 5px 5px; white-space: nowrap; overflow: hidden; text-overflow:ellipsis;}
            .autocomplete-no-suggestion { padding: 3px 5px;}
            .autocomplete-selected { background: #f4f4f4; }
            .autocomplete-suggestions strong { font-weight: bold; color:#3599cc;/*2469d9 #2469d9; */}
            .autocomplete-group { padding: 4px 5px; }
            .autocomplete-group strong { font-weight: bold; font-size: 16px; color: #003399; display: block; border-bottom: 1px solid #000; }

        </style>
    </head>
    <body>
        <!--div class="page__demo-group">
            <div class="ui-toolbar ui-toolbar--type-default ui-toolbar--text-color-black ui-toolbar--progress-position-bottom is-raised">
                <div class="ui-toolbar__left">
                    <div class="ui-toolbar__nav-icon">
                        <button type="button" class="ui-icon-button ui-icon-button--type-secondary ui-icon-button--color-black ui-icon-button--size-large">
                            <div class="ui-icon-button__icon">
                                <span class="ui-icon material-icons menu">menu</span>
                            </div> 
                            <div class="ui-icon-button__focus-ring"></div> 
                            <div class="ui-progress-circular ui-icon-button__progress ui-progress-circular--color-black ui-progress-circular--type-indeterminate" style="width: 24px; height: 24px; display: none;"><svg role="progressbar" viewBox="25 25 50 50" aria-valuemax="100" aria-valuemin="0" class="ui-progress-circular__indeterminate"><circle cx="50" cy="50" fill="none" r="20" stroke-miterlimit="10" stroke-width="4.5" class="ui-progress-circular__indeterminate-path"></circle></svg></div> <div class="ui-ripple-ink"></div> <!----> <!---->
<!--    </button></div> </div> <div class="ui-toolbar__body"><div class="ui-toolbar__title">Inbox</div></div> <div class="ui-toolbar__right"><div><button type="button" class="ui-icon-button ui-icon-button--type-secondary ui-icon-button--color-black ui-icon-button--size-large"><div class="ui-icon-button__icon"><span class="ui-icon material-icons refresh">refresh</span></div> <div class="ui-icon-button__focus-ring"></div> <div class="ui-progress-circular ui-icon-button__progress ui-progress-circular--color-black ui-progress-circular--type-indeterminate" style="width: 24px; height: 24px; display: none;"><svg role="progressbar" viewBox="25 25 50 50" aria-valuemax="100" aria-valuemin="0" class="ui-progress-circular__indeterminate"><circle cx="50" cy="50" fill="none" r="20" stroke-miterlimit="10" stroke-width="4.5" class="ui-progress-circular__indeterminate-path"></circle></svg></div> <div class="ui-ripple-ink"></div>  </button> <button type="button" class="ui-icon-button ui-icon-button--type-secondary ui-icon-button--color-black ui-icon-button--size-large"><div class="ui-icon-button__icon"><span class="ui-icon material-icons search">search</span></div> <div class="ui-icon-button__focus-ring"></div> <div class="ui-progress-circular ui-icon-button__progress ui-progress-circular--color-black ui-progress-circular--type-indeterminate" style="width: 24px; height: 24px; display: none;"><svg role="progressbar" viewBox="25 25 50 50" aria-valuemax="100" aria-valuemin="0" class="ui-progress-circular__indeterminate"><circle cx="50" cy="50" fill="none" r="20" stroke-miterlimit="10" stroke-width="4.5" class="ui-progress-circular__indeterminate-path"></circle></svg></div> <div class="ui-ripple-ink"></div>  </button> <button type="button" class="ui-icon-button ui-icon-button--type-secondary ui-icon-button--color-black ui-icon-button--size-large has-dropdown drop-target"><div class="ui-icon-button__icon"><span class="ui-icon material-icons more_vert">more_vert</span></div> <div class="ui-icon-button__focus-ring"></div> <div class="ui-progress-circular ui-icon-button__progress ui-progress-circular--color-black ui-progress-circular--type-indeterminate" style="width: 24px; height: 24px; display: none;"><svg role="progressbar" viewBox="25 25 50 50" aria-valuemax="100" aria-valuemin="0" class="ui-progress-circular__indeterminate"><circle cx="50" cy="50" fill="none" r="20" stroke-miterlimit="10" stroke-width="4.5" class="ui-progress-circular__indeterminate-path"></circle></svg></div> <div class="ui-ripple-ink"></div>  </button></div></div> <div class="ui-progress-linear ui-toolbar__progress ui-progress-linear--color-primary ui-progress-linear--type-indeterminate" style="display: none;"><div role="progressbar" aria-valuemax="100" aria-valuemin="0" class="ui-progress-linear__progress-bar is-indeterminate"></div></div></div>

        </div>-->
        <div id="header">
            <div class="menu-head ">

                <ul id="menu-small" class="text-center">
                    <li>
                        <a href="index.php">Rechercher</a>
                    </li>
                    <?php
                    if (isset($_SESSION['user'], $_SESSION['id'])) {
                        $user = unserialize($_SESSION['user']);
                        $nom = ($user['nom']);
                        ?>
                        <li class="active">
                            <a href="ent-home.php">Accueil</a>
                        </li>
                        <li>
                            <a href="compte.php">Mon compte</a>
                        </li>
                        <li>
                            <a href="reponses.php">Questions-Réponses</a>
                        </li>
                        <li>
                            <a href="statistiques.php">Statistiques</a>
                        </li>
                        <li>
                            <a href="logout.php">Déconnexion(<b><?= (isset($nom) ? $nom : ''); ?></b>)</a>
                        </li>

                        <?php
                    } else {
                        ?>
                        <li>
                            <a href="login.php">Connexion</a>
                        </li>
                        <li>
                            <a href="add-enterprise.php">Inscription</a>
                        </li>
                        <?php
                    }
                    ?>

                </ul>
            </div>
        </div>