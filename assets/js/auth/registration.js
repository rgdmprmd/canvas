$(function () {
	$("#form-registration").on("submit", function (e) {
		e.preventDefault();

		$(".nama-error").html("");
		$(".email-error").html("");
		$(".password-error").html("");

		let url = $(this).attr("action");
		let formData = new FormData(this);

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
			success: function (hasil) {
				Swal.close();
				$(".btn-user").attr("disabled", false);

				if (hasil.result == false) {
					$(".nama-error").html(hasil.message.nama);
					$(".email-error").html(hasil.message.email);
					$(".password-error").html(hasil.message.password);

					$("#password1, #password2").val("");
				} else {
					Swal.fire({
						icon: "success",
						width: 600,
						padding: "2em",
						title: "Registrasi Berhasil!",
						html: "Silahkan cek email kamu untuk melakukan aktivasi. Email aktivasi akan expired dalam 24 jam.",
					}).then((result) => {
						// Jika tombol ya ditekan, maka redirect bedasarkan href tombol yang diklik
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
