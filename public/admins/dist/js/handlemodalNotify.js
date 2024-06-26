// sen databutton open modal delete
$(".btn-block-user").on("click", function (event) {
    let data = $(this).attr("data");
    $(".btn-action-block-user").attr("href", `admin/blockUser/${data}`);
    let status = $(this).attr("block-status");
    $(".btn-action-block-user").text(
        status == 1 ? "Restore User" : "Block User"
    );
    $(".btn-action-block-user").addClass(
        status == 0 ? "btn-danger" : "btn-info"
    );
    $(".notify-text-block-user").text(
        status == 0
            ? "Are you sure block this user ?"
            : "Are you sure restore this user"
    );
});

//delete admin

$(".btn-delete-admin").on("click", function (event) {
    let data = $(this).attr("data");
    $(".btn-action-delete-admin").attr("href", `admin/delete/${data}`);
});
$(".btn-delete-blog").on("click", function (event) {
    let data = $(this).attr("data");
    $(".btn-action-delete-blog").attr("href", `blog/delete/${data}`);
});
