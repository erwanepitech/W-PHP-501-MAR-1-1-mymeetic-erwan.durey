<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>My_meetic</title>
</head>
<body>
    <header>
        <div class="nav">
            <nav>
                <ul>
                    <li><a href="profil.php">mon profil</a></li>
                    <li><a class="active" href="search.php">recherche</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="form">
            <div class="form_back">
                <div class="main_search">
                    <form id="search">
                        <div class="filtre">
                            <div id="genre_check">
                                <label for="homme">homme</label>
                                <input type="checkbox" id="homme" name="genre[]" value="1">
                                <br/>
                                <label for="femme">femme</label>
                                <input type="checkbox" id="femme" name="genre[]" value="2">
                                <br/>
                                <label for="autres">autres</label>
                                <input type="checkbox" id="autres" name="genre[]" value="3">
                            </div>

                            <div id="city_check">
                                <label for="Marseille">Marseille</label>
                                <input type="checkbox" id="Marseille" name="city[]" value="1">
                                <br/>
                                <label for="Lyon">Lyon</label>
                                <input type="checkbox" id="Lyon" name="city[]" value="2">
                                <br/>
                                <label for="Paris">Paris</label>
                                <input type="checkbox" id="Paris" name="city[]" value="3">
                            </div>

                            <div id="loisir_check">
                                <label for="Dance">Dance</label>
                                <input type="checkbox" id="Dance" name="hobby[]" value="1">
                                <br/>
                                <label for="Manga">Manga</label>
                                <input type="checkbox" id="Manga" name="hobby[]" value="2">
                                <br/>
                                <label for="Licorne">Licorne</label>
                                <input type="checkbox" id="Licorne" name="hobby[]" value="3">
                                <br/>
                                <label for="Cuisiner">Cuisiner</label>
                                <input type="checkbox" id="Cuisiner" name="hobby[]" value="4">
                                <br/>
                                <label for="Skateboard">Skateboard</label>
                                <input type="checkbox" id="Skateboard" name="hobby[]" value="5">
                            </div>
                        </div>

                        <div id="age_select">
                            <br/>
                            <label for="age">tranche d'âge</label>
                            <select name="age" id="age">
                                <option id="age" value="1">18-25 ans</option>
                                <option id="age" value="2">25-35 ans</option>
                                <option id="age" value="3">35-45 ans</option>
                                <option id="age" value="4">45 ans & +</option>
                            </select>
                        </div>

                        <input type="submit" value="recherche"/>
                    </form>
                </div>
            </div>
        </div>

        <div class="display">
            <div class="form">
                <div class="form_back">
                    <div class="carousel">
                        <div id="result">
                            <p id="nb"></p>
                        </div>
                        <p id="firstname_user"></p>
                        <p id="lastname_user"></p>
                        <p id="email_user"></p>
                        <p id="birthday_user"></p>
                        <p id="city_user"></p>
                        <p id="genre_user"></p>
                        <p>Loisir :</p>
                        <div>
                            <p id="hobby"></p>
                        </div>
                        <div id="btn_left"><img src="assets/left-arrow.png" alt=""></div>
                        <div id="btn_right"><img src="assets/right-arrow.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="script/search.js"></script>
</body>
</html>