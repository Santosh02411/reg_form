$(document).ready(function () {
  $("#registrationForm").on("submit", function (e) {
    e.preventDefault();

    var formData = $(this).serialize();

    // AJAX request to submit.php
    $.ajax({
      type: "POST",
      url: "submit.php",
      data: formData,
      success: function (response) {
        if (response.indexOf("Registration Successful!") > -1) {
          // If successful, animate the success message and reset the form
          $("#result").html(response).fadeIn();
          $("#registrationForm")[0].reset();
          animateSuccess();
        } else {
          // In case of any other error message
          $("#result").html(response).fadeIn();
        }
      },
      error: function () {
        $("#result").html("<p>Error: Please try again!</p>").fadeIn();
      },
    });
  });
});

// Success animation
function animateSuccess() {
  $(".result-container")
    .css({
      border: "2px solid #6a11cb",
      backgroundColor: "#e6f2ff",
    })
    .delay(100)
    .animate(
      {
        opacity: 1,
      },
      600
    );
}
