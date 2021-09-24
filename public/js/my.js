function submitFrm(frmObj) {
    let parent = $("#questions");
    frmUrl = $(frmObj).attr("action");
    var frmData = new FormData($(frmObj)[0]);
    $.ajax({
        method: "post",
        url: frmUrl,
        data: frmData,
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        beforeSend: function () {
            parent.find(".modal-loader").show();
        },
        complete : function(){
            parent.find(".modal-loader").hide();
        },
        success: function (json_array) {
            if (json_array.status) {
                parent.find("span").html(json_array.html);
            } else {
                $.notify(json_array.message, "error");
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            var json_array = JSON.parse(xhr.responseText);
            $.notify(json_array.message, "error");
        },
    });
    return false;
}
