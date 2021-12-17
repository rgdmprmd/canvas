$(function () {
	$(document).on("submit", "#change_form", function (e) {
		e.preventDefault();

		let formData = new FormData(this);
		let url = $(this).attr("action");

		$(".password1-error").html("");
		$(".password2-error").html("");

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
					$(".password1-error").html(response.message.password1);
					$(".password2-error").html(response.message.password2);
				} else {
					Swal.fire({
						icon: "success",
						width: 800,
						padding: "2em",
						title: "Change password success!",
						html: "Password has been changed, please keep your password carefully in the future.",
					}).then((result) => {
						document.location.href = base_url + "auth";
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
