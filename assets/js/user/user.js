$(function () {
	$("#change-password").on("click", function (e) {
		$("#change_form").trigger("reset");

		$(".password-card").toggleClass("hide", false);
		$(".profile-card").toggleClass("hide", true);

		e.preventDefault();
	});

	$("#edit-profile").on("click", function (e) {
		$(".profile-card").toggleClass("hide", false);
		$(".password-card").toggleClass("hide", true);

		e.preventDefault();
	});

	$("#change-reset").on("click", function () {
		$(".password-card").toggleClass("hide", true);
	});

	$("#profile-reset").on("click", function () {
		$(".profile-card").toggleClass("hide", true);
	});

	function readURL(input) {
		if (input.files && input.files[0]) {
			console.log(input);
			var reader = new FileReader();

			reader.onload = function (e) {
				$(".img-thumbnail").attr("src", e.target.result);
			};

			reader.readAsDataURL(input.files[0]); // convert to base64 string
		}
	}

	$("#image").on("change", function (e) {
		console.log(e.target.files[0]);
		let fileName = e.target.files[0].name;
		$(this).next(".custom-file-label").html(fileName);

		readURL(this);
	});

	$("#change_form").on("submit", function (e) {
		e.preventDefault();

		$(".old-password-error").html("");
		$(".newpassword-1-error").html("");
		$(".newpassword-2-error").html("");

		let url = $(this).attr("action");
		let formData = new FormData(this);

		$.ajax({
			url: url,
			method: "POST",
			dataType: "JSON",
			processData: false,
			contentType: false,
			data: formData,
			success: function (response) {
				console.log(response);
				if (response.result == 400) {
					$(".old-password-error").html(response.message.oldPassword);
					$(".newpassword-1-error").html(response.message.password1);
					$(".newpassword-2-error").html(response.message.password2);

					$("#old-password, #newpassword-1, #newpassword-2").val("");
				} else if (response.result == 404) {
					$("#old-password, #newpassword-1, #newpassword-2").val("");

					Swal.fire({
						icon: "warning",
						width: 600,
						padding: "2em",
						title: response.message.notif,
						html: response.message.alert,
					});
				} else {
					Swal.fire({
						icon: "success",
						width: 600,
						padding: "2em",
						title: "Change password success!",
						html: "Please keep your password secretly, do not let anyone knowing your password.",
					}).then((result) => {
						document.location.href = base_url + "user";
					});
				}
			},
		});
	});

	$("#form-edit-profile").on("submit", function (e) {
		e.preventDefault();

		$(".error_nama").html("");
		$(".error_file").html("");

		let url = $(this).attr("action");
		let formData = new FormData(this);

		$.ajax({
			url: url,
			method: "POST",
			dataType: "JSON",
			data: formData,
			mimeType: "multipart/form-data",
			contentType: false,
			processData: false,
			success: function (hasil) {
				console.log(hasil);
				if (hasil.result == 400) {
					$(".error_nama").html(hasil.message.name);
					$(".error_file").html(hasil.message.img);
				} else {
					Swal.fire({
						icon: "success",
						width: 600,
						padding: "2em",
						title: "Update Profile " + hasil.message,
						html: "Selamat, profile kamu berhasil di update!.",
					}).then((result) => {
						location.reload();
					});
				}
			},
			error: function (hasil) {
				console.log("error", hasil);
			},
		});
	});
});
