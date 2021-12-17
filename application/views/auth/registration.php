<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">

            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <!-- Title -->
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <!-- Form -->
                        <form class="user" method="POST" action="<?= base_url(); ?>auth/ajaxRegist" id="form-registration">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Full Name" autocomplete="off">
                                <span class="nama-error"></span>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email Address" autocomplete="off">
                                <span class="email-error"></span>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                    <span class="password-error"></span>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                                </div>
                            </div>
                            <button type="submit" name="submit" id="btn-registration" class="btn btn-primary btn-user btn-block">
                                Continue
                            </button>
                        </form>
                        <div class="text-left mt-1">
                            <a class="small" href="<?= base_url(); ?>auth">Already have an account?</a>
                        </div>
                        <div class="text-left mt-3">
                            <span class="xtra-small">By registering, you agree to Discode's Terms of Service and Privacy Policy</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="<?= base_url(); ?>assets/js/auth/registration.js"></script>