<?php
session_start();
if (isset($_SESSION['name'])) {
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        if (isset($_POST['action'])) {
  
            $action = trim($_POST['action']);
  
            require_once('classes/players.class.php');
            $players = new players();
  
            switch ($action) {
                case "CargarJugadoresPorCategoria":
                    $categoryFilter = (int) $_POST['categoryFilter'];

                    $response = 'TEST';

                    if ($categoryFilter > 0) {
                        $playerByCategory = $players->getByCategory($categoryFilter);
                        $response = '<option hidden selected value="0"> Seleccione jugador </option>';
                        foreach ($playerByCategory as $player) {
                            $response .= '<option value="' . $player['id'] . '">' . $player['name'] . '</option>';
                        }
                        echo $response;
                    }

                    echo $response;
              
                    break;
                default:
                    break;
            }
        }
    }
}
