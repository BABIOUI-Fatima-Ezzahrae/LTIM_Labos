<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="login-container">
        
        <form action="authentifier.php" method="post">
            <div class="title">
                <h3>Authentification</h3>
            </div>
            <div class="formInputs">
                <input type="email" id="email" name="login" placeholder="email" required>
                <input type="password" id="password" name="pass" placeholder="pass" required>
                <input type="submit" value="Login">
            </div>
            
        </form>
        <div class="logo">
            <img src="./imgs/photo_2021-12-20_23-43-19-removebg-preview (1).png" alt="">
        </div>
    </div>
</body>
</html>