<?php
      require_once 'Classes/GameOfLife.php';

      session_start();
      session_unset();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Game of Life - Test-Driven Development Example</title>

    <link rel="stylesheet" type="text/css" href="Css/style.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>

    <script>
      var previousCssState;
      
      function updateField() {
        $("#field").load("ajax.php?action=update", function() {
          if($("#update").html() === "Pause") {
            updateField();
          } else {
            applyTdHover();            
          }
        });
      }
 
      function cycleField() {
        $("#field").load("ajax.php?action=update", function() {
            applyTdHover();            
        });
      }
 
      function toggle(x,y) {
        $("#field").load("ajax.php?action=toggle&x="+x+"&y="+y, function() {
          applyTdHover();            
        });
      }
      
      function applyTdHover() {
        $("td").mouseover(function(){
          previousCssState = $(this).css("background-color");
          $(this).css("background-color","#FBB117")
        })
        $("td").mouseout(function(){
          $(this).css("background-color", previousCssState)
        })
      }
      $(document).ready(function(){

        applyTdHover();
        
        $("#update").click(function(){
          if($("#update").html() === "Start") {
            $("#update").text("Pause");
            updateField();
          } else {
            $("#update").text("Start");            
          }
        });
        $("#cycle").click(function(){
          cycleField();
        });
        $("#random").click(function(){
          location.reload();
        });
        $("#clear").click(function(){
          $("#field").load("ajax.php?action=clear", function() {
            applyTdHover();
          });
        });
      }); 
    </script>    
  </head>
  <body>
    <center><h1>Test driven "<span style="color: #ffd56f;">Game of life</span>" in PHP</h1></center>
    <div id="toolbar">
      <button id="update">Start</button>
      <button id="cycle">Cycle</button>
      <button id="random">Random</button>
      <button id="clear">Clear</button>
    </div>
    <div id="field">
      <?php
       $game = new GameOfLife();
       $game->createField(30, 60, "Random");
       $_SESSION['field'] = $game->field;
       echo $game->drawField();
      ?>
    </div>

      <br><br>
      <center><a href="gameoflife.zip" style="color:#ddd">Click here for the sources</a></center>    
      <br><br>
      <center>
        <script type="text/javascript"><!--
        google_ad_client = "ca-pub-8395713034831171";
        /* Blog post banner */
        google_ad_slot = "1648098675";
        google_ad_width = 468;
        google_ad_height = 60;
        //-->
        </script>

        <script type="text/javascript"
        src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
        </script>
      </center>
      <script type="text/javascript">
      // Google Analytics Stuff
      var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
      document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
      </script>
      <script type="text/javascript">
      try {
      var pageTracker = _gat._getTracker("UA-12584712-1");
      pageTracker._trackPageview();
      } catch(err) {}</script>
    </body>
</html>
