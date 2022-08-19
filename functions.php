<?php


function theme_enqueue_styles() {
    wp_enqueue_style('magnific-styles', get_template_directory_uri() . '/magnific-popup.css');
    wp_enqueue_style('fonts-styles','https://fonts.googleapis.com/css?family=Open+Sans:300,400' );
    wp_enqueue_style('fonts-awesome','https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('bootstrap-cdn-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css');
    wp_enqueue_style('main-styles', get_template_directory_uri() . '/style.css');
   

    wp_enqueue_script('script', get_template_directory_uri() . "/script.js", array('jquery'), true);
    wp_enqueue_script( 'bootstrap-tether', 'https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js', array(), true);
    wp_enqueue_script( 'bootstrap-cdn-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js', array(), true);
    wp_enqueue_script( 'jquery-magnific-popup', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js', array(), true );
    wp_enqueue_script( 'jquery-validator', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js', array(), true);
   
    
    if (get_post_type() === 'problema' ) {
    wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
    wp_enqueue_style('slick-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css');
    wp_enqueue_script('slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), true);
    }
   
     // Localize the enqueued JS script
        $arr = array(
            'ajaxurl' => admin_url( 'admin-ajax.php' )
        );
        wp_localize_script( 'script', 'myAjax', $arr);

}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');


/**
 * THEME SUPPORT
 */
/**
 * Register menus
 */
 function register_my_menus() {
    register_nav_menus(
      array(
        'header-menu' => __( 'Meniu Antet' ),
        'footer-menu'  => __( 'Meniu Subsol'),
       )
     );
   }
   add_action( 'init', 'register_my_menus' );

   /**
 * Register sidebar
 */

add_action( 'widgets_init', 'right_sidebar' );

function right_sidebar() {
  $args = array(
    'name'          => 'Right-Sidebar',
    'id'            => 'right-sidebar', 
    'class'         => '',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widgettitle">',
    'after_title'   => '</h4>' 
  );

  register_sidebar( $args );
}

/**
 * add feature image support
 */
add_theme_support( 'post-thumbnails' );




/**
 * Add class to a link-MENU
 */
function add_menu_link_class( $atts, $item, $args ) {
    if (property_exists($args, 'link_class')) {
      $atts['class'] = $args->link_class;
    }
    return $atts;
  }

  add_filter( 'nav_menu_link_attributes', 'add_menu_link_class', 1, 3 );

/**
 * Add a class to a li item-MENU
 */
  function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);


/**
 * Add class active to the active page-MENU
 */

add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
  if (in_array('current-menu-item', $classes) ){
    $classes[] = 'active';
  }
  return $classes;
}

/**
 * Post-format quote support
 */

function probleme_post_formats_setup() {
  add_theme_support( 'post-formats', array('quote') );
 }
 add_action( 'after_setup_theme', 'probleme_post_formats_setup' );

/**
 * Add post thumbnails support
*/
add_theme_support( 'post-thumbnails');

/**
 * Add options acf
 */
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
    acf_add_options_sub_page('Header');
    acf_add_options_sub_page('Footer');

    acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
}

/**
 * START -- VALIDATE FORMS
 */

/**
 * Validate the form trimite problema
 */

function validate_form_trimite_problema() {

  $response_validate = []; 
  $response_validate['type'] = 'success';

  $errors = [];

  if(!preg_match("/^[a-zA-Z-' ]*$/", $_POST['problema_name'])) {
    array_push($errors, __('Numele trebuie să conțină doar litere'));
    $response_validate['type'] = 'error';
  } 

  if(!preg_match( '/^[A-Za-z .]*$/', $_POST['problema_last_name'])) {
    array_push($errors, __('Prenumele trebuie să conțină doar litere!', 'probleme-cauze-statistici'));
    $response_validate['type'] = 'error';
  }

  if(!is_email($_POST['problema_mail'])) {
    array_push($errors, __('Adresa de email este invalida!', 'probleme-cauze-statistici'));
    $response_validate['type'] = 'error';
  }

  if(!preg_match( '/^(\+4|)?(07[0-8]{1}[0-9]{1}|02[0-9]{2}|03[0-9]{2}){1}?(\s|\.|\-)?([0-9]{3}(\s|\.|\-|)){2}$/', $_POST['problema_phone'])) {
    array_push($errors, __('Numarul de telefon este invalid!', 'probleme-cauze-statistici'));
    $response_validate['type'] = 'error';
  }

  if(empty($_POST['problema_term_id'])) {
    array_push($errors, __('Nu a fost selectată nici o categorie de probleme!', 'probleme-cauze-statistici'));
    $response_validate['type'] = 'error';
  }

  if(!isset($_POST['problema_InputCheckbox'])) {
    array_push($errors, __('Casuta de acceptare a termenilor si condițiilor nu a fost bifata!', 'probleme-cauze-statistici'));
    $response_validate['type'] = 'error';
  }

  $response_validate['messages'] = $errors;

  return $response_validate;
}

/**
 * Create user if user is not logged in
 */
 function probleme_create_user($username, $name, $email, $phone, $password, $adress) {

    $find_unique_username =  false;
    $account_trimite_problema= false;
    $username_unique = $username;

    for($i=0; !$find_unique_username; $i++) {
      if(!username_exists($username_unique)) {
          $find_unique_username= true;
      } else {
          $username_unique = $username . $i;
      }
    }

  if($password == false) {
    $password = wp_generate_password();
    $account_trimite_problema = true;
  }
          
  $userdata = array(
      'user_login' =>   $username_unique,
      'user_pass' => wp_hash_password( $password ),
      'user_email' => $email,
      'meta_input' => array(
        'phone' => $phone,
        'adress' => $adress,
    )
  );

  $user_id = wp_insert_user($userdata);

  $to = $email;
  $subject = 'Probleme, Cauze, Statistici';
  if ($account_trimite_problema) {
        $body = 'Salutare, '. $name .'.  Pentru a trimite o problemă este necesară crearea unui cont!
      Contul dumneavoastră a fost creat automat când ați trimis problema! Datele contului sunt numele: '.$username_unique.' email: '. $email . ' și parola: ' . $password .'
      Numai bine!';
  } else {
      $body = 'Salutare, ' .$name. 'Felicitări! Contul tău a fost creat cu success!
      Datele contului sunt numele: '.$username_unique.' email: '. $email . ' și parola: ' . $password .'
      Numai bine!';
  }

  wp_mail( $to, $subject, $body);

    if(!is_wp_error($user_id)) 
    {
      wp_set_current_user($user_id);
      wp_set_auth_cookie($user_id);
      do_action('wp_login', $username_unique);
    }
    return $user_id; 
 }

 /**
  * Login form function
  */

add_action( 'admin_post_user_login', 'user_login_function' );
add_action( 'admin_post_nopriv_user_login', 'user_login_function' );
  

function user_login_function() {

  $errors = [];

    if (isset($_POST['log-in_button']) && wp_verify_nonce($_POST['nonce'], 'userLogin')) {

      $user_email = $_POST['login_email'];
      $user_password = $_POST['login_password'];

      if ( empty($user_email) && !empty($user_password) ) {

          array_push($errors, __('Email-ul este obligatoriu!'));

      } elseif(!empty($user_email) && empty($user_password)) {

          array_push($errors, __('Parola este obligatorie!'));

      } elseif (empty($user_email) && empty($user_password)) {

          array_push($errors, __('Email-ul și parola sunt obligatorii!'));

      }  elseif(!is_email($user_email )) {

          array_push($errors, __('Adresa de email nu este validă!'));

      } elseif(is_email($user_email) && !email_exists($user_email)) {

          array_push($errors, __('Nu există un cont cu această adresă de email!'));

      } elseif( email_exists($user_email) && !empty($user_password)) {

        $credentials = array();
        $credentials['user_login'] =  $user_email;
        $credentials['user_password'] =  $user_password;
        $credentials['remember'] = true;

        $user = wp_signon($credentials, false);
        if (is_wp_error($user)) {
          if(empty($errors)) {
            array_push($errors, __('Parola este incorectă!'));
          }
          $args = add_query_arg( $errors , wp_get_referer() . '?errors='. count($errors). '');
          wp_redirect($args);
          exit;
        } else {
            wp_redirect(get_permalink( get_page_by_title( 'Contul meu' ) ));
            exit;
        }
      } 
      $args = add_query_arg( $errors , wp_get_referer() . '?errors='. count($errors). '');
      wp_redirect($args);
    }
}


 /**
  *  Register form function
  */
add_action( 'admin_post_user_register', 'user_register' );
add_action( 'admin_post_nopriv_user_register', 'user_register' );

function user_register() {

  $errors = [];
  if (isset($_POST['sign-up_button']) && wp_verify_nonce($_POST['nonce'], 'userRegister')) {

      $user_first_name = $_POST['sign-up_first-name'];
      $user_last_name = $_POST['sign-up_last-name'];
      $user_email = $_POST['sign-up_email'];
      $user_phone = $_POST['sign-up_phone'];
      $user_adress = $_POST['sign-up_adress'];
      $user_password = $_POST['sign-up_password'];
      $user_confirm_password = $_POST['sign-up_confirm-password'];

      $uppercase = preg_match('@[A-Z]@',$user_password);
      $lowercase = preg_match('@[a-z]@',$user_password);
      $number    = preg_match('@[0-9]@',$user_password );
      $specialChars = preg_match('@[^\w]@',$user_password);

      if (email_exists($user_email)) {
        array_push($errors, __('Există deja un cont cu această adresă de email!'));
        $args = add_query_arg( $errors , wp_get_referer() . '?errors='. count($errors). '');
        wp_redirect($args);
        exit;

      } else { 
      if (empty( $user_first_name)) {
        array_push($errors, __('Numele este obligatoriu!'));
      }

      if (empty( $user_last_name)) {
        array_push($errors, __('Prenumele este obligatoriu!'));
      } 

      if ((!preg_match("/^[a-zA-Z-' ]*$/",  $user_first_name)) || (!preg_match("/^[a-zA-Z-' ]*$/",  $user_last_name))  ) {
        array_push($errors, __('Numele și prenumele trebuie să fie formate doar din litere!'));
      }

      if (empty($user_email)) {
        array_push($errors, __('Email-ul este obligatoriu!'));
      } 

      if (empty($user_phone)) {
        array_push($errors, __('Numărul de telefon este obligatoriu!'));
      } 

      if (!preg_match("/^(\+4|)?(07[0-8]{1}[0-9]{1}|02[0-9]{2}|03[0-9]{2}){1}?(\s|\.|\-)?([0-9]{3}(\s|\.|\-|)){2}$/",  $user_phone)) {
        array_push($errors, __('Numărul de telefon nu este valid!'));
      } 

      if (empty($user_adress)) {
        array_push($errors, __('Adresa este obligatorie!'));
      } 

      if (empty($user_password) || empty($user_confirm_password) ) {
        array_push($errors, __('Nu ai introdus nici o parolă!'));
      }

      if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($user_password) < 8) {
        array_push($errors, __('Parola trebuie să fie formată din cel puțin 8 caractere, cel puțin o literă mare și una mică, o cifră, și un caracter special!'));
      } 

      if ($user_password != $user_confirm_password) {
        array_push($errors, __('Parola și confirmarea parolei nu corespund!'));
      } 

      if (empty($user_email) && !is_email($user_email)) {
        array_push($errors, __('Adresa de email este invalidă!'));
      }

      if (empty($errors)) {

          $user_login =  $user_first_name  . $user_last_name ;
          $user_name = $user_first_name . " ". $user_last_name ;
          $user_id =  probleme_create_user($user_login, $user_name, $user_email, $user_phone, $user_password, $user_adress);
  
          if (!is_wp_error($user_id)) {
              wp_redirect(get_permalink( get_page_by_title( 'Contul meu' ) ));
              exit;
          } else {
              array_push($errors, __('Ceva nu a funcțtionat corect! Contul nu a fost creat!'));
              $args = add_query_arg( $errors , wp_get_referer() . '?errors='. count($errors). '');
              wp_redirect($args);
              exit;
          }  
      } else {
          $args = add_query_arg( $errors , wp_get_referer() . '?errors='. count($errors). '');
          wp_redirect($args);
          exit;
      }
  }
}
}

