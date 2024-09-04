<?php
$board = array_fill(0, 9, '');
$boardLength = count($board);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo '<pre>';
    var_dump($board);
    echo '</pre>';
}
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
        <form action="index.php" method="post" class="board">
            <?php for ($i = 0; $i < $boardLength; $i++) : ?>
                <input
                    type="text"
                    name="board[<?php echo $i; ?>]"
                    value="<?php echo $board[$i]; ?>"
                    class="cell" />
            <?php endfor; ?>
        </form>
        <button class="action-btn">Start</button>
    </div>
</body>

</html>