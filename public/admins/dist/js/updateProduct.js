//add m
$(".image-new-dish").change(function () {
    // Get the selected files and clear any existing previews
    const files = $(this)[0].files;
    $("#image-preview-container").empty();
    // Loop through all selected files
    for (const file of files) {
      // Create a URL for the file
      const url = URL.createObjectURL(file);

      // Create an image element for the preview
      const preview = $("<img>")
        .attr("src", url)
        .attr("alt", file.name)
        .attr("class", "mr-2")
        .attr("style", "height:100%; aspect-raito:1/1 ");

      // Append the image element to the preview container
      $("#image-preview-container").append(preview);
    }
  });

  let imageDelete = [];
  //remove image in update
  $(document).on("click", ".btn__delete--imagedish", function (e) {
    imageDelete = [...imageDelete, $(this).attr("data-id")];
    $(this).parent().remove();
  });

  //add image in update dish

  $(".image-update-dish").change(function () {
    // Get the selected files
    const files = $(this)[0].files;

    // Loop through all selected files
    for (const file of files) {
      // Create a URL for the file
      const url = URL.createObjectURL(file);

      // Create an image element for the preview
      const preview =
        '<div style="height:90% ; aspect-ratio:1/1">' +
        `<img style="height:90% ; aspect-ratio:1/1" id="{{$i->id}}" class="mr-2 image-dish-update" src=${url} alt="{{$i->id}}">` +
        '<button style="width:90%" class="btn btn-danger btn__delete--imagedish">Delete</button>' +
        "</div>";

      // Append the image element to the preview container
      $("#image-preview-container").append(preview);
    }
  });

  //add image delete to form  update dish
  $("#form__updatedish").one("submit", (e) => {
    e.preventDefault();
    if (imageDelete.length !== 0) {
      for (const file of imageDelete) {
        let data = $("<input>")
          .attr("value", file)
          .attr("name", "imagesDelete[]")
          .attr("type", "hidden");
        $("#form__updatedish").append(data);
      }
    }
    $(this).submit();
  });

  // sen databutton open modal delete
  $(".btn_delete_dish").on("click", function (event) {
    let data = $(this).attr("data");
    $(".action-delete-dish").attr("href", `product/delete-dish/${data}`);
    $(".notify__modal--oldDish").html(
      "Are your sure" + "<b> deleted </b>" + "alsway this dish ?"
    );
  });

  // sen databutton open modal restore
  $(".btn_restore_dish").on("click", function (event) {
    let data = $(this).attr("data");
    $(".action-delete-dish").attr("href", `product/restore/${data}`);
    $(".notify__modal--oldDish").html(
      "Are your sure" + "<b> restore </b>" + " this dish ?"
    );
    $(".action-delete-dish").text("Restore");
    $(".action-delete-dish").attr("class", " btn btn-primary  btn-sm");
  });

  //// sent databutton open modal delete user
  $(".btn_delete_user").on("click", function (event) {
    let data = $(this).attr("data");
    $(".action-delete-user").attr("href", `user/delete/${data}`);
    $(".notify__modal--oldDish").html(
      "Are your sure" + "<b> deleted </b>" + "alsway this dish ?"
    );
  });

  /// sent databutton open modal delete ingredient
  $(".btn_delete_ingredient").on("click", function (event) {
    let data = $(this).attr("data");
    $(".action-delete-ingredient").attr("href", `warehouse/delete/${data}`);
    $(".notify__modal--oldDish").html(
      "Are your sure" + "<b> deleted </b>" + "alsway this dish ?"
    );
  });

  /// sent databutton open restore user modal
  $(".btn_restore_user").on("click", function () {
    let data = $(this).attr("data");
    $(".action-restore-user").attr("href", `user/restore/${data}`);
  });

  //add image banner
  $(".image-new-banner").change(function () {
    // Get the selected files and clear any existing previews
    const files = $(this)[0].files;

    $("#banner__preview").empty();

    // Loop through all selected files
    for (const file of files) {
      // Create a URL for the file
      const url = URL.createObjectURL(file);

      // Create an image element for the preview
      const preview = $("<img>")
        .attr("src", url)
        .attr("alt", file.name)
        .attr("style", "height:90%; aspect-raito:1/2 ;margin: auto  ");

      // Append the image element to the preview container
      $("#banner__preview").append(preview);
    }
  });

  //delete banner
  $(".btn_delete_banner").on("click", function (event) {
    let data = $(this).attr("data");
    $(".action-delete-banner").attr("href", `banner/delete/${data}`);
  });
  //delete bill
  // $(".btn_delete_bill").on("click", function (event) {
  //   let data = $(this).attr("data");
  //   $(".action-delete-bill").attr("href", `bill/delete/${data}`);
  // });
