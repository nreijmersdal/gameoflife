<?php 
  session_start(); 
  require_once 'Classes/GameOfLife.php';  
  $game = new GameOfLife();
  $game->field = $_SESSION['field'];

  // Ajax actions
  $action = $_GET["action"];
  if($action == "toggle") {
    $x = $_GET['x'];
    $y = $_GET['y'];
    $game->toggleStatus($x, $y);
  }
  
  if($action == "update") {
    $game->applyGameRules();
  }
  
  if($action == "clear") {
    $game->createField($game->getMaxX(),$game->getMaxY());
  }
  
  // Save and update game field
  $_SESSION['field'] = $game->field;
  echo $game->drawField();

?>
