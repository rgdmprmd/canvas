$(function () {
	function get_role() {
		$.ajax({
			url: base_url + "admin/ajaxGetAllRole",
			method: "POST",
			dataType: "JSON",
			beforeSend: function (response) {
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

				$("#table-role tbody").html(hasil);
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
	}

	get_role();

	$(document).on("click", ".role-add", function () {
		$(".judulModalRole").html("Add New Role");
		$(".submitRole").html("Add Role");
		$(".form-role").attr("action", base_url + "admin/addRole");

		$("#role_id").val("");
		$("#role_nama").val("");
	});

	$(document).on("click", ".role-edit", function () {
		$(".judulModalRole").html("Edit Role");
		$(".submitRole").html("Edit Role");
		$(".form-role").attr("action", base_url + "admin/updateRole");

		const id = $(this).data("id");

		$.ajax({
			url: base_url + "admin/ajaxGetRoleById",
			method: "POST",
			dataType: "JSON",
			data: {
				idJson: id,
			},
			beforeSend: function (response) {
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

				$("#role_id").val(hasil.role_id);
				$("#role_nama").val(hasil.role_nama);
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

	$(document).on("click", ".role-access", function () {
		const role_id = $(this).data("id");

		$.ajax({
			url: base_url + "admin/ajaxGetRoleAccess",
			method: "POST",
			dataType: "JSON",
			data: {
				role_id: role_id,
			},
			beforeSend: function (response) {
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

				$(".role-nama").html(hasil.role.role_nama);
				$("#table-access tbody").html(hasil.menu);
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

	$(document).on("click", ".cekboxs", function () {
		// Tangkap idMenu dan idRole yang dikirimkan
		const menuId = $(this).data("menu");
		const roleId = $(this).data("role");

		// Lalu oper lagi ke method changeAccess() dengan type POST
		$.ajax({
			url: base_url + "admin/changeAccess",
			type: "POST",
			data: {
				menuId: menuId,
				roleId: roleId,
			},
			beforeSend: function (response) {
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

				Swal.fire({
					icon: "success",
					width: 600,
					padding: "2em",
					title: "Access changed!",
					html: "Congratulations, you changed some menu access.",
				});
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

	$(document).on("click", ".close-access", function () {
		location.reload();
	});
});
