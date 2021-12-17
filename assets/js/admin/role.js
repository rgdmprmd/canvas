$(function () {
	function get_role() {
		$.ajax({
			url: base_url + "admin/ajaxGetAllRole",
			method: "POST",
			dataType: "JSON",
			success: function (hasil) {
				$("#table-role tbody").html(hasil);
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
			success: function (hasil) {
				$("#role_id").val(hasil.role_id);
				$("#role_nama").val(hasil.role_nama);
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
			success: function (hasil) {
				console.log(hasil);
				$(".role-nama").html(hasil.role.role_nama);
				$("#table-access tbody").html(hasil.menu);
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
			success: function (hasil) {
				console.log(hasil);

				Swal.fire({
					icon: "success",
					width: 600,
					padding: "2em",
					title: "Access changed!",
					html: "Congratulations, you changed some menu access.",
				});
			},
		});
	});

	$(document).on("click", ".close-access", function () {
		location.reload();
	});
});
