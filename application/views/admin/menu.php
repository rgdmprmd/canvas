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

<script src="<?= base_url(); ?>assets/js/admin/menu.js"></script>