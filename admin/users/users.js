$(document).ready(function () {
  // Display
  $("#user_data").DataTable({
    processing: true,
    serverSide: true,
    serverMethod: "post",
    ajax: {
      url: "fetch.php",
      type: "POST",
    },
    columns: [
      { data: "fname" },
      { data: "lname" },
      { data: "email" },
      { data: "phone_number" },
      { data: "edit" },
      { data: "delete" },
    ],
    columnDefs: [
      {
        targets: [4, 5],
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
      .title("Add New User")
      .buttons([
        {
          text: "Cancel",
          click: function (e) {
            this.close();
          },
        },
        {
          text: "Add",
          type: Dialogify.BUTTON_PRIMARY,
          click: function (e) {
            var form_data = new FormData();
            form_data.append("fname", $("#fname").val());
            form_data.append("lname", $("#lname").val());
            form_data.append("email", $("#email").val());
            form_data.append("phone_number", $("#phone_number").val());
            form_data.append("password", $("#password").val());

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
        localStorage.setItem("fname", data[0].fname);
        localStorage.setItem("lname", data[0].lname);
        localStorage.setItem("email", data[0].email);
        localStorage.setItem("phone_number", data[0].phone_number);
        localStorage.setItem("password", data[0].password);

        var options = {
          ajaxPrefix: "",
        };
        new Dialogify("edit_data_form.php", options)
          .title("Edit User Data")
          .buttons([
            {
              text: "Cancel",
              click: function (e) {
                this.close();
              },
            },
            {
              text: "Update",
              type: Dialogify.BUTTON_PRIMARY,
              click: function (e) {
                var form_data = new FormData();
                form_data.append("fname", $("#fname").val());
                form_data.append("lname", $("#lname").val());
                form_data.append("email", $("#email").val());
                form_data.append("phone_number", $("#phone_number").val());
                form_data.append("password", $("#password").val());
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