/**
 * Recover password function
 */
add_action( 'admin_post_user_recover_password', 'user_recover_password' );
add_action( 'admin_post_nopriv_user_recover_password', 'user_recover_password' );

function user_recover_password() {
  $errors = [];
  if (isset($_POST['recover_button']) && wp_verify_nonce($_POST['nonce'], 'userGetPassword')) {
    global $getPasswordError, $getPasswordSuccess;

    $user_email = trim($_POST['user_email']);

    if (empty($user_email)) {
      array_push($errors, __('Adresa de email este obligatorie!'));
    } else if (!is_email($user_email)) {
      array_push($errors, __('Adresa de email este obligatorie!'));
    } else if (!email_exists($user_email)) {
      array_push($errors, __('Nu există un cont cu această adresă de email!'));
    } else {
        $random_password = wp_generate_password();
        $user = get_user_by('email', $user_email);

        $update_user = wp_update_user(array(
            'ID' => $user->ID,
            'user_pass' => $random_password
                )
        );

        if ($update_user) {
            $to = $user_email;
            $subject = 'Probleme, Cauze, Statistici => Resetare parolă';
            $sender = get_bloginfo('name');

            $message = 'Salutare! Ca urmare a cererii tale parola a fost resetată. Noua ta parolă este ' . $random_password . "Numai bine!";

            $mail = wp_mail($to, $subject, $message);

            if ($mail) {
                $getPasswordSuccess = '<strong>Success! </strong>Check your email address for you new password.';
               $success ='Parola a fost resetată cu succes! Ti-am trimis un email cu noua parolă!';
                $args = wp_get_referer() . '?success='. $success;
                wp_redirect($args);
                exit;
            }
        } else {
          array_push($errors, __('Ceva nu a funcționat! Parola nu a fost resetată!'));
          $args = add_query_arg( $errors , wp_get_referer() . '?errors='. count($errors). '');
          wp_redirect($args);
        }
      }
    }
}

