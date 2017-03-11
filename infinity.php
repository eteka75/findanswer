<?php
//site specific configuration declartion
/* define('BASE_PATH', 'http://localhost/timeline/');
  define('DB_HOST', 'localhost');
  define('DB_NAME', 'test');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', '');

  $con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
  if (mysqli_connect_error())
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
 */

define('FIRST', 1);
define('LIMIT', 4);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Infinite Scroll</title>
        <!-- Bootstrap -->
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,200' rel='stylesheet' type='text/css'>	
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/bootstrap/css/bootstrap-theme.css">
        <link href="css/style.css" rel="stylesheet">

        <!-- Script -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/css/bootstrap/js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
    </head>
    <body>
        <div class="limites">
            <input type="" id="first" value="1" />
            <input type="" id="limit" value="1" >
        </div>
        <div id="loader">
            Loader:  Chargement en cours
        </div>
        <div  style="min-height: 800px">
            <ul id="timeline-conatiner" class="list-group">
                Ici le contenu
            </ul>
        </div>




        <script type="text/javascript">
            flag = true;
            $(window).scroll(function () {

                if ($(window).scrollTop() + $(window).height() == $(document).height()) {
                    
                    first = $('#first').val();
                   
                    limit = $('#limit').val();
                    no_data = true;
                    if (flag && no_data) {
                        flag = false;
                        $('#loader').show();
                        $.ajax({
                            url: 'ajax.php',
                            dataType: "json",
                            method: 'GET',
                            data: {
                                start: first,
                                limit: limit
                            },
                            success: function (data) {
                                flag = true;
                                $('#loader').hide();
                                //alert(data.count)
                                if (data.count > 0) {
                                    var year=2012;
                                    first = parseInt($('#first').val());
                                    limit = parseInt($('#limit').val());
                                    $('#first').val(parseInt(first + limit));
                                    //$('#timeline-conatiner').append('<h1>Cool');
                                    //$('#timeline-conatiner').append('<li class="year">' + year + '</li>');
                                        //alert(data.content)
                                    $.each(data.content, function (key, value) {
                                        html = '<li class="event list-group-item">';
                                        html += '<h3 class="heading">' + value.name + '</h3>';
                                        html += '<span class="month"><i class="fa fa-calendar"></i>' + value.name + '</span><p>&nbsp;</p>';
                                        html += '<p><a href="' + value.demo + '" target="_blank">Demo </a></p>';
                                        html += '<p><a href="' + value.tutorial + '" target="_blank">Tutorial </a></p>';

                                        if (value.media_type == 'video' && value.media != '') {
                                            html += '<div class="embed-responsive embed-responsive-16by9">';
                                            html += '<iframe frameborder="0" allowfullscreen="allowfullscreen" src="' + value.media + '" class="embed-responsive-item"></iframe>';
                                            html += '</div>';
                                        }
                                        if (value.media_type == 'image' && value.media != '') {
                                            html += '<div class="text-center">';
                                            html += '<img class="img-responsive img-thumbnail" src="' + value.media + '">';
                                            html += '</div>';
                                        }
                                        html += '<p>' + value.description + '</p>';
                                        html += '</li>';
                                        $('#timeline-conatiner').append(html);
                                    });
                                    year--;
                                } else {
                                    //alert('No more data to show');
                                    no_data = false;
                                }
                            },
                            error: function (data,a,b) {
                                flag = true;
                                $('#loader').hide();
                                no_data = false;
                                alert(a);
                            }
                        });
                    }


                }
            });
        </script>
        <script>
            /*
             flag = true;
             $(window).scroll(function () {
             return;
             if ($(window).scrollTop() + $(window).height() == $(document).height()) {
             first = $('#first').val();
             limit = $('#limit').val();
             no_data = true;
             if (flag && no_data) {
             flag = false;
             $('#loader').show();
             $.ajax({
             url: 'ajax_html.php',
             method: 'post',
             data: {
             start: first,
             limit: limit
             },
             success: function (data) {
             flag = true;
             $('#loader').hide();
             if (data != '') {
             
             first = parseInt($('#first').val());
             limit = parseInt($('#limit').val());
             $('#first').val(first + limit);
             $('#timeline-conatiner').append('<li class="year">' + year + '</li>');
             
             $('#timeline-conatiner').append(data);
             year--;
             } else {
             alert('No more data to show');
             no_data = false;
             }
             },
             error: function (data) {
             flag = true;
             $('#loader').hide();
             no_data = false;
             alert('Something went wrong, Please contact admin');
             }
             });
             }
             
             
             }
             });*/
        </script>
    </body>
</html>