

            <!-- footer -->

             <footer>

                <div class="container">

                    <div class="row">

                        <div class="col-md-7">

                            <div class="form-wrapper">

                                <!-- <h4 class="footer-form-sub-heading">Wait up!</h4>

                                <h2 class="footer-form-heading">Subscribe to our newsletter</h2>

                                <div class="form-group">

                                    <div class="input-wrapper">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">

                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.0832 10.5002H2.9165C2.59509 10.5002 2.33317 10.2388 2.33317 9.91683V4.22933L6.64984 7.46683C6.75367 7.545 6.87675 7.5835 6.99984 7.5835C7.12292 7.5835 7.246 7.545 7.34984 7.46683L11.6665 4.22933V9.91683C11.6665 10.2388 11.4046 10.5002 11.0832 10.5002ZM10.6941 3.50016L6.99984 6.271L3.30559 3.50016H10.6941ZM11.0832 2.3335H2.9165C1.95167 2.3335 1.1665 3.11866 1.1665 4.0835V9.91683C1.1665 10.8817 1.95167 11.6668 2.9165 11.6668H11.0832C12.048 11.6668 12.8332 10.8817 12.8332 9.91683V4.0835C12.8332 3.11866 12.048 2.3335 11.0832 2.3335Z" fill="#9FA3AA"/>

                                          </svg>

                                    <input type="text" id="address" class="form-control" placeholder="Enter Delivery Address....">

                                </div>

                                    <button class="btn btn-outline-success" type="submit"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/Right Up.svg" alt=""></button> 

                                </div> -->

                                <div class="form-wrapper tnp tnp-subscription">

                                    <h4 class="footer-form-sub-heading">Wait up!</h4>

                                    <h2 class="footer-form-heading">Subscribe to our newsletter</h2>

                                    <form method="post" action="https://relish.appstechy.com/?na=s">

                                        <input type="hidden" name="nlang" value="">

                                        <div class="form-group">

                                            <div class="input-wrapper">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">

                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.0832 10.5002H2.9165C2.59509 10.5002 2.33317 10.2388 2.33317 9.91683V4.22933L6.64984 7.46683C6.75367 7.545 6.87675 7.5835 6.99984 7.5835C7.12292 7.5835 7.246 7.545 7.34984 7.46683L11.6665 4.22933V9.91683C11.6665 10.2388 11.4046 10.5002 11.0832 10.5002ZM10.6941 3.50016L6.99984 6.271L3.30559 3.50016H10.6941ZM11.0832 2.3335H2.9165C1.95167 2.3335 1.1665 3.11866 1.1665 4.0835V9.91683C1.1665 10.8817 1.95167 11.6668 2.9165 11.6668H11.0832C12.048 11.6668 12.8332 10.8817 12.8332 9.91683V4.0835C12.8332 3.11866 12.048 2.3335 11.0832 2.3335Z" fill="#9FA3AA"></path>

                                                  </svg>

                                            <input type="email" id="custom_email_address" class="form-control tnp-email" name="ne" placeholder="Email" required>

                                        </div>

                                            <button class="btn btn-outline-success" type="submit"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/Right Up.svg" alt=""></button> 

                                        </div>

                                    </form>

                                   

                               </div>

                               

                               </div>

                        </div>

                        <div class="col-md-5">

                            <div class="footer-navigation">

                                <div class="fooeter-nav">

                                    <h4>Navigation</h4>

                                    <?php

                                    wp_nav_menu( array(

                                       'theme_location' => 'menu-2',

                                    ));

                                    ?>



                                    <!-- <ul>

                                        <li><a href="">Home</a></li>

                                        <li><a href="">About</a></li>

                                        <li><a href="">Contact</a></li>

                                        <li><a href="">Log In</a></li>

                                    </ul> -->

                                </div>

                                <div class="fooeter-nav">

                                    <?php dynamic_sidebar('footer_contact_info') ?>

                                    <!-- <h4>Contact</h4>

                                    <ul>

                                        <li><a href="tel:+1 (001) 981-76-17">+1 (001) 981-76-17</a></li>

                                        <li><a href="email:info@gmail.com">info@gmail.com</a></li>

                                    </ul> -->

                                </div>

                            </div>

                            <div class="social-wrapper">

                                <?php

                                $attr = array (

                                    'width' => '16', //input only number, in pixel

                                    'height' => '16', //input only number, in pixel

                                    'margin' => '30', //input only number, in pixel

                                    'display' => 'horizontal', //horizontal | vertical

                                    'alignment' => 'center', //center | left | right

                                    'attr_id' => 'custom_icon_id', //add custom id to <ul> wraper

                                    'attr_class' => 'footer-social-media', //add custom class to <ul> wraper

                                    // 'selected_icons' => array ( '1', '3', '5', '6' )

                                    //you can get the icon ID form All Icons page

                                );

                                if ( function_exists('cn_social_icon') ) echo cn_social_icon( $attr );

                                ?>

                                <!-- <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="18" height="16" viewBox="0 0 18 16" fill="none">

                                    <path d="M1.23741 6.95746C6.06923 4.84063 9.29121 3.44509 10.9033 2.77083C15.5063 0.845685 16.4627 0.511267 17.0861 0.500107C17.2232 0.497796 17.5298 0.531965 17.7284 0.693996C17.8961 0.830811 17.9422 1.01563 17.9643 1.14535C17.9864 1.27506 18.0139 1.57056 17.992 1.80145C17.7426 4.43683 16.6633 10.8322 16.1142 13.7839C15.8818 15.0328 15.4244 15.4516 14.9815 15.4926C14.0189 15.5816 13.288 14.8529 12.3558 14.2385C10.897 13.2769 10.0729 12.6783 8.65691 11.74C7.02048 10.6557 8.08131 10.0597 9.0139 9.08566C9.25797 8.83076 13.4988 4.95196 13.5809 4.60009C13.5912 4.55608 13.6007 4.39204 13.5038 4.30543C13.4069 4.21881 13.2639 4.24843 13.1606 4.27199C13.0143 4.30538 10.6839 5.85425 6.16938 8.91859C5.5079 9.37533 4.90875 9.59787 4.37193 9.58621C3.78013 9.57335 2.64175 9.24974 1.79548 8.97313C0.757494 8.63385 -0.0674757 8.45447 0.00436067 7.87827C0.0417775 7.57814 0.452793 7.27121 1.23741 6.95746Z" fill="white"/>

                                  </svg></a>

                                  <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">

                                    <path d="M8 1.44578C10.1205 1.44578 10.4096 1.44578 11.2771 1.44578C12.0482 1.44578 12.4337 1.63855 12.7229 1.73494C13.1084 1.92771 13.3976 2.0241 13.6867 2.31325C13.9759 2.60241 14.1687 2.89157 14.2651 3.27711C14.3614 3.56627 14.4578 3.95181 14.5542 4.72289C14.5542 5.59036 14.5542 5.78313 14.5542 8C14.5542 10.2169 14.5542 10.4096 14.5542 11.2771C14.5542 12.0482 14.3614 12.4337 14.2651 12.7229C14.0723 13.1084 13.9759 13.3976 13.6867 13.6867C13.3976 13.9759 13.1084 14.1687 12.7229 14.2651C12.4337 14.3614 12.0482 14.4578 11.2771 14.5542C10.4096 14.5542 10.2169 14.5542 8 14.5542C5.78313 14.5542 5.59036 14.5542 4.72289 14.5542C3.95181 14.5542 3.56627 14.3614 3.27711 14.2651C2.89157 14.0723 2.60241 13.9759 2.31325 13.6867C2.0241 13.3976 1.83133 13.1084 1.73494 12.7229C1.63855 12.4337 1.54217 12.0482 1.44578 11.2771C1.44578 10.4096 1.44578 10.2169 1.44578 8C1.44578 5.78313 1.44578 5.59036 1.44578 4.72289C1.44578 3.95181 1.63855 3.56627 1.73494 3.27711C1.92771 2.89157 2.0241 2.60241 2.31325 2.31325C2.60241 2.0241 2.89157 1.83133 3.27711 1.73494C3.56627 1.63855 3.95181 1.54217 4.72289 1.44578C5.59036 1.44578 5.87952 1.44578 8 1.44578ZM8 0C5.78313 0 5.59036 0 4.72289 0C3.85542 0 3.27711 0.192772 2.79518 0.385543C2.31325 0.578314 1.83133 0.867471 1.3494 1.3494C0.867471 1.83133 0.674699 2.21687 0.385543 2.79518C0.192772 3.27711 0.0963856 3.85542 0 4.72289C0 5.59036 0 5.87952 0 8C0 10.2169 0 10.4096 0 11.2771C0 12.1446 0.192772 12.7229 0.385543 13.2048C0.578314 13.6867 0.867471 14.1687 1.3494 14.6506C1.83133 15.1325 2.21687 15.3253 2.79518 15.6145C3.27711 15.8072 3.85542 15.9036 4.72289 16C5.59036 16 5.87952 16 8 16C10.1205 16 10.4096 16 11.2771 16C12.1446 16 12.7229 15.8072 13.2048 15.6145C13.6867 15.4217 14.1687 15.1325 14.6506 14.6506C15.1325 14.1687 15.3253 13.7831 15.6145 13.2048C15.8072 12.7229 15.9036 12.1446 16 11.2771C16 10.4096 16 10.1205 16 8C16 5.87952 16 5.59036 16 4.72289C16 3.85542 15.8072 3.27711 15.6145 2.79518C15.4217 2.31325 15.1325 1.83133 14.6506 1.3494C14.1687 0.867471 13.7831 0.674699 13.2048 0.385543C12.7229 0.192772 12.1446 0.0963856 11.2771 0C10.4096 0 10.2169 0 8 0Z" fill="white"/>

                                    <path d="M8 3.85542C5.68675 3.85542 3.85542 5.68675 3.85542 8C3.85542 10.3133 5.68675 12.1446 8 12.1446C10.3133 12.1446 12.1446 10.3133 12.1446 8C12.1446 5.68675 10.3133 3.85542 8 3.85542ZM8 10.6988C6.55422 10.6988 5.30121 9.54217 5.30121 8C5.30121 6.55422 6.45783 5.30121 8 5.30121C9.44578 5.30121 10.6988 6.45783 10.6988 8C10.6988 9.44578 9.44578 10.6988 8 10.6988Z" fill="white"/>

                                    <path d="M12.241 4.72289C12.7733 4.72289 13.2048 4.29136 13.2048 3.75904C13.2048 3.22671 12.7733 2.79518 12.241 2.79518C11.7086 2.79518 11.2771 3.22671 11.2771 3.75904C11.2771 4.29136 11.7086 4.72289 12.241 4.72289Z" fill="white"/>

                                  </svg></a>

                                  <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" viewBox="0 0 20 16" fill="none">

                                    <path d="M19.5 2.77679C19.25 1.83929 18.625 1.16964 17.75 0.901786C16.25 0.5 9.87499 0.5 9.87499 0.5C9.87499 0.5 3.62501 0.5 2.00001 0.901786C1.12501 1.16964 0.499996 1.83929 0.249996 2.77679C-3.81842e-06 4.51786 0 8 0 8C0 8 3.7998e-06 11.4821 0.375004 13.2232C0.625004 14.1607 1.25 14.8304 2.125 15.0982C3.625 15.5 10 15.5 10 15.5C10 15.5 16.25 15.5 17.875 15.0982C18.75 14.8304 19.375 14.1607 19.625 13.2232C20 11.4821 20 8 20 8C20 8 20 4.51786 19.5 2.77679ZM7.99999 11.2143V4.78572L13.25 8L7.99999 11.2143Z" fill="white"/>

                                  </svg></a> -->

                            </div>

                        </div>

                        <div class="col-md-7 mt-4">

                            

                        </div>

                        <div class="col-md-5 mt-4">

                            <div class="privacy-wrpper  d-flex justify-content-between">

                                <a href="<?=site_url().'/privacy-policy'?>">Privacy</a>

                                <div>

                                    &copy;

                                    <span id="copyright">

                                        <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>

                                    </span>

                                    — Copyright

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

             </footer>

             <?php wp_footer() ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

  </body>

</html>