<?php require 'logic.php'; ?>

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
            <?php if (checkWinner($board, 'X')) : ?>
                <h2 class="winner">Player X wins!</h2>
            <?php elseif (checkWinner($board, 'O')) : ?>
                <h2 class="winner">Player O wins!</h2>
            <?php elseif (isFull($board)) : ?>
                <h2 class="winner">It's a draw!</h2>
            <?php else : ?>
                <h2 class="current-player">Current Player: <?php echo $currentPlayer; ?></h2>
            <?php endif; ?>
            <form
                class="board"
                action="index.php"
                method="post" />
            <?php for ($i = 0; $i < count($board); $i++) : ?>
                <input
                    type="submit"
                    name="board[<?php echo $i; ?>]"
                    value="<?php echo $board[$i]; ?>"
                    class="cell"
                    readonly
                    <?php if (checkWinner($board, 'X') || checkWinner($board, 'O') || isFull($board)) echo 'disabled'; ?> />
            <?php endfor; ?>
            </form>
            <form action="index.php" method="post">
                <button
                    type="submit"
                    name="reset"
                    class="action-btn">
                    Reset Game
                </button>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>