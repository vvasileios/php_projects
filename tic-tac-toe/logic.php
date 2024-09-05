<?php
session_start();

function checkWinner($board, $player)
{
    $winningCombos = [
        [0, 1, 2],
        [3, 4, 5],
        [6, 7, 8],
        [0, 3, 6],
        [1, 4, 7],
        [2, 5, 8],
        [0, 4, 8],
        [2, 4, 6]
    ];

    foreach ($winningCombos as $combo) {
        if ($board[$combo[0]] === $player && $board[$combo[1]] === $player && $board[$combo[2]] === $player) {
            return true;
        }
    }

    return false;
}

function isFull($board)
{
    return !in_array('', $board);
}

function isDisabled($board)
{
    return checkWinner($board, 'X') || checkWinner($board, 'O') || isFull($board);
}

if (!isset($_SESSION['start'])) {
    $_SESSION['board'] = array_fill(0, 9, '');
    $_SESSION['current_player'] = 'X';
}

$currentPlayer = $_SESSION['current_player'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['board'])) {
    $board = $_SESSION['board'];
    $currentPlayer = $_SESSION['current_player'];

    foreach ($_POST['board'] as $index => $value) {
        if ($board[$index] === '') {
            $board[$index] = $currentPlayer;
            $_SESSION['board'] = $board;
            $_SESSION['current_player'] = $currentPlayer === 'X' ? 'O' : 'X';
            break;
        }
    }

    $currentPlayer = $_SESSION['current_player'];
}

if (isset($_POST['start'])) {
    $_SESSION['start'] = true;
    $board = $_SESSION['board'];
}

if (isset($_POST['reset'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit();
}

$board = $_SESSION['board'] ?? array_fill(0, 9, '');
