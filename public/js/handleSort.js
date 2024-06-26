const handle = (url) => {
    $.ajax({
        url: url,
        type: "GET",
        success: function (response) {
            let start = 3;
            let showStart = "";

            if (start > 0) {
                for (let i = 0; i <= 5 - start; i++) {
                    showStart += `<i class="fa-solid fa-star"></i>`;
                }
            }

            if (start < 5) {
                for (let i = 0; i < 5 - start; i++) {
                    showStart += `<i class="fa-regular fa-star"></i>`;
                }
            }
            let x = " ";
            $.each(response, function (index, p) {
                x +=
                    `<div class="col col-xl-3  col-lg-4  col-md-6 col-sm-6 " handleHover">
                    <a href="#!productdetail  class="item__shadow">
                        <div class="card shadow-product mb-2 ">
                            <div class="card-body item__container">
                                <a href="">
                                    <img src="${p.images[0].url}" class="border border-primary rounded" alt="error" data-image="1" width="100%" height="240vw">
                                </a>
                                <div class="card-info mb--2">
                                    <div class="product-name h5 text-center" style="width: 100%;">${p.name}</div>

                                    <div class="product-name h5 text-center" style="width: 100%;"> $${p.price} </div>
                                    <div class="rating d-flex justify-content-center mt-3">` +
                    showStart +
                    `</div>

                                </div>
                            </div>
                        </div>

                    </a>

                    <form class="card  mb-2  p-1 form__add--card item__container"  action="http://127.0.0.1:8000/cart/add" method="POST">
                    
                        <div class="buy-action">
                            <div class="quantity">
                                <span style="color: rgb(8, 27, 240)">Stock: </span><input type="number" class="cart-quantity" min="1" value="1" name="quantity">
                            </div>

                            <input type="hidden" name="product_id" value="${p.product_id}">

                            <div class="add-to-cart d-flex justify-content-center mt-2 mb-1" style="width: 100%;">
                                <button class="btn btn-primary" type="submit">Add to cart</button>
                            </div>
                        </div>
                    </form>
                </div>`;
            });

            $("#product-list").html(x);
        },
        error: function (xhr, status, error) {},
    });
};

$(document).ready(function () {
    let providerchecked = [];
    let typechecked = [];
    let checkedValue = 0;
    let sort = "";

    $(".btn--to__submit").on("change", function () {
        if ($(this).attr("name") === "provider") {
            if ($(this).is(":checked")) {
                providerchecked.push($(this).val());
            } else {
                let index = providerchecked.indexOf($(this).val());
                if (index !== -1) {
                    providerchecked.splice(index, 1);
                }
            }
        }

        if ($(this).is(":checked") && $(this).attr("type") === "radio") {
            checkedValue = $(this).val();
        }

        if ($(this).attr("name") == "sort__by") {
            sort = $(this).val();
        }

        if ($(this).attr("name") === "category") {
            if ($(this).is(":checked")) {
                typechecked.push($(this).val());
            } else {
                var index = typechecked.indexOf($(this).val());
                if (index !== -1) {
                    typechecked.splice(index, 1);
                }
            }
        }

        let url = `http://localhost:8000/product/sort-product?price=${checkedValue}`;
        if (providerchecked.length > 0) {
            for (let i = 0; i < providerchecked.length; i++) {
                url += `&provider[]=${providerchecked[i]}`;
            }
        }

        if (typechecked.length > 0) {
            for (let i = 0; i < typechecked.length; i++) {
                url += `&type[]=${typechecked[i]}`;
            }
        }
        if (sort != "") {
            url += `&sort=${sort}`;
        }
        console.log(sort);
        handle(url);
    });
});
