<?php

/**
 * Tic-Tac-Toe game logic.
 */
session_start();

/**
 * Check if the specified player has won the game.
 *
 * @param array $board The current game board.
 * @param string $player The player symbol ('X' or 'O').
 * @return bool True if the player has won, false otherwise.
 */
function checkWinner($board, $player)
{
    $winningCombos = [
        [0, 1, 2],
        [3, 4, 5],
        [6, 7, 8], // Rows
        [0, 3, 6],
        [1, 4, 7],
        [2, 5, 8], // Columns
        [0, 4, 8],
        [2, 4, 6] // Diagonals
    ];

    foreach ($winningCombos as $combo) {
        if ($board[$combo[0]] === $player && $board[$combo[1]] === $player && $board[$combo[2]] === $player) {
            return true;
        }
    }
    return false;
}

/**
 * Check if the board is full (i.e., no empty cells).
 *
 * @param array $board The current game board.
 * @return bool True if the board is full, false otherwise.
 */
function isFull($board)
{
    return !in_array('', $board);
}

/**
 * Initialize the game by setting up the board and current player.
 */
function initGame()
{
    $_SESSION['board'] = array_fill(0, 9, '');
    $_SESSION['current_player'] = 'X';
    $_SESSION['start'] = true;
}

/**
 * Process a player's move by updating the board and switching the current player.
 *
 * @param array $board The current game board.
 * @param string $player The current player symbol ('X' or 'O').
 */
function processMove($board, $player)
{
    foreach ($_POST['board'] as $index => $value) {
        if ($board[$index] === '') {
            $board[$index] = $player;
            $_SESSION['board'] = $board;
            $_SESSION['current_player'] = ($player === 'X') ? 'O' : 'X';
            break;
        }
    }
}

/**
 * Reset the game by clearing the session and redirecting to the index page.
 */
function resetGame()
{
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit();
}

/**
 * Determine if the game is over (win or draw).
 *
 * @param array $board The current game board.
 * @return bool True if the game is over, false otherwise.
 */
function gameOver($board)
{
    return checkWinner($board, 'X') || checkWinner($board, 'O') || isFull($board);
}

/**
 * Handle POST requests (user actions).
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reset'])) {
        resetGame();
    }

    if (isset($_POST['start'])) {
        initGame();
    }

    if (isset($_POST['board']) && isset($_SESSION['start']) && !gameOver($_SESSION['board'])) {
        processMove($_SESSION['board'], $_SESSION['current_player']);
    }

    // After processing a POST request, set a flag and redirect to avoid form re-submission.
    $_SESSION['action_done'] = true;
    header('Location: index.php');
    exit();
}

/**
 * Handle GET requests (page loads and refreshes).
 */
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_SESSION['action_done'])) {
        // The last request was a POST action; keep the game state.
        unset($_SESSION['action_done']);
    } else {
        // The last request was not a POST (likely a refresh); reset the game if it was started.
        if (isset($_SESSION['start'])) {
            resetGame();
        }
        // If the game was not started, do nothing (show 'Start Game' button).
    }
}

// Set up variables for the view.
$board = $_SESSION['board'] ?? array_fill(0, 9, '');
$currentPlayer = $_SESSION['current_player'] ?? 'X';
$gameStarted = $_SESSION['start'] ?? false;
