<?php

// if (!is_user_logged_in()) {
   ?>

    <div class="account-container">
        <div class="account-form">
            <div class="row">
                <?php if(isset($_GET['errors'])): ?>
                            <div class="alert alert-danger" role="alert">
                            <?php for($i = 0 ; $i < $_GET['errors'] ; $i++) : ?>
                                <?php echo $_GET[$i]; ?> <br>
                                <?php endfor; ?>
                            </div>
                <?php endif; ?>
            </div>

            <div class="row">
                <div class="col-md-12">
                        <h3 class="card-title">Înregistrare</h3>
                        <div class="card-text">
                        <form method="POST" action="<?php echo esc_url(admin_url( 'admin-post.php' )); ?>" class="wc-register-form">
                            <input type="hidden" name="action" value="user_register" />

                                <!-- First Name input -->
                                <div class="form-group log_user">
                                    <?php $first_name = isset($_POST['sign-up_first-name']) ? $_POST['sign-up_first-name'] : ''; ?>
                                    <input type="text" 
                                    class="form-control" 
                                    id="sign-up_first-name" 
                                    name="sign-up_first-name" 
                                    placeholder="Nume" 
                                    value="<?= $first_name; ?>">
                                </div>

                                <!-- Last Name input -->
                                <div class="form-group log_user">
                                   <?php $last_name = isset($_POST['sign-up_last-name']) ? $_POST['sign-up_last-name'] : ''; ?>
                                    <input type="text" 
                                    class="form-control" 
                                    id="sign-up_last-name" 
                                    name="sign-up_last-name" 
                                    value="<?= $last_name; ?>" 
                                    placeholder="Prenume">
                                </div>

                                <!-- Email input -->
                                <div class="form-group log_user">
                                <?php $user_email = isset($_POST['sign-up_email']) ? $_POST['sign-up_email'] : ''; ?>
                                    <input type="email" 
                                    class="form-control" 
                                    id="sign-up_email"  
                                    name ="sign-up_email"  
                                    value="<?= $user_email; ?>" 
                                    placeholder="Email">
                                </div>

                                <!-- Phone input -->
                                <div class="form-group log_user">
                                    <?php $user_phone = isset($_POST['sign-up_phone']) ? $_POST['sign-up_phone'] : ''; ?>
                                    <input type="text" 
                                    class="form-control" 
                                    id="sign-up_phone" 
                                    name="sign-up_phone" 
                                    value="<?= $user_phone; ?>" 
                                    placeholder="Telefon">
                                </div>

                                  <!-- Adress input -->
                                  <div class="form-group log_user">
                                    <?php $user_adress = isset($_POST['sign-up_adress']) ? $_POST['sign-up_adress'] : ''; ?>
                                    <input type="text" 
                                    class="form-control" 
                                    id="sign-up_adress" 
                                    name="sign-up_adress" 
                                    value="<?= $user_adress; ?>" 
                                    placeholder="Adresă">
                                </div>

                                <div class="form-group log_pass">
                                    <input type="password" class="form-control form-control-sm" id="sign-up_password" name="sign-up_password" placeholder="Parolă">
                                </div>

                                <div class="form-group log_pass">
                                    <input type="password" class="form-control form-control-sm" id="sign-up_confirm-password" name="sign-up_confirm-password" placeholder="Confirmă parola">
                                </div>

                                <div class="form-group d-flex justify-content-center mb-2" id="checkbox-error">
                                        <input class="sign-up_checkbox" type="checkbox" id="sign-up_checkbox" name="sign-up_checkbox" required/>
                                        <label class="form-check-label" for="sign-up_checkbox">Continuând,  aceptați <?php echo get_the_privacy_policy_link(); ?> </label>
                                        <br>
                                </div>

                                <!-- Button create account -->
                                <div class="log_user">
                                <?php wp_nonce_field('userRegister', 'nonce'); ?>
                                     <button type="submit" id="sign-up_button" name="sign-up_button" class="btn btn-primary btn-block">Creează cont</button>
                                </div>
                                <div class="sign-up">
                                    Ai deja un cont? <a href="<?= get_permalink( get_page_by_title( 'Autentificare' ) ); ?>">Conectează-te</a>
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