add_action( 'admin_post_delete_user', 'delete_user' );

 function delete_user() {
 if ( !current_user_can( 'manage_options' ) ) {
      if (isset($_POST['delete_account_button']) && wp_verify_nonce($_POST['nonce'], 'userDelete')) {
        $current_user = wp_get_current_user();
        wp_delete_user( $current_user->ID );
        wp_redirect(home_url());
        exit;
    }
}
  wp_redirect(wp_get_referer());
  exit;
 }


 /**
  * STOP -- VALIDATE FORMS
  */
 
// INSERT POST 

add_action( 'admin_post_nopriv_insert_custom_problem', 'insert_custom_problem' );
add_action( 'admin_post_insert_custom_problem', 'insert_custom_problem' );

function insert_custom_problem() {  

    // Check if the form has been submitted
    if(isset($_POST['problema_submit']))
    {

        // Verify nonce
        if(!wp_verify_nonce( $_POST['nonce'], 'insert_custom_problem' ))
            die('Access denied');

        // Perform validation
        $validation = validate_form_trimite_problema();

        if($validation['type'] == 'success' ) {
    
            $post_data = array (
              'post_type' => 'problema',
              'post_title' => $_POST['problema_category'],
              'post_content' => $_POST['problema_description'],
              'post_status' => 'publish',
            );

            if(!is_user_logged_in() &&  !email_exists($_POST['problema_mail'])) {
                $user_login = $_POST['problema_name'] . $_POST['problema_last_name'];
                $user_name = $_POST['problema_name'] . ' ' . $_POST['problema_last_name'];
                $user_mail = $_POST['problema_mail'];
                $user_phone = $_POST['problema_phone'];
                $user_adress = $_POST['problema_address'];
                $user_id =  problema_create_user($user_login, $user_name , $user_mail, $user_phone, false,  $user_adress);

                if($user_id) {
                    $post_data['post_author'] = $user_id;
                }
            }
             else {
              $user = get_user_by( 'email', $_POST['problema_mail'] );
              $user_id = $user->ID;
              $post_data['post_author'] = $user_id;
             }
            
            $response = array(); // create response array
    
            $file_array = array(); // create array
            $file_count = count($_FILES['problema_files']['name']); //count files number
            $file_keys = array_keys($_FILES['problema_files']); // save files keys
    
    
            for ($i = 0; $i < $file_count; $i++) {
                foreach ( $file_keys as $key ) {
                    $file_array[$i][$key]= $_FILES['problema_files'][$key][$i]; // save files in the array
                }
            }
    
            // Insert the post
            $post_id = wp_insert_post( $post_data );  // The ID of the post this attachment is for.

  
            if(!is_wp_error($post_id)) {       
              
                $response['message'] = esc_html__('Postarea a fost adăugată cu succes!', 'probleme-cauze-statistici');
                $response['type'] = 'success';
    
                $test = wp_set_object_terms( $post_id, intval( $_POST['problema_term_id'] ), 'categorie_problema' );
    
                // Loop through files to save them into 
                for ( $i = 0; $i < count($file_array); $i++ ) {
    
                    $filename= $file_array[$i]['name']; //name of the file
                    $wp_filetype = wp_check_filetype( basename($filename), null ); //check file type, save file type
                    $wp_upload_dir = wp_upload_dir(); 
    
    
                    move_uploaded_file( $file_array[$i]['tmp_name'], $wp_upload_dir['path'] . '/' . $filename);
    
                    $attachment = [
                        'guid'           => $wp_upload_dir['url'] . '/' . basename($filename), 
                        'post_mime_type' => $wp_filetype['type'],
                        'post_title'     => preg_replace( '/\.[^.]+$/', '', basename($filename)),
                        'post_content'   => ''
                    ];
    
                    $path = $wp_upload_dir['path']  . '/' . $filename;
    
                    $attach_id = wp_insert_attachment( $attachment, $path, $post_id );
                    
                    require_once( ABSPATH . 'wp-admin/includes/image.php' );
                    
                    $attach_data = wp_generate_attachment_metadata( $attach_id, $path );
                    wp_update_attachment_metadata( $attach_id, $attach_data );
                }
    
                // set_post_thumbnail( $post_id, $attach_id);   
            }
            $to = $_POST['problema_mail'];
            $subject = 'Probleme, Cauze, Statistici';
            $body = 'Felicitări, problema ta a fost înregistrată cu succes! Mulțumim pentru timpul acordat! Toate cele bune!';
            wp_mail( $to, $subject, $body, $headers );


            wp_redirect(get_permalink($post_id));

        }else{

          $args = add_query_arg( $validation['messages'] , wp_get_referer() . '?errors='. count($validation['messages']). '');
          wp_redirect($args);
        } 
    }
}

