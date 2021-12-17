$(function () {
	let statsMenu = 2;
	let sercMenu = "";

	let statsSubmenu = 2;
	let sercSubmenu = "";

	function get_menu(url, status, search) {
		if (!url) {
			url = base_url + "admin/ajaxGetAllMenu";
		}

		$.ajax({
			url: url,
			method: "POST",
			dataType: "JSON",
			data: {
				status: status,
				search: search,
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
			success: function (response) {
				Swal.close();

				$("#table-menu tbody").html(response.row);
				$(".paging-menu").html(response.message);
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

	function get_submenu(url, status, search) {
		if (!url) {
			url = base_url + "admin/ajaxGetAllSubmenu";
		}

		$.ajax({
			url: url,
			method: "POST",
			dataType: "JSON",
			data: {
				status: status,
				search: search,
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
			success: function (response) {
				Swal.close();

				$("#table-submenu tbody").html(response.row);
				$(".paging-submenu").html(response.message);
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

	get_menu("", statsMenu, sercMenu);
	get_submenu("", statsSubmenu, sercSubmenu);

	$(document).on("click", ".paging-menu>nav>ul.pagination>li>a", function () {
		let href = $(this).attr("href");
		get_menu(href, 2, sercMenu);

		return false;
	});

	$(document).on(
		"click",
		".paging-submenu>nav>ul.pagination>li>a",
		function () {
			let href = $(this).attr("href");
			get_submenu(href, statsSubmenu, sercSubmenu);

			return false;
		}
	);

	$(document).on("click", ".menu-status", function (e) {
		let text = $(this).text();
		statsMenu = $(this).data("menu");

		$("#menu-dropdown").html(text);

		get_menu("", statsMenu, sercMenu);

		e.preventDefault();
	});

	$(document).on("keyup", ".search-menu", function (e) {
		sercMenu = $(this).val();
		get_menu("", statsMenu, sercMenu);

		e.preventDefault();
	});

	$(document).on("click", ".submenu-status", function (e) {
		let text = $(this).text();
		statsSubmenu = $(this).data("submenu");

		$("#submenu-dropdown").html(text);

		get_submenu("", statsSubmenu, sercSubmenu);

		e.preventDefault();
	});

	$(document).on("keyup", ".search-submenu", function (e) {
		sercSubmenu = $(this).val();
		get_submenu("", statsSubmenu, sercSubmenu);

		e.preventDefault();
	});

	/*============================== CRUD ==============================*/
	$(document).on("click", ".menu-add", function () {
		$(".judulModalMenu").html("Add New Menu");
		$(".submitMenu").html("Add Menu");
		$(".form-menu").attr("action", base_url + "admin/addMenu");

		$(".form-menu").trigger("reset");
	});

	$(document).on("click", ".menu-edit", function () {
		$(".judulModalMenu").html("Edit Menu");
		$(".submitMenu").html("Edit Menu");
		$(".form-menu").attr("action", base_url + "admin/updateMenu");

		const id = $(this).data("id");

		$.ajax({
			url: base_url + "admin/ajaxGetMenuById",
			method: "POST",
			dataType: "JSON",
			data: {
				idJson: id,
			},
			success: function (response) {
				$("#menu_id").val(response.menu_id);
				$("#menu").val(response.menu_nama);
				$("#menu_status").val(response.menu_status);
			},
		});
	});

	$(document).on("click", ".submenu-add", function () {
		$(".judulModalSubmenu").html("Add New Submenu");
		$(".submitSubmenu").html("Add Submenu");
		$(".form-submenu").attr("action", base_url + "admin/addSubmenu");
		$(".form-submenu").trigger("reset");

		// $('#id_menu').val(0);
		// $('#submenu_id').val('');
		// $('#submenu_nama').val('');
		// $('#submenu_url').val('');
		// $('#submenu_icon').val('');
		// $('#submenu_status').val(1);
	});

	$(document).on("click", ".submenu-edit", function () {
		$(".judulModalSubmenu").html("Edit Submenu");
		$(".submitSubmenu").html("Edit Submenu");
		$(".form-submenu").attr("action", base_url + "admin/updateSubmenu");

		const id = $(this).data("id");

		$.ajax({
			url: base_url + "admin/ajaxGetSubmenuById",
			method: "POST",
			dataType: "JSON",
			data: {
				idJson: id,
			},
			success: function (hasil) {
				$("#id_menu").val(hasil.menu_id);
				$("#submenu_id").val(hasil.submenu_id);
				$("#submenu_nama").val(hasil.submenu_nama);
				$("#submenu_url").val(hasil.submenu_url);
				$("#submenu_icon").val(hasil.submenu_icon);
				$("#submenu_status").val(hasil.submenu_status);
			},
		});
	});

	$(document).on("submit", ".form-menu", function (e) {
		e.preventDefault();

		$(".error_nama").html("");
		$(".error_status").html("");

		let formData = new FormData(this);
		let url = $(this).attr("action");

		$.ajax({
			url: url,
			method: "POST",
			dataType: "JSON",
			data: formData,
			processData: false,
			contentType: false,
			beforeSend: function (response) {
				$(".submitMenu").attr("disabled", true);

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
				$(".submitMenu").attr("disabled", false);

				if (response.result == false) {
					$(".error_nama").html(response.message.menu);
					$(".error_status").html(response.message.menu_status);
				} else {
					Swal.fire({
						icon: "success",
						width: 600,
						padding: "2em",
						title: response.message + " menu berhasil!",
						html: "Selamat, menu baru berhasil di " + response.message + ".",
					}).then((result) => {
						location.reload();
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

	$(document).on("submit", ".form-submenu", function (e) {
		e.preventDefault();

		let formData = new FormData(this);
		let url = $(this).attr("action");

		$.ajax({
			url: url,
			method: "POST",
			dataType: "JSON",
			data: formData,
			processData: false,
			contentType: false,
			beforeSend: function (response) {
				$(".submitSubmenu").attr("disabled", true);

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
				$(".submitSubmenu").attr("disabled", false);

				if (response.result == false) {
					$(".error_submenunama").html(response.message.submenu_nama);
					$(".error_submenuurl").html(response.message.submenu_url);
					$(".error_submenuicon").html(response.message.submenu_icon);
					$(".error_submenustatus").html(response.message.submenu_status);
					$(".error_submenumenu").html(response.message.id_menu);
				} else {
					Swal.fire({
						icon: "success",
						width: 600,
						padding: "2em",
						title: response.message + " submenu berhasil!",
						html: "Selamat, submenu berhasil di " + response.message + ".",
					}).then((result) => {
						location.reload();
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
