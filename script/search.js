window.onload = function() {

    if (document.getElementById("search")) {

        const search = document.getElementById("search")
        const display = document.querySelector(".display")
        const hobby_check = document.getElementsByName("hobby[]")
        const city_check = document.getElementsByName("city[]")
        const genre_check = document.getElementsByName("genre[]")
        display.hidden = true

        search.addEventListener("submit", function (e) {

            e.preventDefault()
            var xhr = new XMLHttpRequest()
            var data = new FormData(this)
            
            xhr.onreadystatechange = function () {
                
                if (this.readyState == 4 && this.status == 200) {
                    var result = this.response
                    var count = 0

                    globalThis.user_info = result.user
                    carousel()

                    hobby_check.forEach(element => {
                        if (element.checked) {
                            count ++
                        }
                    })
                    city_check.forEach(element => {
                        if (element.checked) {
                            count ++
                        }
                    })
                    genre_check.forEach(element => {
                        if (element.checked) {
                            count ++
                        }
                    })
                    if (count === 0) {
                        alert("veuillez selectionner un element")
                    }
                    
                } else if (this.response == 4) {
                    alert("une erreur est survenue !")
                }
            }
            
            xhr.open("POST", "api/create/search_user.php")
            xhr.responseType = "json"
            xhr.send(data)
        })

        var count = 0

        function carousel () {

            if (count < 0) {
                count = user_info.length - 1
            }
            if (count === user_info.length) {
                count = 0
            }

            if (user_info.length != 0) {
    
                display.hidden = false
                var lastname = document.getElementById("lastname_user")
                var firstname = document.getElementById("firstname_user")
                var birthday = document.getElementById("birthday_user")
                var city = document.getElementById("city_user")
                var genre = document.getElementById("genre_user")
                var hobby = document.getElementById("hobby")
                var res = document.getElementById("result")
            
                var nb = user_info.length
                var p = document.getElementById("nb")
                p.innerHTML = "nombre de profil correspondant(s) : " + nb
    
                lastname.innerHTML = user_info[count]['lastname']
                firstname.innerHTML = user_info[count]['firstname']
                birthday.innerHTML = user_info[count]['age'] + " ans"
                city.innerHTML = "habite à " + user_info[count]['city']
                genre.innerHTML = "genre " + user_info[count]['genre']
                hobby.innerHTML = user_info[count]['hobby']
        
            } else {
                alert("aucun resultat pour votre recherche")
            }

        }

        var btn_left = document.getElementById("btn_left")
        var btn_right = document.getElementById("btn_right")

        btn_left.addEventListener("click", function () {
            count --
            carousel()
        })

        btn_right.addEventListener("click", function () {
            count ++
            carousel()
        })

    }
}