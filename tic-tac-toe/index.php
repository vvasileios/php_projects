<?php
session_start();

if (!isset($_SESSION['start'])) {
    $_SESSION['board'] = array_fill(0, 9, '');
    $_SESSION['current_player'] = 'X';
}

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
}

if (isset($_POST['start'])) {
    $_SESSION['start'] = true;
    $board = $_SESSION['board'];
}

if (isset($_POST['reset'])) {
    session_unset();
    header('Location: index.php');
    exit();
}

$board = $_SESSION['board'] ?? array_fill(0, 9, '');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Tic-Tac-Toe</title>
</head>

<body>
    <div class="container">
        <h1 class="title">Tic-Tac-Toe</h1>
        <?php if (!isset($_SESSION['start'])) : ?>
            <form action="index.php" method="post">
                <button type="submit" name="start" class="action-btn">Start Game</button>
            </form>
        <?php else : ?>
            <form action="index.php" method="post" class="board">
                <?php for ($i = 0; $i < count($board); $i++) : ?>
                    <input
                        type="submit"
                        name="board[<?php echo $i; ?>]"
                        value="<?php echo $board[$i]; ?>"
                        class="cell"
                        readonly />
                <?php endfor; ?>
            </form>
            <form action="index.php" method="post">
                <button type="submit" name="reset" class="action-btn">Reset Game</button>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>