/**
 * User favorite post
 */

add_action( 'wp_ajax_user_favorite_post', 'user_favorite_post');
add_action( 'wp_ajax_nopriv_user_favorite_post', 'user_favorite_post');

function user_favorite_post() {
    
  $result = [];
  $result['logged'] = true;
  $post_id = intval( $_POST['post_id'] );
  if( filter_var( $post_id, FILTER_VALIDATE_INT ) && is_user_logged_in()) {

    $article = get_post( $post_id );
    $output_count = 0;
    $user = get_current_user_id();
    $user_meta_favorite= get_user_meta($user, 'post='. $post_id.'favorite', true );

    $user_meta_favorite = ( $user_meta_favorite == "") ? 0 :  $user_meta_favorite;

    if( !is_null( $article ) && !$user_meta_favorite) {
        $count = get_post_meta( $post_id, 'favorite-post', true );
        if( $count == '' ) {
            update_post_meta( $post_id, 'favorite-post', '1' );
            update_user_meta($user, 'post='. $post_id.'favorite', 1);
            $output_count = 1;
            $result['type'] = "success";
        } else {
            $n = intval( $count );
            $n++;
            update_post_meta( $post_id, 'favorite-post', $n );
            update_user_meta($user, 'post='. $post_id.'favorite', 1);
            $output_count = $n;
            $result['type'] = "success";
        }
    } elseif($user_meta_favorite) {
      $count = get_post_meta( $post_id, 'favorite-post', true );
      if( $count ) {
        $n = intval($count);
        $n--;
        update_post_meta( $post_id, 'favorite-post', $n );
        update_user_meta($user, 'post='.$post_id.'favorite', 0);
        $output_count = $n;
        $result['type'] = "success";
      }
    } 
} else if(!is_user_logged_in()){
    $result['logged'] = false;
}
    $result['count'] = strval($output_count);
    echo json_encode( $result );
    die();
}


