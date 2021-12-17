$(function () {
	$(document).on("submit", "#forgot_form", function (e) {
		e.preventDefault();

		let formData = new FormData(this);
		let url = $(this).attr("action");
		$(".email-error").html("");

		$.ajax({
			url: url,
			method: "POST",
			dataType: "JSON",
			processData: false,
			contentType: false,
			data: formData,
			beforeSend: function (response) {
				$(".btn-user").attr("disabled", true);

				Swal.fire({
					title: "Loading",
					text: "Please wait, we working on it.",
					imageUrl: base_url + "assets/img/loading_spinner.gif",
					showConfirmButton: false,
					allowOutsideClick: false,
				});
			},
			success: function (response) {
				Swal.close();
				$(".btn-user").attr("disabled", false);

				if (response.result == 400) {
					$(".email-error").html(response.message.email);
				} else if (response.result == 401) {
					Swal.fire({
						icon: "warning",
						width: 600,
						padding: "2em",
						title: "Oops, wrong email!",
						html:
							"<span class='text-primary'>" +
							hasil.error +
							"</span> is not registered or activated yet.",
					});
				} else {
					Swal.fire({
						icon: "info",
						width: 800,
						padding: "2em",
						title: "Forgot password success, but..!",
						html: "It's not finish yet, you must check your email to reset your password.",
					}).then((result) => {
						document.location.href = base_url + "auth/forgotpassword";
					});
				}
			},
			error: function (x, h, r) {
				Swal.fire({
					icon: "error",
					title: "Oops!",
					text: r,
					showConfirmButton: true,
					allowOutsideClick: false,
				});
			},
		});
	});
});
