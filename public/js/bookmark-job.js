$(".bookmark-job-button").click(function (event) {
    event.preventDefault();
    //console.log(event.originalEvent.srcElement.dataset);
    //const icon = document.querySelector(".bookmark-job-button i");
    //const icon = document.querySelector(".bookmark-job-button i");
    const $btn = $(this);
    let icon = $btn.find("i")[0];
    console.log(icon);
    //console.log("jobId:", $(this).data("job-id")); // DEBUG

    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $btn.data("token"),
        },
        url: "/job/update_wishlist",
        // data: {
        //     token: event.originalEvent.srcElement.dataset.token,
        //     user_id: event.originalEvent.srcElement.dataset.user_id,
        //     job_id: event.originalEvent.srcElement.dataset.job_id,
        // },
        data: {
            user_id: $btn.data("user-id"),
            job_id: $btn.data("job-id"),
        },
        //dataType: "json",
        type: "POST",
        success: function (result) {
            console.log(result.message);
            //if (result.message === "Job successfully added to Saved Job List") {
            console.log(";:");
            icon.classList.toggle("fa-regular");
            icon.classList.toggle("fa-solid");

            // }
            // if (result.message === "removed Job from Saved Jobs List") {
            //     icon.classList.toggle("fa-solid");
            //     icon.classList.toggle("fa-regular");
            // }
            // $("#div1").html(result);
        },
        error: function (err) {
            console.error(err);
        },
    });
});
