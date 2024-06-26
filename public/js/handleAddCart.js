$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");

    $.ajax({
        url: "http://localhost:8000/cart/showAjax",
        type: "get",

        headers: {
            "X-CSRF-Token": csrfToken,
        },

        success: function (response) {
            console.log(response);
            $(".cart__quantity--number").text(response.items.length);
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });

    $(".btn__add--card").on("click", (e) => {
        e.preventDefault();
        let formElement = $(document.activeElement);
        let product_id = formElement
            .parent()
            .parent()
            .find(".product_id")
            .val();

        let quantity = formElement
            .parent()
            .parent()
            .find(".cart-quantity")
            .val();

        $.ajax({
            url: "http://localhost:8000/cart/addAjax",
            type: "POST",
            data: { quantity, product_id },

            headers: {
                "X-CSRF-Token": csrfToken,
            },

            success: function (response) {
                $(".cart__quantity--number").text(response[0].items.length);
                localStorage.setItem("qty", response[0].items.length);
            },
            error: function (xhr, status, error) {
                console.log(error);
            },
        });
    });
});
