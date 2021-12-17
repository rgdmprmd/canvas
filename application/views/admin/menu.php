<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" id="heading-menu">
                    <h6 class="m-0 font-weight-bold text-primary">Menu</h6>
                </div>

                <div class="card-body" id="collapse-menu">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="dropdown mb-3">
                                <a href="#" role="button" class="btn btn-sm btn-primary menu-add" data-toggle="modal" data-target="#newMenuModal"><i class="fas fa-fw fa-plus"></i> Menu</a>
                                <a class="dropdown-toggle btn btn-sm btn-primary ml-1" href="#" role="button" id="menu-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    All status
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="menu-dropdown">
                                    <div class="dropdown-header">Status menu :</div>
                                    <a class="dropdown-item menu-status" href="#" data-menu="2">All status</a>
                                    <a class="dropdown-item menu-status" href="#" data-menu="1">Active</a>
                                    <a class="dropdown-item menu-status" href="#" data-menu="0">Denied</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control search-menu" placeholder="Cari menu">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 table-responsive">
                            <table id="table-menu" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="50px">#</th>
                                        <th class="text-left">Menu</th>
                                        <th class="text-center" width="100px">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 text-center mt-3">
                            <span class="paging-menu"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" id="heading-submenu">
                    <h6 class="m-0 font-weight-bold text-primary">Submenu</h6>
                </div>

                <div class="card-body" id="collapse-submenu">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="dropdown mb-3">
                                <a href="#" class="btn btn-sm btn-primary submenu-add" data-toggle="modal" data-target="#newSubMenuModal"><i class="fas fa-fw fa-plus"></i> Submenu</a>
                                <a class="dropdown-toggle btn btn-sm btn-primary ml-1" href="#" role="button" id="submenu-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    All status
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="submenu-dropdown">
                                    <div class="dropdown-header">Submenu status:</div>
                                    <a class="dropdown-item submenu-status" href="#" data-submenu="2">All status</a>
                                    <a class="dropdown-item submenu-status" href="#" data-submenu="1">Active</a>
                                    <a class="dropdown-item submenu-status" href="#" data-submenu="0">Denied</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control search-submenu" placeholder="Cari submenu">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 table-responsive">
                            <table id="table-submenu" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-left">Submenu</th>
                                        <th class="text-left">Menu</th>
                                        <th class="text-left">URL</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- ajax -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 text-center mt-3">
                            <span class="paging-submenu"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title judulModalMenu" id="newMenuModalLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url(); ?>admin/updateMenu" class="form-menu" method="POST">
                <input type="hidden" name="menu_id" id="menu_id">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="menu" id="menu" placeholder="Menu name" autocomplete="off">
                        <span class="error_nama"></span>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="menu_status" id="menu_status">
                            <option disabled selected>Pilih status</option>
                            <option value="1">Active</option>
                            <option value="0">Denied</option>
                        </select>
                        <span class="error_status"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submitMenu">Add Menu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title judulModalSubmenu" id="newSubMenuModalLabel">Add New Submenu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="<?= base_url(); ?>admin/updateSubmenu" class="form-submenu" method="POST">
                <input type="hidden" name="submenu_id" id="submenu_id">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" autocomplete="off" placeholder="Submenu" name="submenu_nama" id="submenu_nama">
                        <span class="error_submenunama"></span>
                    </div>
                    <div class="form-group">
                        <select name="id_menu" id="id_menu" class="form-control">
                            <option value="0" disabled selected>Select Menu</option>
                            <?php foreach ($menus as $menus) : ?>
                            <option value="<?= $menus['menu_id']; ?>"><?= $menus['menu_nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="error_submenumenu"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" autocomplete="off" placeholder="URL Submenu" name="submenu_url" id="submenu_url">
                        <span class="error_submenuurl"></span>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" autocomplete="off" placeholder="Icon Submenu" name="submenu_icon" id="submenu_icon">
                        <span class="error_submenuicon"></span>
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="submenu_status" id="submenu_status">
                            <option disabled selected>Pilih status</option>
                            <option value="1">Active</option>
                            <option value="0">Denied</option>
                        </select>
                        <span class="error_submenustatus"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submitSubmenu">Add Menu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(function() {
        let base_url = '<?= base_url(); ?>';
        let statsMenu = 2;
        let sercMenu = '';

        let statsSubmenu = 2;
        let sercSubmenu = '';

        function get_menu(url, status, search) {
            if (!url) {
                url = base_url + 'admin/ajaxGetAllMenu';
            }

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'JSON',
                data: {
                    status: status,
                    search: search
                },
                success: function(response) {
                    $('#table-menu tbody').html(response.row);
                    $(".paging-menu").html(response.message);
                }
            });
        }

        function get_submenu(url, status, search) {
            if (!url) {
                url = base_url + 'admin/ajaxGetAllSubmenu';
            }

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'JSON',
                data: {
                    status: status,
                    search: search
                },
                success: function(response) {
                    $('#table-submenu tbody').html(response.row);
                    $(".paging-submenu").html(response.message);
                }
            });
        }

        get_menu('', statsMenu, sercMenu);
        get_submenu('', statsSubmenu, sercSubmenu);

        $(document).on('click', ".paging-menu>nav>ul.pagination>li>a", function() {
            let href = $(this).attr('href');
            get_menu(href, 2, sercMenu);

            return false;
        });

        $(document).on('click', ".paging-submenu>nav>ul.pagination>li>a", function() {
            let href = $(this).attr('href');
            get_submenu(href, statsSubmenu, sercSubmenu);

            return false;
        });

        $(document).on('click', '.menu-status', function(e) {
            let text = $(this).text();
            statsMenu = $(this).data('menu');

            $('#menu-dropdown').html(text);

            get_menu('', statsMenu, sercMenu);

            e.preventDefault();
        });

        $(document).on('keyup', '.search-menu', function(e) {
            sercMenu = $(this).val();
            get_menu('', statsMenu, sercMenu);

            e.preventDefault();
        });

        $(document).on('click', '.submenu-status', function(e) {
            let text = $(this).text();
            statsSubmenu = $(this).data('submenu');

            $('#submenu-dropdown').html(text);

            get_submenu('', statsSubmenu, sercSubmenu);

            e.preventDefault();
        });

        $(document).on('keyup', '.search-submenu', function(e) {
            sercSubmenu = $(this).val();
            get_submenu('', statsSubmenu, sercSubmenu);

            e.preventDefault();
        });

        /*============================== CRUD ==============================*/
        $(document).on('click', '.menu-add', function() {
            $('.judulModalMenu').html('Add New Menu');
            $('.submitMenu').html('Add Menu');
            $('.form-menu').attr('action', base_url + 'admin/addMenu');

            $('.form-menu').trigger('reset');
        });

        $(document).on('click', '.menu-edit', function() {
            $('.judulModalMenu').html('Edit Menu');
            $('.submitMenu').html('Edit Menu');
            $('.form-menu').attr('action', base_url + 'admin/updateMenu');

            const id = $(this).data('id');

            $.ajax({
                url: base_url + 'admin/ajaxGetMenuById',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    idJson: id
                },
                success: function(response) {
                    $('#menu_id').val(response.menu_id)
                    $('#menu').val(response.menu_nama)
                    $('#menu_status').val(response.menu_status)
                }
            });
        });

        $(document).on('click', '.submenu-add', function() {
            $('.judulModalSubmenu').html('Add New Submenu');
            $('.submitSubmenu').html('Add Submenu');
            $('.form-submenu').attr('action', base_url + 'admin/addSubmenu');
            $('.form-submenu').trigger('reset');

            // $('#id_menu').val(0);
            // $('#submenu_id').val('');
            // $('#submenu_nama').val('');
            // $('#submenu_url').val('');
            // $('#submenu_icon').val('');
            // $('#submenu_status').val(1);
        });

        $(document).on('click', '.submenu-edit', function() {
            $('.judulModalSubmenu').html('Edit Submenu');
            $('.submitSubmenu').html('Edit Submenu');
            $('.form-submenu').attr('action', base_url + 'admin/updateSubmenu');

            const id = $(this).data('id');

            $.ajax({
                url: base_url + 'admin/ajaxGetSubmenuById',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    idJson: id
                },
                success: function(hasil) {
                    $('#id_menu').val(hasil.menu_id);
                    $('#submenu_id').val(hasil.submenu_id);
                    $('#submenu_nama').val(hasil.submenu_nama);
                    $('#submenu_url').val(hasil.submenu_url);
                    $('#submenu_icon').val(hasil.submenu_icon);
                    $('#submenu_status').val(hasil.submenu_status);
                }
            });
        });

        $(document).on('submit', '.form-menu', function(e) {
            e.preventDefault();

            $('.error_nama').html('');
            $('.error_status').html('');

            let formData = new FormData(this);
            let url = $(this).attr('action');

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'JSON',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.result == false) {
                        $('.error_nama').html(response.message.menu);
                        $('.error_status').html(response.message.menu_status);
                    } else {
                        Swal.fire({
                            icon: 'success',
                            width: 600,
                            padding: '2em',
                            title: response.message + ' menu berhasil!',
                            html: "Selamat, menu baru berhasil di " + response.message + "."
                        }).then((result) => {
                            location.reload();
                        });
                    }
                },
                error: function(response) {
                    console.log('error cok ', response);
                }
            });
        });

        $(document).on('submit', '.form-submenu', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            let url = $(this).attr('action');

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'JSON',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.result == false) {
                        $('.error_submenunama').html(response.message.submenu_nama);
                        $('.error_submenuurl').html(response.message.submenu_url);
                        $('.error_submenuicon').html(response.message.submenu_icon);
                        $('.error_submenustatus').html(response.message.submenu_status);
                        $('.error_submenumenu').html(response.message.id_menu);
                    } else {
                        Swal.fire({
                            icon: 'success',
                            width: 600,
                            padding: '2em',
                            title: response.message + ' submenu berhasil!',
                            html: "Selamat, submenu berhasil di " + response.message + "."
                        }).then((result) => {
                            location.reload();
                        });
                    }
                },
                error: function(response) {
                    console.log('error cok ', response);
                }
            });
        });
    });
</script>