window.onload = function() {

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

    if (document.getElementById("create")) {

        const create = document.getElementById("create")
        const password = document.getElementById("password")
        const verify = document.getElementById("verify")
        const check = document.getElementsByName("hobby[]")
        
        create.addEventListener("submit", function (e) {
            var count = 0

            e.preventDefault();
            
            check.forEach(element => {
                if (element.checked) {
                    count ++
                }
            })
            if (count === 0) {
                alert("veuillez selectionner un loisir")
            } else {
                
                if (password.value == verify.value && verify.value != "" && password.value != "") {
    
                    document.getElementById('message').style.color = 'green'
                    document.getElementById('message').innerHTML = 'identique'
    
                    e.preventDefault()
                    var xhr = new XMLHttpRequest()
                    var data = new FormData(this)
                
                    xhr.onreadystatechange = function () {
        
                        if (this.readyState == 4 && this.status == 200) {
                            var res = this.response
        
                            if (res.succes === 1) {
                                alert("votre compte a bien été créer")
                                window.location.href = "connect.php";
                            }
                            if (res.succes === 0) {
                                e.preventDefault()
                                alert(res.msg)
                            }
        
                        } else if (this.response == 4) {
                            alert("une erreur est survenue !")
                        } else if (this.response == 500) {
                            alert("connexion a la base de donnée impossible")
                        }
                    }
                
                    xhr.open("POST", "api/create/create_user.php")
                    xhr.responseType = "json"
                    xhr.send(data)
                    return true
    
                } else if (password.value === "" && verify.value === "") {
                    alert("ne peut être vide")
                    return false
                } else {
                    alert("les mot de passe ne correspondent pas")
                    return false
                }
            }
        })
    }

    if (document.getElementById("connect")) {

        const connect = document.getElementById("connect")

        connect.addEventListener("submit", function (e) {

            e.preventDefault()
            var xhr = new XMLHttpRequest()
            var data = new FormData(this)

            xhr.onreadystatechange = function () {

                if (this.readyState === 4 && this.status === 200) {
                    var res = this.response
                
                    if (res.succes === 1) {
                        localStorage.setItem("user_id", res.user_id)
                        window.location.href = "search.php";
                    }
                    if (res.succes === 0) {
                        e.preventDefault()
                        alert(res.msg)
                    }
                
                } else if (connect.response === 4) {
                    alert("une erreur est survenue !")
                }
            }

            xhr.open("POST", "api/create/login.php")
            xhr.responseType = "json"
            xhr.send(data)
        })
    }
}