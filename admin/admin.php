<?php


namespace WSCART; 


// Exit if accessed directly
if( !defined( 'ABSPATH' )){
    exit;
}

class Admin{

    public function __construct(){
        $this->image_url = WOOCOMMERCE_SIDECART_URL . 'assets/img/kartly-logo-icon.png';
        add_action('admin_menu', array($this, 'kartly_admin_page'));
    }


     

    public function kartly_admin_page(){
        add_menu_page( 
            "Kartly Settings", 
            "Kartly Settings", 
            "manage_options", 
            "kartly-settings", 
            array($this, "kartly_admin_callback"), 
            $this->image_url, 
            6
        );
    }

    public function kartly_admin_callback(){ ?>
            <div class="kartly-admin-container">
               
                <div class="kartly-admin-title">
                    <!-- <img src="<?php echo WOOCOMMERCE_SIDECART_URL . 'assets/img/kartly-logo.png'; ?>" alt=""> -->
                    <h2>Kartly Settings Page</h2>
                    <h6>By- Kazi Mahmud Al Azad</h6>
                </div>
                <div class="kartly-admin-body">
                    <div class="kartly-sidebar">
                        <div class="kartly-cart-settings-sidebar active">
                            <span class="light"></span><span>Cart Topbar Settings</span>
                        </div>
                        <div class="kartly-cart-settings-sidebar">
                             <span class="light"></span><span>Cart Items Settings</span>
                        </div>
                        <div class="kartly-cart-settings-sidebar">
                             <span class="light"></span><span>Cart Related Items Settings</span>
                        </div>
                        <div class="kartly-cart-settings-sidebar">
                             <span class="light"></span><span>Cart Buttons Settings</span>
                        </div>
                    </div>
                    <div class="kartly-options-area">
                        <div class="kartly-cart-settings">
                            <ul class="kartly-cart-section-wrapper">
                                <li class="active">
                                    <div class="kartly-topbar">
                                        <span>Kartly Topbar Settings</span>
                                        <div class="options-area">
                                            <form action="" method="post">
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="kartly_title">Cart Title: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                        <input type="text" id="kartly_title" name="kartly_title" value="Kartly Cart">
                                                    </div>
                                                    
                                                </div>
                                                <div class="settings-input">
                                                     <div class="settings-label">
                                                        <label for="title_bg">Cart Title Background: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                        <input type="color" id="title_bg" name="title_bg" value="#002f49">
                                                    </div>

                                                     
                                                </div>
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="title_color">Cart Title Color: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                         <input type="color" id="title_color" name="title_color" value="#f0e1b8">
                                                    </div>

                                                  
                                                </div>
                                                <div class="settings-input">
                                                    <input type="submit" id="topbar_submit" name="topbar_submit" value="Save">
                                                </div>
                                            </form>
                                        </div> 
                                    </div>    
                                   
                                </li>
                                <li>
                                     <div class="kartly-items">
                                        <span>Kartly Items Settings</span>
                                        <div class="options-area">
                                            <form action="" method="post">
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="kartly_title">Cart Title: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                        <input type="text" id="kartly_title" name="kartly_title" value="Kartly Cart">
                                                    </div>
                                                    
                                                </div>
                                                <div class="settings-input">
                                                     <div class="settings-label">
                                                        <label for="title_bg">Cart Title Background: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                        <input type="color" id="title_bg" name="title_bg" value="#002f49">
                                                    </div>

                                                     
                                                </div>
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="title_color">Cart Title Color: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                         <input type="color" id="title_color" name="title_color" value="#f0e1b8">
                                                    </div>

                                                  
                                                </div>
                                                <div class="settings-input">
                                                    <input type="submit" id="topbar_submit" name="topbar_submit" value="Save">
                                                </div>
                                            </form>
                                        </div> 
                                    </div>  
                                </li>
                                <li>
                                      <div class="kartly-realted">
                                        <span>Kartly Related Items Settings</span>
                                        <div class="options-area">
                                            <form action="" method="post">
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="kartly_title">Cart Title: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                        <input type="text" id="kartly_title" name="kartly_title" value="Kartly Cart">
                                                    </div>
                                                    
                                                </div>
                                                <div class="settings-input">
                                                     <div class="settings-label">
                                                        <label for="title_bg">Cart Title Background: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                        <input type="color" id="title_bg" name="title_bg" value="#002f49">
                                                    </div>

                                                     
                                                </div>
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="title_color">Cart Title Color: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                         <input type="color" id="title_color" name="title_color" value="#f0e1b8">
                                                    </div>

                                                  
                                                </div>
                                                <div class="settings-input">
                                                    <input type="submit" id="topbar_submit" name="topbar_submit" value="Save">
                                                </div>
                                            </form>
                                        </div> 
                                    </div>  
                                </li>
                                <li>
                                      <div class="kartly-buttons">
                                        <span>Kartly Buttons Settings</span>
                                        <div class="options-area">
                                            <form action="" method="post">
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="kartly_title">Cart Title: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                        <input type="text" id="kartly_title" name="kartly_title" value="Kartly Cart">
                                                    </div>
                                                    
                                                </div>
                                                <div class="settings-input">
                                                     <div class="settings-label">
                                                        <label for="title_bg">Cart Title Background: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                        <input type="color" id="title_bg" name="title_bg" value="#002f49">
                                                    </div>

                                                     
                                                </div>
                                                <div class="settings-input">
                                                    <div class="settings-label">
                                                        <label for="title_color">Cart Title Color: </label>
                                                    </div>
                                                    <div class="setings-input-area">
                                                         <input type="color" id="title_color" name="title_color" value="#f0e1b8">
                                                    </div>

                                                  
                                                </div>
                                                <div class="settings-input">
                                                    <input type="submit" id="topbar_submit" name="topbar_submit" value="Save">
                                                </div>
                                            </form>
                                        </div> 
                                    </div>  
                                </li>
                            
                            </ul>            
                        </div>
                    </div>


                   
                </div>
            </div>
    <?php
        }

}

