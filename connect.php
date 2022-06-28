<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style/style.css">
    <title>My_meetic</title>
</head>
<body>
    <main>
    <h1>Bienvenue sur my meetic</h1>
        <div class="login">
            <div class="form_back">

                <form id="connect" method="post">
                    <div class="main">
                        <label for="email">email</label>
                        <input type="email" id="email" placeholder="mail@domain.com" name="email" required>
                    </div>
                    <br/>
                    <div class="main">
                        <label for="password">mot de passe</label>
                        <div class="verif">
                            <input id="password" type="password" name="password" minlength="8" placeholder="mot de passe">
                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                        </div>
                    </div>
                    <div class="main">
                        <div class="connect_btn">
                            <input type="submit" name="login" value="connexion" />
                        </div>
                    </div>
                    <br/>
                </form>
                <div class="main">
                    <a href="index.php">Vous n'êtes pas membre ? inscrivez-vous</a>
                </div>
            </div>
        </div>
    </main>
    <script src="script/app.js"></script>
</body>
</html>