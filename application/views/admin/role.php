<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Role Controls</h6>
                </div>

                <div class="card-body">
                    <a href="" class="btn btn-sm btn-primary mb-3 role-add" data-toggle="modal" data-target="#roleModal"><i class="fas fa-fw fa-plus"></i> Role</a>

                    <div class="table-responsive">
                        <table class="table table-hover" id="table-role">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-left">Role</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Generate by Ajax -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title judulModalRole" id="roleModalLabel">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url(); ?>admin/editRole" class="form-role" method="POST">
                <input type="hidden" name="role_id" id="role_id">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" name="role_nama" id="role_nama" placeholder="Role Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary submitRole">Add Role</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="accessModal" tabindex="-1" role="dialog" aria-labelledby="accessModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title judulModalAccess" id="accessModalLabel">Access Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Role : <span class="role-nama"></span></h5>
                <div class="alert-places text-primary small"></div>

                <table class="table table-hover" id="table-access">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Menu</th>
                            <th>Access</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Generate by Ajax -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-access" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/js/admin/role.js"></script>