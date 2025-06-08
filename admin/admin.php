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
                    <h2>Kartly Settings Page</h2>
                    <h6>By- Kazi Mahmud Al Azad</h6>
                </div>
                <div class="kartly-admin-body">
                    <form action="" method="post">
                      <div class="kartly-topbar">
                        <h4>Kartly Topbar Area</h4>
                        <div class="options-area">
                            <div class="option-area-left">
                                <label for="">Cart Title: <input type="text" id="kartly_title" name="kartly_title" value="Kartly Cart"></label> 
                            </div>
                            <div class="option-area-middle">
                                <label for="">Cart Title Background: <input type="color" id="title_bg" name="title_bg" value="#002f49"></label>
                            </div>
                            <div class="option-area-right">
                                <label for="">Cart Title Color: <input type="color" id="title_color" name="title_color" value="#f0e1b8"></label> 
                            </div>
                        </div>
                        
                          
                        
                      </div>  
                       
                    </form>
                </div>
            </div>
    <?php
        }

}

