<?php if (!is_user_logged_in()) { ?>
    <div class="account-container">
        <div class="account-form">
            <div class="row">
                <?php if(isset($_GET['errors'])): ?>
                    <div class="alert alert-danger" role="alert">
                    <?php for($i = 0 ; $i < $_GET['errors'] ; $i++) : ?>
                        <?php echo $_GET[$i];?> <br>
                        <?php endfor; ?>
                    </div>
                <?php elseif(isset($_GET['success'])) :?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $_GET['success'];?> 
                    </div>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-md-12">
                        <h3 class="card-title">Recuperare parolă</h3>
                        <div class="card-text">
                        <form method="POST" action="<?php echo esc_url(admin_url( 'admin-post.php' )); ?>" class="wc-recover-form">
                            <input type="hidden" name="action" value="user_recover_password" />

                                
                                <div class="form-group">
                                    <?php $user_email= isset($_POST['user_email']) ? $_POST['user_email'] : ''; ?>
                                    <input type="email" 
                                    class="form-control" 
                                    id="user_email" 
                                    name="user_email" 
                                    placeholder="Email" 
                                    value="<?= $user_email; ?>">
                                </div>

                                <!-- Button recover password -->
                                <div class="log_user">
                                <?php wp_nonce_field('userGetPassword', 'nonce'); ?>
                                    <button type="submit" id="recover_button" name="recover_button" class="btn btn-primary btn-block">Recuperează parola</button>
                                </div>
                            </form>
                        </div>
                </div>
            </div>  
        </div>
    </div>
        <?php
    } else {
        echo '<p class="error-logged">You are already logged in.</p>';
    }
