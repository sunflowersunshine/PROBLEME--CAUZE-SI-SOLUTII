<?php 
/**
* Template Name: Trimite problema
*
* @package WordPress
* @subpackage Probleme
* @since Probleme 1.0
*/

get_header(); ?>

<div class="container-fluid">
    <div class="row d-flex justify-content-center mt-40"> 
        <div class="col-xs-12 col-sm-12 col-md-6 mx-auto">
            <div class="py-3">
                <h5 class="problema-title">Trimite problema</h5>
            </div>

            <div class="row">
                <?php if(isset($_GET['errors'])): ?>
                            <div class="alert alert-danger" role="alert">
                            <?php for($i = 0 ; $i < $_GET['errors'] ; $i++) : ?>
                                <?php echo $_GET[$i]; ?> <br>
                                <?php endfor; ?>
                            </div>
                <?php endif; ?>
            </div>

            <form id="trimite-problema" class="trimite" action="<?php echo esc_url(admin_url( 'admin-post.php' )); ?>"  method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="insert_custom_problem">
            <!-- 2 column grid layout with text inputs for the first and last names -->
                <div class="row">
                    <div class="col">
                        <div class="alert alert-info" role="alert">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quasi autem dolorem nulla labore eaque neque. Quasi quisquam quis minus adipisci distinctio odio quaerat vitae blanditiis provident accusamus, dolor laboriosam maiores.
                        </div>
                        <div class="form-group">
                            <input 
                                type="text" 
                                id="problema_name" 
                                name="problema_name" 
                                placeholder="Nume" 
                                value="<?php echo isset($_POST['problema_name']) ? sanitize_text_field($_POST['problema_name']) : ""; ?>" 
                                class="form-control" 
                                required
                            >
                        </div>  
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <input 
                                type="text"
                                id="problema_last_name"
                                name="problema_last_name"
                                placeholder="Prenume" 
                                value="<?php isset($_POST['problema_last_name']) ? sanitize_text_field($_POST['problema_last_name']) : ""; ?>" 
                                class="form-control" 
                                required >
                        </div>
                    </div>
                </div>
                <div class="row">
                     <!-- Email input -->
                    <div class="form-group">
                        <input 
                            type="email" 
                            id="problema_mail"
                            name="problema_mail" 
                            placeholder="Email" 
                            value="<?php isset($_POST['problema_mail']) ? sanitize_text_field($_POST['problema_mail']) : ""; ?>" 
                            class="form-control"  
                            required>
                    </div>

                     <!-- Phone input -->
                    <div class="form-group">
                        <input 
                            type="text"
                            id="problema_phone"
                            name="problema_phone" 
                            placeholder="Telefon" 
                            value="<?php isset($_POST['problema_phone']) ? sanitize_text_field($_POST['problema_phone']) : ""; ?>"
                            class="form-control" 
                            required  >
                    </div>
                     <!-- Address input -->
                    <div class="form-group ">
                        <input 
                            type="text"
                            id="problema_address"
                            name="problema_address"
                            placeholder="Adresă"
                            value="<?php isset($_POST['problema_address']) ? sanitize_text_field($_POST['problema_address']) : ""; ?>"
                            class="form-control" 
                            required>
                    </div>

                    <!-- Problem input -->
                    <div class="form-group d-flex">
                        <?php 
                        $terms = get_terms( array(
                            'taxonomy' => 'categorie_problema',
                            'hide_empty' => false
                        ) ); ?>
                        <select class="form-select mb-3" aria-label=".form-select-lg example" id="problema_term_id" name="problema_term_id" >
                            <option disabled selected>Alege o categorie</option>
                                <?php foreach( $terms as $term ) : ?>
                                    <option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
                                <?php endforeach; ?>
                        </select>                            
                    </div>

                    <!-- Subject input -->
                    <div class="form-group">
                        <input 
                            type="text"
                            id="problema_category"
                            name="problema_category"
                            placeholder="Subiect, denumire problema"
                            value="<?php isset($_POST['problema_category']) ? sanitize_text_field($_POST['problema_category']) : ""; ?>"
                            class="form-control" 
                            required>
                    </div>
            
                    <!-- File input -->
                    <div class="form-choose">
                        <label class="form-choose-file" for="problema_files"><i class="fa fa-solid fa-image"></i>Selectează imaginile</label>
                        <input 
                            type="file"
                            id="problema_files"
                            name="problema_files[]"
                            accept="image/*" 
                            multiple="multiple" 
                            style="visibility:hidden;">
                    </div>
                
                     <!-- File preview input-->
                    <p id="files-area">
                        <span id="filesList">
                            <span id="files-names"></span>
                        </span>
                    </p>
        
                    <!-- Descripion input -->
                    <div class="form-group">
                        <textarea 
                        class="form-control" 
                        id="problema_description" 
                        name="problema_description"
                        placeholder="Descrie problema" 
                        value="<?php isset($_POST['problema_description']) ? sanitize_text_field($_POST['problema_description']) : ""; ?>" 
                        rows="4" required></textarea>
                    </div>

                    <!-- Checkbox -->
                    <div class="form-group d-flex justify-content-center mb-2" id="checkbox-error">
                        <input class="me-2" type="checkbox" id="problema_InputCheckbox" name="problema_InputCheckbox" required/>
                        <label class="form-check-label" for="problema_InputCheckbox">Continuând,  aceptați <?php echo get_the_privacy_policy_link(); ?> </label>
                        <br>
                    </div>
                    <button type="submit" id="problema_button" name="problema_submit" class="btn btn-primary">Trimite</button>
                    <div id="loading" class="loading"></div>
        
                      <!-- Nonce field -->
                    <?php wp_nonce_field( 'insert_custom_problem', 'nonce' ); ?>
                </div>
            </form>
        </div>
    </div> 
</div>
<?php get_footer(); ?>
 