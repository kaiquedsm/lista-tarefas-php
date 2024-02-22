<?php 

$erro = $_SESSION['error'] ?? null;

unset($_SESSION['error']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <form action="index.php">
        <div>
            <input type="text" name="nome" id="">
        </div>
        <div>
            <input type="password" name="senha" id="">
        </div>
        <div>
            <input type="submit" value="Enviar" >
        </div>
    </form>
</body>
</html>