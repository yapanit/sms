$(document).ready(function () {
  // Display
  $("#announcement_data").DataTable({
    //change id
    processing: true,
    serverSide: true,
    serverMethod: "post",
    ajax: {
      url: "fetch.php",
      type: "POST",
    },
    // change columns
    columns: [
      { data: "title" },
      { data: "description" },
      { data: "created_at" },
      { data: "updated_at" },
      { data: "edit" },
      { data: "delete" },
    ],
    columnDefs: [
      {
        targets: [4, 5], //change to column
        orderable: false,
      },
    ],
  });

  // Add
  $("#add_data").click(function () {
    var options = {
      ajaxPrefix: "",
    };
    new Dialogify("add_data_form.php", options)
      .title("Create New Post")
      .buttons([
        {
          text: "Cancel",
          click: function (e) {
            this.close();
          },
        },
        {
          text: "Create Post",
          type: Dialogify.BUTTON_PRIMARY,
          click: function (e) {
            var form_data = new FormData();
            // need change
            form_data.append("title", $("#title").val());
            form_data.append("description", $("#description").val());

            $.ajax({
              method: "POST",
              url: "insert_data.php",
              data: form_data,
              dataType: "json",
              contentType: false,
              cache: false,
              processData: false,
              success: function (data) {
                if (data.error != "") {
                  $("#form_response").html(
                    '<div class="alert alert-danger">' + data.error + "</div>"
                  );
                } else {
                  $("#form_response").html(
                    '<div class="alert alert-success">' +
                      data.success +
                      "</div>"
                  );
                  dataTable.ajax.reload();
                }
              },
            });
          },
        },
      ])
      .showModal();
  });
  // Update
  $(document).on("click", ".update", function () {
    var id = $(this).attr("id");
    $.ajax({
      url: "fetch_single_data.php",
      method: "POST",
      data: {
        id: id,
      },
      dataType: "json",
      success: function (data) {
        localStorage.setItem("title", data[0].title);
        localStorage.setItem("description", data[0].description);

        var options = {
          ajaxPrefix: "",
        };
        new Dialogify("edit_data_form.php", options)
          .title("Edit Post")
          .buttons([
            {
              text: "Cancel",
              click: function (e) {
                this.close();
              },
            },
            {
              text: "Save",
              type: Dialogify.BUTTON_PRIMARY,
              click: function (e) {
                var form_data = new FormData();
                form_data.append("title", $("#title").val());
                form_data.append("description", $("#description").val());
                form_data.append("id", data[0].id);

                $.ajax({
                  method: "POST",
                  url: "update_data.php",
                  data: form_data,
                  dataType: "json",
                  contentType: false,
                  cache: false,
                  processData: false,
                  success: function (data) {
                    if (data.error != "") {
                      $("#form_response").html(
                        '<div class="alert alert-danger">' +
                          data.error +
                          "</div>"
                      );
                    } else {
                      $("#form_response").html(
                        '<div class="alert alert-success">' +
                          data.success +
                          "</div>"
                      );
                      dataTable.ajax.reload();
                    }
                  },
                });
              },
            },
          ])
          .showModal();
      },
    });
  });
  // Delete
  $(document).on("click", ".delete", function () {
    var id = $(this).attr("id");
    Dialogify.confirm(
      "<h3 class='text-danger'><b>Are you sure you want to remove this data?</b></h3>",
      {
        ok: function () {
          $.ajax({
            url: "delete_data.php",
            method: "POST",
            data: {
              id: id,
            },
            success: function (data) {
              Dialogify.alert(
                '<h3 class="text-success text-center"><b>Data has been deleted</b></h3>'
              );
              dataTable.ajax.reload();
            },
          });
        },
        cancel: function () {
          this.close();
        },
      }
    );
  });
});
