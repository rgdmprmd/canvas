$(function () {
	$("#form-login").on("submit", function (e) {
		e.preventDefault();

		let url = $(this).attr("action");
		let formData = new FormData(this);

		// console.log(formData);
		// formData = formData.forEach((ex) => (ex = encrypt(ex)));

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
					$(".error_email").html(response.message.email);
					$(".error_password").html(response.message.password);

					$("#password").val("");
				} else if (response.result == 401) {
					Swal.fire({
						icon: "warning",
						width: 800,
						padding: "2em",
						title: "Oops, email salah!",
						html:
							"<span class='text-primary'>" +
							response.message +
							"</span> tidak terdaftar. Kamu harus registrasi dulu.",
					}).then((result) => {
						location.reload();
					});
				} else if (response.result == 402) {
					Swal.fire({
						icon: "warning",
						width: 800,
						padding: "2em",
						title: "Oops, email kamu belum aktif!",
						html:
							"<span class='text-primary'>" +
							response.message +
							"</span> belum diaktivasi. Silahkan cek email kamu untuk melakukan aktivasi.",
					}).then((result) => {
						location.reload();
					});
				} else if (response.result == 403) {
					Swal.fire({
						icon: "warning",
						width: 800,
						padding: "2em",
						title: "Oops, password salah!",
						html: "Kamu lupa password? sebaiknya kamu coba fitur lupa password.",
					}).then((result) => {
						$("#password").val("");
					});
				} else if (response.result == 200) {
					if (response.message == 1) {
						document.location.href = base_url + "admin";
					} else {
						document.location.href = base_url + "user";
					}
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

	const wrongToken = $(".wrong-token").data("wrongtoken");
	if (wrongToken) {
		Swal.fire({
			icon: "warning",
			width: 600,
			padding: "2em",
			title: wrongToken + " Failed!",
			html: "Your token is not valid for some reason.",
		});
	}
	const wrongEmail = $(".wrong-email").data("wrongemail");
	if (wrongEmail) {
		Swal.fire({
			icon: "warning",
			width: 800,
			padding: "2em",
			title: "Oops, email salah!",
			html:
				"<span class='text-primary'>" +
				wrongEmail +
				"</span> tidak terdaftar. Kamu harus registrasi dulu.",
		});
	}
	const expiredToken = $(".expired-token").data("expiredtoken");
	if (expiredToken) {
		Swal.fire({
			icon: "warning",
			width: 600,
			padding: "2em",
			title: "Activation Failed!",
			html: "Your token is expired, please register again and make sure activate it before 24 hours.",
		});
	}
	const successToken = $(".success-token").data("successtoken");
	if (successToken) {
		Swal.fire({
			icon: "success",
			width: 600,
			padding: "2em",
			title: "Activation Success!",
			html:
				"<span class='text-primary'>" +
				successToken +
				"</span> activation success, please login.",
		});
	}
});
