<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <script src="script/profile.js"></script>
    <title>My_meetic</title>
</head>
<body>
    <header>
        <div class="nav">
            <nav>
                <ul>
                    <li><a class="active" href="profil.php">mon profil</a></li>
                    <li><a href="search.php">recherche</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="profil" id="edit_profile">
            <div class="form">
                <div class="form_back">
                    <div class="main">
                        <h4>Mon compte</h4>
                        <form id="edit_prof" method="post">
                            <input type="text" name="id" id="id" style="display:none">
                            <label for="lastname">nom :</label>
                            <input type="text" id="lastname" name="lastname" placeholder="Nom" requiered>
                            <br/>
                            <label for="firstname">prénom :</label>
                            <input type="text" id="firstname" name="firstname" placeholder="Prénom" requiered>
                            <br/>
                            <label for="email">email :</label>
                            <input type="email" id="email" placeholder="mail@domain.com" name="email" requiered>
                            <br/>
                            <label for="city">ville</label>
                                <select name="city" id="city">
                                    <option id="city" name="city" value="1">Marseille</option>
                                    <option id="city" name="city" value="2">Lyon</option>
                                    <option id="city" name="city" value="3">Paris</option>
                                </select>
                            <br>
                            <div class="sec">

                                <label for="password">mot de passe</label>
                                <div class="verif">
                                    <input id="password" type="password" name="password" minlength="8" placeholder="mot de passe" requiered>
                                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                                </div>

                                <label for="verify">comfirmer le mot de passe (si changement de mot de passe necessaire)</label>
                                <div class="verif">
                                    <input id="verify" type="password" name="password_verify" minlength="8" placeholder="comfirmer le mot de passe">
                                    <i class="bi bi-eye-slash" id="toggleverify"></i>
                                    <br/>
                                </div>
                                <span id="message"></span>
                                <br/>

                            </div>
                            <span id="message"></span>
                            <br/>
                            <input type="submit" value="confirmer" />
                            <br/>
                            <button id="back">retour</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="profil" id="show_profile">
            <div class="form">
                <div class="form_back">
                    <div class="main">
                        <h4>Mon compte</h4>
                        <p id="lastname_user"></p>
                        <p id="firstname_user"></p>
                        <p id="email_user"></p>
                        <p id="birthday_user"></p>
                        <p id="city_user"></p>
                        <p id="genre_user"></p>
                    </div>

                    <div class="main">
                        <button id="edit">modifier</button>
                        <br/>
                        <br/>
                        <button id="logout">se deconnecter</button>
                    </div>
                </div>
            </div>
        </section>
        
    </main>

    <footer>

    </footer>
</body>
</html>