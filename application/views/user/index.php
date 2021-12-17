<style>
    .hide {
        display: none;
    }
</style>

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row mb-3">
        <div class="col-lg-4">
            <div class="card shadow">
                <img src="<?= base_url(); ?>assets/img/profile/<?= $user['user_picture']; ?>" class="card-img-top p-2">
                <div class="card-body">
                    <h5 class="card-title" style="margin-bottom: 0;"><?= $user['user_nama']; ?></h5>
                    <small class="text-muted" style="margin-top: 0; font-style: italic;"><?= $user['user_email']; ?></small>

                    <p class="card-text mt-3">Member since <?= date('d F Y', strtotime($user['user_created'])); ?></p>
                    <!-- <a href="#" class="btn btn-sm btn-dark" id="edit-profile"><i class="fas fa-fw fa-user-alt"></i> Edit Profile</a>
                    <a href="#" class="btn btn-sm btn-dark" id="change-password"><i class="fas fa-fw fa-key"></i> Change Password</a> -->
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Password</a>
                    <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card shadow">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Change password</h6>
                        </div>
                        <div class="card-body">
                            <p>Please, keep your password secretly. Do not tell anyone about your password!</p>
                            <form action="<?= base_url(); ?>user/ajaxChangePassword" method="post" id="change_form">
                                <div class="form-group">
                                    <label for="old-password">Current password</label>
                                    <input type="password" class="form-control" name="old-password" id="old-password">
                                    <span class="old-password-error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="newpassword-1">New password</label>
                                    <input type="password" class="form-control" name="newpassword-1" id="newpassword-1">
                                    <span class="newpassword-1-error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="newpassword-2">Repeat new password</label>
                                    <input type="password" class="form-control" name="newpassword-2" id="newpassword-2">
                                    <span class="newpassword-2-error"></span>
                                </div>
                                <div class="form-group text-right ">
                                    <button type="button" class="btn btn-sm btn-secondary" id="change-reset"><i class="fas fa-fw fa-times"></i> Cancel</button>
                                    <button type="submit" class="btn btn-sm btn-primary" id="change-form"><i class="fas fa-fw fa-edit"></i> Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="card shadow">
                        <div class="card-header">
                            Edit Profile
                        </div>
                        <div class="card-body">

                            <form method="POST" action="<?= base_url(); ?>user/ajaxChangeProfile" id="form-edit-profile" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?= $user['user_email']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" autocomplete="off" value="<?= $user['user_nama']; ?>">
                                    <span class="error_nama"></span>
                                </div>
                                <div class="form-group">
                                    <label>Picture</label>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <img src="<?= base_url(); ?>assets/img/profile/<?= $user['user_picture']; ?>" class="img-thumbnail">
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="image" name="image">
                                                <label class="custom-file-label" for="image">Choose file in JPEG, JPG, or PNG format</label>
                                            </div>
                                            <span class="error_file"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <button type="button" class="btn btn-sm btn-secondary" id="profile-reset"><i class="fas fa-fw fa-times"></i> Cancel</button>
                                    <button type="submit" class="btn btn-sm btn-primary" id="profile-submit"><i class="fas fa-fw fa-edit"></i> Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/js/user/user.js"></script>