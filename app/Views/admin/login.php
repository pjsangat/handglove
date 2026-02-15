<div id="login">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-9">
                <div class="card auth-box">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="sign-in-logo">
                                <a href="<?php echo base_url(); ?>">
                                    <img src="<?php echo base_url('assets/img/handglove-logo.png'); ?>" alt="">
                                </a>
                                <div class="sign-in-img">
                                    <img src="<?php echo base_url('assets/img/sign-in.png'); ?>" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="registration-form">
                                <div class="reg-content">
                                    <div class="reg-header">
                                        <h3>Handglove Admin</h3>
                                        <p>Sign in to continue to Handglove</p>
                                    </div>
                                    <div class="reg-body">
                                        <div id="reg-basic">
                                            <form action="<?= base_url('admin/login') ?>" method="post">
                                                <div class="fields">
                                                    <?php if($session->getFlashdata('error')): ?>
                                                        <div class="alert alert-danger rounded-0 py-1 px-2 mb-3">
                                                            <?= $session->getFlashdata('error') ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <!-- <label for="">Email Address</label> -->
                                                                <input type="email" class="form-control required" name="email" placeholder="Enter your email address..">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="fields">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <!-- <label for="">Password</label> -->
                                                                <div class="password-cont">
                                                                    <input type="password" class="form-control required" name="password" placeholder="Enter your password...">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="fields">
                                                    <div class="row">
                                                        <div class="col-md-6 col-6 col-sm-6">
                                                            <input type="checkbox" id="remember" value="1" name="remember">
                                                            <label for="remember">Remember me</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="buttons">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <input type="submit" class="thm-btn-secondary" value="Login">
                                                        </div>
                                                </div>
                                            </form>
                                        </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>