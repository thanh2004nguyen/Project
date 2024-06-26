$(document).ready(function () {
    // $(".form__add--card").hide();

    //     $(".handleHover").hover(
    //         function () {
    //             $(this).children(".form__add--card").show(300);
    //         },
    //         function () {
    //             $(this).children(".form__add--card").hide(800);
    //         }
    //     );

    $(".i-s-2").hide();
    $(".i-s-1").show();

    $(".btn-show-provider").click(function () {
        $(".dropdown-content--provider").toggle(300);
        $(".i-s-1").toggle();
        $(".i-s-2").toggle();
    });

    $(".i-s-2--price").hide();
    $(".i-s-1--price").show();

    $(".btn-show-price").click(function () {
        $(".dropdown-content--price").toggle(300);
        $(".i-s-1--price").toggle();
        $(".i-s-2--price").toggle();
    });

    $(".i-s-2--type").hide();
    $(".i-s-1--type").show();

    $(".btn-show-type").click(function () {
        $(".dropdown-content--type").toggle(300);
        $(".i-s-1--type").toggle();
        $(".i-s-2--type").toggle();
    });
});