/**
 * User post like
 */

add_action( 'wp_ajax_my_user_like', 'my_user_like' );
add_action( 'wp_ajax_nopriv_my_user_like', 'my_user_like' );

function my_user_like() {
    
  $result = [];
  $result['logged'] = true;
  $post_id = intval( $_POST['post_id'] );
  if( filter_var( $post_id, FILTER_VALIDATE_INT ) && is_user_logged_in() ) {

    $article = get_post( $post_id );
    $output_count = 0;
    $user = get_current_user_id();
    $user_meta_likes= get_user_meta($user, 'post='. $post_id.'likes', true );
    $user_meta_dislikes= get_user_meta($user, 'post='. $post_id.'dislikes', true );
    
    $user_meta_likes = ( $user_meta_likes == "") ? 0 :  $user_meta_likes;
    $user_meta_dislikes = ( $user_meta_dislikes == "") ? 0 : $user_meta_dislikes;

    if( !is_null($article) &&  !$user_meta_likes &&  !$user_meta_dislikes) {
        $count = get_post_meta( $post_id, 'my-post-likes', true );
        if( $count == '' ) {
            update_post_meta( $post_id, 'my-post-likes', '1' );
            update_user_meta($user, 'post='. $post_id.'likes', 1);
            $output_count = 1;
            $result['type'] = "success";
        } else {
            $n = intval($count);
            $n++;
            update_post_meta( $post_id, 'my-post-likes', $n );
            update_user_meta($user, 'post='. $post_id.'likes', 1);
            $output_count = $n;
            $result['type'] = "success";
        }
    } elseif($user_meta_likes) {
      $count = get_post_meta( $post_id, 'my-post-likes', true );
      if( $count ) {
        $n = intval( $count );
        $n--;
        update_post_meta( $post_id, 'my-post-likes', $n );
        update_user_meta($user, 'post='. $post_id.'likes', 0);
        $output_count = $n;
        $result['type'] = "success";
      } 
    }  elseif ( $user_meta_dislikes && !$user_meta_likes){
        $count = get_post_meta( $post_id, 'my-post-likes', true );

          $n = intval( $count );
          $n++;
          update_post_meta( $post_id, 'my-post-likes', $n );
          update_user_meta($user, 'post='. $post_id.'likes', 1);
          $output_count = $n;

          $result['type'] = "success";
          $result['change'] = true;
      }

} else if(!is_user_logged_in()){
    $result['logged'] = false;
}
    $result['count'] = strval($output_count);
    echo json_encode( $result );
    die();
}


