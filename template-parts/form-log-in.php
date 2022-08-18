<?php
    // ob_start();
    // if (!is_user_logged_in()) {

global $errors_login;
if (!empty($errors_login)) : ?>
    <div class="alert alert-danger">
        <?php echo $errors_login; ?>
    </div>
<?php endif; ?>

<div class="account-container">
    <div class="account-form">
        <div class="row">
            <?php if(isset($_GET['errors'])): ?>
                    <div class="alert alert-danger" role="alert">
                    <?php for($i = 0 ; $i < $_GET['errors'] ; $i++) : ?>
                        <?php echo $_GET[$i];?> <br>
                        <?php endfor; ?>
                    </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3 class="card-title">Autentificare</h3>
                <div class="card-text">
                    <form method="POST" action="<?php echo esc_url(admin_url( 'admin-post.php' )); ?>" class="wc-login-form">
                        <input type="hidden" name="action" value="user_login" />

                        <!-- Email input -->
                        <div class="form-group log_user">
                            <input type="text" 
                            class="form-control form-control-sm" 
                            id="login_email" 
                            name="login_email" 
                            placeholder="Email-ul">
                        </div>

                        <!-- Password input -->
                        <div class="form-group log_pass">            
                            <a href="<?= get_permalink( get_page_by_title( 'Recuperare parolă' ) ); ?>" style="float:right;font-size:17px;margin-bottom:5px;">Ai uitat parola?</a>
                            <input type="password" 
                            class="form-control form-control-sm" 
                            id="login_password" 
                            name="login_password"
                            placeholder="Parolă">
                        </div>

                        <?php wp_nonce_field('userLogin', 'nonce'); ?>

                        <!-- Button -->
                        <button type="submit" id="log-in_button" name="log-in_button" class="btn btn-primary btn-block">Intră în cont</button>
                        
                        <div class="sign-up">
                            Nu ai cont? <a href="<?= get_permalink( get_page_by_title( 'Înregistrare' ) ); ?>">Creează cont</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>  
</div>     
<?php
// } else {
//     echo '<p class="error-logged">You are already logged in.</p>';
// }
