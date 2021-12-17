<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Forgot your password?</h1>
                                </div>

                                <form id="forgot_form" method="POST" action="<?= base_url(); ?>auth/ajaxForgot">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email address" autocomplete="off">
                                        <span class="email-error"></span>
                                    </div>
                                    <button type="submit" name="submit" id="btn-forgot" class="btn btn-primary btn-user btn-block">Continue</button>
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

<script src="<?= base_url(); ?>assets/js/auth/forgot-password.js"></script>