/**
 * User post dislike
 */
add_action( 'wp_ajax_my_user_dislike', 'my_user_dislike');
add_action( 'wp_ajax_nopriv_my_user_dislike', 'my_user_dislike');

function my_user_dislike() {
    
  $result = [];
  $result['logged'] = true;
  $post_id = intval( $_POST['post_id'] );
  if( filter_var( $post_id, FILTER_VALIDATE_INT ) && is_user_logged_in()) {

    $article = get_post( $post_id );
    $output_count = 0;
    $user = get_current_user_id();
    $user_meta_dislikes= get_user_meta($user, 'post='. $post_id.'dislikes', true );
    $user_meta_likes= get_user_meta($user, 'post='. $post_id.'likes', true );

    $user_meta_dislikes = ( $user_meta_dislikes == "") ? 0 : $user_meta_dislikes;
    $user_meta_likes = ( $user_meta_likes == "") ? 0 :  $user_meta_likes;
   

    if( !is_null( $article ) && !$user_meta_dislikes && !$user_meta_likes) {
        $count = get_post_meta( $post_id, 'my-post-dislikes', true );
        if( $count == '' ) {
            update_post_meta( $post_id, 'my-post-dislikes', '1' );
            update_user_meta($user, 'post='. $post_id.'dislikes', 1);
            $output_count = 1;
            $result['type'] = "success";
            
        } else {
            $n = intval($count);
            $n++;
            update_post_meta( $post_id, 'my-post-dislikes', $n );
            update_user_meta($user, 'post='. $post_id.'dislikes', 1);
            $output_count = $n;
            $result['type'] = "success";
        }

    } elseif($user_meta_dislikes) {
      $count = get_post_meta( $post_id, 'my-post-dislikes', true );
      if( $count ) {
        $n = intval( $count );
        $n--;

        update_post_meta( $post_id, 'my-post-dislikes', $n );
        update_user_meta($user, 'post='. $post_id.'dislikes', 0);

        $output_count = $n;
        $result['type'] = "success";
      } 
    }  elseif ($user_meta_likes && !$user_meta_dislikes){
        $count = get_post_meta( $post_id, 'my-post-dislikes', true );

        $n = intval( $count );
        $n++;
        update_post_meta( $post_id, 'my-post-dislikes', $n );
        update_user_meta($user, 'post='. $post_id.'dislikes', 1);
        $output_count = $n;

        $result['type'] = "success";
        $result['change'] = true;
  }
} else if(!is_user_logged_in()){
    $result['logged'] = false;
}
    $result['count'] = strval($output_count);
    echo json_encode( $result );
    die();
}

/**
 * Add columns to cpt:probleme to dashboard
 */

