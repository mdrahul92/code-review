<?php
/* Template Name: Home Page Template */

if ( is_user_logged_in() )   {
    $user_id = get_current_user_id();
   $address_ar =  get_user_meta( $user_id, 'address_lat_lng' );
   if($address_ar != "" && count($address_ar) != 0) {
    $address_fin= json_decode($address_ar[0])->address;
    if($address_fin != "") {
        wp_redirect('/?s=');
    }
   }
}
get_header();

$banner = get_field('banner');
$banner_text = $banner['banner_text'];
$banner_image = $banner['banner_image'];
?>

       <!-- header link wrapper -->
        <section class="partner-wrapper d-flex justify-content-center py-2">
            <a href="/home-landing-page/"><?php echo get_field('top_bar_text') ?></a>
        </section>

        <!-- hero section -->
         <section class="hero-section" style="background: url(<?php echo $banner_image['url'] ?>) no-repeat center bottom;background-size: cover;">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="hero-contant text-center">

                            <?php echo $banner_text ?>
                            <form action="" class="hero-form">
                                <label for="">Find ready meals near you</label>
                                <div class="form-wrapper hero-form">
                                    <div class="form-group">
                                        <div class="input-wrapper">
                                            <img src="<?php echo get_stylesheet_directory_uri() ?>/images/Pin.svg" alt="">
                                        <input type="text" id="address" class="form-control" placeholder="Enter Delivery Address....">
                                        </div>
                                        <?php if (!is_user_logged_in()) : ?>
                                        <div class="form-text mobile" >
                                            Sign in for saved address
                                        </div>
                                        <?php endif;?>
                                        <button class="btn btn-outline-success address_validation" type="button"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/Right Up.svg" alt=""></button> 
                                    </div>

                                    <?php if (!is_user_logged_in()) : ?>
                                    <div class="form-text desktop"  >
                                        Sign in for saved address
                                    </div>
                                    <?php endif;?>
                                    
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
         </section>
         <!-- end hero section -->

         <!-- contant section -->
          <section class="contant-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-10">
                        <div class="section-heading">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
          </section>
          <!--  steps -->
          <?php
          $steps = get_field('steps');
          // echo "<pre>";
          // print_r($steps);
          // echo "</pre>";
          foreach ($steps as $key => $step) { 
            if(($key+1)%2 != 0){
          ?>

          <div class=" order-step-wrapper even" style="background: url(<?php echo $step['upload_image']['url'] ?>) no-repeat left top; background-size: contain;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">
                        <div class="step-card">
                            <?php echo $step['text'] ?>  
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <?php
            }else{
        ?>

        <div class=" order-step-wrapper odd" style="background: url(<?php echo $step['upload_image']['url'] ?>) no-repeat right top; background-size: contain;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="step-card">
                            <?php echo $step['text'] ?>
                        </div>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
            </div>
          </div>
        <?php
            }
          }
          ?>
          
          <!-- faq section -->
           <section class="faq-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="faq-heading">
                            <h2>FAQ</h2>
                            <h5>Still Have Some Questions for Us?</h5>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="faq-content">
                            <div class="accordion" id="accordionExample">
                                <?php
                                $args = array(
                                    'post_type' => 'faqs',
                                    'posts_per_page' => -1, // Display all FAQs
                                    'order' => 'ASC' // Order by title or date
                                );
                                $faq_query = new WP_Query($args);
                                if ($faq_query->have_posts()) : 
                                    $k = 0;
                                    while ($faq_query->have_posts()) : $faq_query->the_post(); 
                                ?>
                                <div class="accordion-item">
                                  <h2 class="accordion-header" id="heading<?php echo $k+1 ?>">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $k+1 ?>" aria-expanded="true" aria-controls="collapseOne">
                                        <?php the_title(); ?>
                                    </button>
                                  </h2>
                                  <div id="collapse<?php echo $k+1 ?>" class="accordion-collapse collapse <?php echo ($k == 0)?"show":""; ?>" aria-labelledby="heading<?php echo $k+1 ?>" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php the_content(); ?>
                                    </div>
                                  </div>
                                </div>
                                    <div class="faq-item">
                                        <h2></h2>
                                        <div class="faq-content"></div>
                                    </div>

                                <?php 
                                    $k++;
                                    endwhile; 
                                    wp_reset_postdata(); 
                                else : 
                                ?>
                                    <p>No FAQs found.</p>
                                <?php endif; ?>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
           </section>


           <?php if(!is_user_logged_in()){  ?>
           <!-- form section -->
            <section class="form-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                        </div>
                        <div class="col-md-5">
                            <div class="form-contant-wrapper">
                                <h2>Let’s Get You Signed Up!</h2>
                                <?php 
                                echo do_shortcode('[user_registration_form id="201"]'); 
                                ?>


                                <div class="col-12 mt-4 homepage-social-login">
                                    <p class="or">Or</p>
                                </div>

                                <div class="col-12 mt-4 ps-2 pe-2">
                                    <a href="https://relish.appstechy.com/wp-login.php?loginSocial=facebook" data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="facebook" data-popupwidth="600" data-popupheight="679" class="btn btn-primary fb-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <g clip-path="url(#clip0_6890_390)">
                                                <rect width="19.2696" height="19.2696" transform="translate(0.243164 0.678223)" fill="#02A0FC"></rect>
                                                <path d="M19.1112 10.3691C19.1112 5.26964 14.9773 1.13574 9.87786 1.13574C4.77843 1.13574 0.644531 5.26964 0.644531 10.3691C0.644531 14.9777 4.02103 18.7976 8.43516 19.4902V13.0381H6.09075V10.3691H8.43516V8.33485C8.43516 6.02075 9.81363 4.74251 11.9227 4.74251C12.9329 4.74251 13.9896 4.92285 13.9896 4.92285V7.19511H12.8253C11.6783 7.19511 11.3206 7.90685 11.3206 8.63704V10.3691H13.8814L13.472 13.0381H11.3206V19.4902C15.7347 18.7976 19.1112 14.9777 19.1112 10.3691Z" fill="white"></path>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_6890_390">
                                                    <rect width="19.2696" height="19.2696" fill="white" transform="translate(0.243164 0.678223)"></rect>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                        Continue with Facebook
                                    </a>
                                </div>
                                <div class="col-12 mt-4 ps-2 pe-2">
                                    <a href="https://relish.appstechy.com/wp-login.php?loginSocial=google" data-plugin="nsl" data-action="connect" data-redirect="current" data-provider="google" data-popupwidth="600" data-popupheight="600" class="btn btn-primary google-btn login-google-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                                            <rect width="19.2696" height="19.2696" transform="translate(0.841797 0.034668)" fill="white"></rect>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M19.3386 9.87936C19.3386 9.22463 19.2799 8.59509 19.1707 7.99072H10.4746V11.5623H15.4438C15.2298 12.7165 14.5792 13.6944 13.6014 14.3491V16.6659H16.5854C18.3313 15.0584 19.3386 12.6913 19.3386 9.87936Z" fill="#02A0FC"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.4759 18.9028C12.9689 18.9028 15.0589 18.076 16.5866 16.6658L13.6026 14.3491C12.7758 14.9031 11.7182 15.2305 10.4759 15.2305C8.07099 15.2305 6.03546 13.6063 5.30938 11.4238H2.22461V13.8161C3.74391 16.8337 6.86646 18.9028 10.4759 18.9028Z" fill="#34B53A"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.30905 11.4234C5.12438 10.8694 5.01946 10.2776 5.01946 9.66907C5.01946 9.06051 5.12438 8.46873 5.30905 7.91473V5.52246H2.22428C1.59893 6.76896 1.24219 8.17914 1.24219 9.66907C1.24219 11.159 1.59893 12.5692 2.22428 13.8157L5.30905 11.4234Z" fill="#FFB200"></path>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.4759 4.10838C11.8315 4.10838 13.0486 4.57425 14.0055 5.48919L16.6538 2.8409C15.0547 1.35097 12.9647 0.436035 10.4759 0.436035C6.86646 0.436035 3.74391 2.50514 2.22461 5.52276L5.30938 7.91503C6.03546 5.73261 8.07099 4.10838 10.4759 4.10838Z" fill="#FF3A29"></path>
                                        </svg>
                                        Continue with Google
                                    </a>
                                </div>

                                <div class="col-12 mt-4 homepage-login-text-on-signup-form">
                                    <p class="sign-up-txt text-center">Already have an account? <a href="/login">Sign in!</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php } ?>
<?php get_footer(); ?>