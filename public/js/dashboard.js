///Delete
$(document).on("click", ".delete_btn", function (e) {
    e.preventDefault();
    var id = $(this).attr("ajax_id");
    var url = $(this).attr("ajax_url");
    console.log(id);
    swal({
        title: "{{__('site.are_you_sure')}}",
        icon: "warning",
        buttons: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((value) => {
        if (value) {
            axios
                .delete(url)
                .then((res) => {
                    if (res.data.status === true) {
                        $(`.Row${id}`).remove();
                        swal({
                            title: res.data.msg,
                            icon: "success",
                        });
                    } else {
                        console.error(res.data.msg);
                        swal({
                            title: res.data.msg,
                            icon: "error",
                        });
                    }
                })
                .catch((res) => {
                    console.error(res.data);
                });
        }
    });
});