add_filter( 'manage_problema_posts_columns', 'problema_posts_columns' );
function problema_posts_columns( $columns ) {
  $columns['like'] = __( 'Like' , 'problema');
  $columns['dislike'] = __( 'Dislike', 'problema' );
  $columns['favorite'] = __( 'Postare favorită', 'problema' );
  return $columns;
}



add_action( 'manage_problema_posts_custom_column', 'problema_columns', 10, 2);
function problema_columns( $column, $post_id ) {

  if ( 'like' === $column ) {
    $likes = get_post_meta( $post_id, 'my-post-likes', true );
    echo $likes ;
  }

  if ( 'dislike' === $column ) {  
    $dislikes = get_post_meta( $post_id, 'my-post-dislikes', true );
    echo $dislikes;
  }

  if ( 'favorite' === $column ) {
    $favorite = get_post_meta( $post_id, 'favorite-post', true );
    echo $favorite  ;
  }
}


/**
 * Order comments fields - mame, email website, comment
 */

add_filter( 'comment_form_fields', 'comment_fields_custom_order' );
function comment_fields_custom_order( $fields ) {
    $comment_field = $fields['comment'];
    $author_field = $fields['author'];
    $email_field = $fields['email'];
    $url_field = $fields['url'];
    $cookies_field = $fields['cookies'];
    unset( $fields['comment'] );
    unset( $fields['author'] );
    unset( $fields['email'] );
    unset( $fields['url'] );
    unset( $fields['cookies'] );
    // the order of fields is the order below, change it as needed:
    $fields['author'] = $author_field;
    $fields['email'] = $email_field;
    $fields['url'] = $url_field;
    $fields['comment'] = $comment_field;
    $fields['cookies'] = $cookies_field;
    // done ordering, now return the fields:
    return $fields;
}


/**
 * Edit wp_list_comment - remove says text and others 
 */

function mytheme_comment($comment, $args, $depth) {
  if ( 'div' === $args['style'] ) {
      $tag       = 'div';
      $add_below = 'comment';
  } else {
      $tag       = 'div';
      $add_below = 'div-comment';
  }?>
  
  
  <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
  if ( 'div' != $args['style'] ) { ?>
      <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
  } ?>
      <div class="comment-author vcard"><?php 
          if ( $args['avatar_size'] != 0 ) {
              echo get_avatar( $comment, $args['avatar_size'] ); 
          } 
     
         ?>
      </div>

      <div class="author-name_comment-text">
          <?php  printf( __( '<cite class="fn">%s</cite> <span class="says"></span>' ), get_comment_author_link() ); ?>
          <?php 
          if ( $comment->comment_approved == '0' ) { ?>
              <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php 
          } ?>

          <div class="comment-text"> <?php comment_text(); ?></div>
      </div>

      <div class="comment_reply">
          <div class="comment-meta commentmetadata">
              <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
                
                <div class="comment-meta-style"> <?=  get_comment_date(); ?> </div> 

              </a><?php 
              edit_comment_link( __( '(Edit)' ), '  ', '' ); ?>
          </div>

          <div class="reply"><?php 
                  comment_reply_link( 
                      array_merge( 
                          $args, 
                          array( 
                              'add_below' => $add_below, 
                              'depth'     => $depth, 
                              'max_depth' => $args['max_depth'] 
                          ) 
                      ) 
                  ); ?>
          </div> 
        </div>

      <?php
  if ( 'div' != $args['style'] ) : ?>
      </div><?php 
  endif;
}


// Guttenberg editor
function gutenberg_filter( $use_block_editor, $post_type ) {
	if ( 'post' === $post_type ) {
		return false;
	}
	return $use_block_editor;
}
add_filter( 'use_block_editor_for_post_type', 'gutenberg_filter', 10, 2 );


/**
 * Remove admin bar for users that is not administrator
 */

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}



/**
 * Show number of views
 */
function get_post_views($postID){
  $count = get_post_meta($postID, 'post_views_count', true);
  if($count==''){
      delete_post_meta($postID, 'post_views_count');
      add_post_meta($postID, 'post_views_count', '0');
      return "0";
  }
  return $count;
}

function set_post_views($postID) {
  $count = get_post_meta($postID, 'post_views_count', true);
  if($count==''){
      $count = 0;
      delete_post_meta($postID, 'post_views_count');
      add_post_meta($postID, 'post_views_count', '0');
  } else {
      $count++;
      update_post_meta($postID, 'post_views_count', $count);
  }
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);