window.onload = function() {

    if (document.querySelector(".profil")) {
        
        var logout = document.getElementById("logout")

        logout.addEventListener("click", function () {
            storage.removeItem("user_id");
        })
    }
}