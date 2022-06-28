window.onload = function() {

    if (document.querySelector(".profil")) {

        var lastname = document.getElementById("lastname_user")
        var firstname = document.getElementById("firstname_user")
        var email = document.getElementById("email_user")
        var birthday = document.getElementById("birthday_user")
        var city = document.getElementById("city_user")
        var genre = document.getElementById("genre_user")

        var lastname_user = document.getElementById("lastname")
        var firstname_user = document.getElementById("firstname")
        var email_user = document.getElementById("email")
        var city_user = document.getElementById("city")

        var edit = document.getElementById("edit")
        var edit_profile = document.getElementById("edit_profile")
        var show_profile = document.getElementById("show_profile")

        var id = document.getElementById("id")

        if (document.querySelector("#togglePassword")) {

            const togglePassword = document.querySelector("#togglePassword");
    
            togglePassword.addEventListener("click", function () {
                const type = password.getAttribute("type") === "password" ? "text" : "password";
                password.setAttribute("type", type);
                this.classList.toggle("bi-eye");
            })
        }
    
        if (document.querySelector("#toggleverify")) {
    
            const toggleverify = document.querySelector("#toggleverify");
            
            toggleverify.addEventListener("click", function () {
                const type = verify.getAttribute("type") === "password" ? "text" : "password";
                verify.setAttribute("type", type);
                this.classList.toggle("bi-eye");
            })
        }


        var xhr = new XMLHttpRequest()

        xhr.addEventListener("load", function () {

            var result = this.response
            lastname.innerHTML = result.user['lastname']
            firstname.innerHTML = result.user['firstname']
            email.innerHTML = result.user['email']
            birthday.innerHTML = result.user['birthday'] + " ans"
            city.innerHTML = result.user['city']
            genre.innerHTML = result.user['genre']

            firstname_user.value = result.user['firstname']
            lastname_user.value = result.user['lastname']
            email_user.value = result.user['email']
            city_user.value = result.user['id_city']
            id.value = localStorage.getItem("user_id")
        })

        xhr.open("POST", "api/create/display_profile.php")
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
        xhr.responseType = "json"
        xhr.send("id="+localStorage.getItem('user_id'))

        edit_profile.hidden = true

        edit.addEventListener("click", function () {

            edit_profile.hidden = false
            show_profile.hidden = true
        })

        var back = document.getElementById("back")

        back.addEventListener("click", function () {
            edit_profile.hidden = true
            show_profile.hidden = false
        })

        var logout = document.getElementById("logout")

        logout.addEventListener("click", function () {
            localStorage.clear()
            window.location.href = "connect.php"
        })
    }

    if (document.getElementById("edit_prof")) {

        const edit = document.getElementById("edit_prof")

        edit.addEventListener("submit", function (e) {

            e.preventDefault()
            var xhr = new XMLHttpRequest()
            var data = new FormData(this)
        
            xhr.onreadystatechange = function () {

                if (this.readyState == 4 && this.status == 200) {
                    var res = this.response
                    if (res.succes === 1) {
                        alert(res.msg)
                        window.location.href = "profil.php";
                    }
                    if (res.succes === 0) {
                        e.preventDefault()
                        alert(res.msg)
                    }
                } else if (this.response == 4) {
                    alert("une erreur est survenue !")
                }
            }
        
            xhr.open("POST", "api/create/update.php")
            xhr.responseType = "json"
            xhr.send(data)
        })
    }
}