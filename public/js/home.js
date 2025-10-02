const remove_job_modal = $("#remove_job_modal");

remove_job_modal.on("show.bs.modal", (e) => {
    remove_job_modal.find(".modal-body").toggleClass("d-none", true);
    remove_job_modal.data("id", $(e.relatedTarget).data("id"));
});

$("#remove_job").on("click", () => {
    const data = {
        id: remove_job_modal.data("id")
    };

    $.ajax({
        url: "/job/delete",
        type: "POST",
        contentType: "application/json",
        data: JSON.stringify(data),
        beforeSend: () => {
            remove_job_modal.find(".modal-body").toggleClass("d-none", false);
            remove_job_modal.find(".spinner-border").removeClass("d-none", false);
        },
        success: (response) => {
            if (response.success) {
                $(`.job-${data.id}`).remove();

                remove_job_modal.modal("hide");
            } else {
                handleError();
            }
        },
        error: handleError
    });

});

const handleError = () => {
    remove_job_modal.find(".spinner-border").toggleClass("d-none", true);
    remove_job_modal.find(".message").toggleClass("d-none", false);
}