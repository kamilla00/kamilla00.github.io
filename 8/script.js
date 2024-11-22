
$(function () {
    $(".formcarryForm").submit(function (e) {
        var form = $(this);
        var href = form.attr("action");
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: href,
            data: new FormData(this),
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.code === 200) {
                    alert("Sended successfully");

                    form[0].reset();
                } else {
                    alert("Error: " + response.message);
                }
            },
            error: function (err, textStatus) {
                const error = err.responseJSON;

                $.each(error.errors, function (key) {
                    var field = $('[name="' + key + '"]');
                    field.addClass("fc-field-error");
                });

                alert(
                    "Request fail, " +
                    errorObject.title +
                    ": " +
                    errorObject.message
                );
            },
            complete: function () {},
        });
    });
});