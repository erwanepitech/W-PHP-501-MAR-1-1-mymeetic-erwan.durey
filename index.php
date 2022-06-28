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
    <main>
        <div class="form">

            <div class="form_back">
                <div class="main">
                    <form id="create" method="post">

                        <div class="first">

                            <div class="separe">
                                <label for="lastname">nom</label>
                                <input type="text" id="lastname" name="lastname" placeholder="Nom">
                                <br/>
                                <label for="firstname">prénom</label>
                                <input type="text" id="firstname" name="firstname" placeholder="Prénom">
                                <br/>
                            </div>

                            <div class="separe">
                                <label for="city">ville</label>
                                <select name="city" id="city">
                                    <option id="city" name="city" value="1">Marseille</option>
                                    <option id="city" name="city" value="2">Lyon</option>
                                    <option id="city" name="city" value="3">Paris</option>
                                </select>
                                <br/>
                                <label for="email">email</label>
                                <input type="email" id="email" placeholder="mail@domain.com" name="email">
                                <span id="email_message"></span>
                            </div>

                        </div>

                        <div class="first">

                            <div class="separe">
                                <label for="date">Date de naissance</label>
                                <br/>
                                <input type="date" id="date" name="birthday">
                                <label for="genre">genre</label>
                                <select name="genre" id="genre">
                                    <option value="1">Homme</option>
                                    <option value="2">Femme</option>
                                    <option value="3">Autre</option>
                                </select>
                            </div>

                        </div>

                        <div class="first">

                            <div class="separe">
                                <p>Loisir (minimum 1 choix)</p>
                                <input type="checkbox" id="Dance" name="hobby[]" value="1">
                                <label for="Dance">Dance</label>

                                <input type="checkbox" id="Manga" name="hobby[]" value="2">
                                <label for="Manga">Manga</label>

                                <input type="checkbox" id="Licorne" name="hobby[]" value="3">
                                <label for="Licorne">Licorne</label>

                                <input type="checkbox" id="Cuisiner" name="hobby[]" value="4">
                                <label for="Cuisiner">Cuisiner</label>

                                <input type="checkbox" id="Skateboard" name="hobby[]" value="5">
                                <label for="Skateboard">Skateboard</label>
                                <br/>
                                <br/>
                                <label for="hobby_perso">autres (à preciser)</label>
                                <input type="text" id="hobby_perso" name="hobby_perso">
                            </div>

                            </div>

                            <div class="first">

                            <div class="separe">

                                <label for="password">mot de passe</label>
                                <div class="verif">
                                    <input id="password" type="password" name="password" minlength="8" placeholder="mot de passe">
                                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                                </div>

                                <label for="verify">comfirmer le mot de passe</label>
                                <div class="verif">
                                    <input id="verify" type="password" name="password_verify" minlength="8" placeholder="comfirmer le mot de passe">
                                    <i class="bi bi-eye-slash" id="toggleverify"></i>
                                    <br/>
                                    <span id="message"></span>
                                </div>
                            </div>
                        </div>

                        <input type="submit" value="inscription" />
                        <br/>
                    </form>
                    <div class="main">
                    <a href="connect.php">Vous êtes déja membre ? connectez-vous</a>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <script src="script/app.js"></script>
</body>
</html>