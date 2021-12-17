<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="card card-primary o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <b class="h3 text-gray-900 mb-4"><strong>Welcome back!</strong></b>
                                    <p class="text-muted">We're so excited to see you again!</p>
                                </div>

                                <!-- Sweet alert catch up -->
                                <div class="registration-success" data-regsucs="<?= $this->session->flashdata('regsucs'); ?>"></div>
                                <div class="wrong-token" data-wrongtoken="<?= $this->session->flashdata('wrongtoken'); ?>"></div>
                                <div class="wrong-email" data-wrongemail="<?= $this->session->flashdata('wrongemail'); ?>"></div>
                                <div class="expired-token" data-expiredtoken="<?= $this->session->flashdata('expiredtoken'); ?>"></div>
                                <div class="success-token" data-successtoken="<?= $this->session->flashdata('successtoken'); ?>"></div>

                                <form class="user mt-5" method="POST" action="<?= base_url(); ?>auth/ajaxLogin" id="form-login">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email address" autocomplete="off" value="<?= set_value('email'); ?>">
                                        <span class="error_email"></span>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                                        <span class="error_password"></span>
                                    </div>
                                    <div class="form-group">
                                        <a class="small" href="<?= base_url(); ?>auth/forgotpassword">Forgot your password?</a>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                <div class="text-left mt-1">
                                    <span class=" small text-muted">Need an account? </span><a class="small" href="<?= base_url(); ?>auth/registration">Register!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/js/auth/login.js"></script>