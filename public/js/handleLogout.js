$("#form__logout").on("submit", (e) => {
    var delete_cookie = function (name) {
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:01 GMT;";
    };

    e.preventDefault();
    delete_cookie("ch");
    delete_cookie("nm");
    var form = document.getElementById("form__logout");
    form.submit();
});
