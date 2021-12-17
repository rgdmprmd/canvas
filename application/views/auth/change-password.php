<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">

                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900">Change password for</h1>
                                    <h5 class="h6 text-gray-600 mb-4"><?= $this->session->userdata('reset_email'); ?></h5>
                                </div>

                                <form id="change_form" method="POST" action="<?= base_url(); ?>auth/ajaxChange">
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="New Password">
                                        <span class="password1-error"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                                        <span class="password2-error"></span>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">Change Password</button>
                                </form>
                                <div class="text-left mt-1">
                                    <span class="small text-muted">Made up your mind? </span><a class="small" href="<?= base_url(); ?>auth">Back to login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/js/auth/change-password.js"></script>