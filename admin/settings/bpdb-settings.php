<?php

    /**
    * Render the settings screen
    */

    function bgam_settings() {      
        
    ?>

    <style type="text/css">
        
        .faq-wrapper table.form-table th{
            font-size: 13px;
        }
        
    </style>

    <div class="wrap faq-wrapper">

       <h2><?php _e('BWL Google Analytics Manager Settings', 'bwl-adv-faq'); ?></h2>

           <?php 
           
                if (isset($_POST['bgam_settings']) && $_POST['bgam_settings'] == 1) {

                    $bgam_code = stripslashes($_POST['bgam_code']);
                    $bgam_status = stripslashes($_POST['bgam_status']);
                    $bgam_loc = stripslashes($_POST['bgam_loc']);
                    update_option('bgam_code', $bgam_code);
                    update_option('bgam_status', $bgam_status);
                    update_option('bgam_loc', $bgam_loc);
                
                } else {


                    $bgam_code = get_option('bgam_code');
                    $bgam_status = get_option('bgam_status');
                    $bgam_loc = get_option('bgam_loc');
                }
            
        ?>

       <form action="options-general.php?page=bgam-settings" method="post">
           <?php //settings_fields('bgam_options')?>
           <?php //do_settings_sections(__FILE__);?>
           
                <table class="form-table">

                   <input type="hidden" name="bgam_settings" value="1" />

                   <tbody>

                       <tr>
                           <th scope="row">Analytic Code: </th>
                           <td><textarea style="width: 100%; height: 300px;" id="bgam_code" name="bgam_code"><?php echo $bgam_code; ?></textarea></td>
                       </tr>
                       
                       <tr>
                           <th scope="row">Enable Code: </th>
                           <td>
                           
                           <select name="bgam_status" id="bgam_status">
                               <option value="0" <?php ($bgam_status==0) ? _e(' selected=selected', 'bwl-adv-faq') :''?>>No</option>
                               <option value="1" <?php ($bgam_status==1) ? _e(' selected=selected', 'bwl-adv-faq') :''?>>Yes</option>
                           </select>
                           </td>
                       </tr>
                       
                       <tr>
                           <th scope="row">Analytic Code Location: </th>
                           <td>
                           
                           <select name="bgam_loc" id="bgam_loc">
                               <option value="footer" <?php ($bgam_loc=='footer') ? _e(' selected=selected', 'bwl-adv-faq') :''?>>Footer</option>
                               <option value="header" <?php ($bgam_loc=='header') ? _e(' selected=selected', 'bwl-adv-faq') :''?>>Header</option>
                           </select>
                           </td>
                       </tr>

                   </tbody>
                   
               </table>

           <p class="submit">
               <input name="submit" type="submit" class="button-primary" value="<?php _e('Save Settings', 'bwl-adv-faq'); ?>"/>
           </p>
           
       </form>    

      </div> 

    <?php
        
    }
    
    /**
     * Add the settings page to the admin menu
     */
    
    function bgam_settings_submenu() {
        
        global $blog_id;
        
        if (isset($blog_id) && $blog_id == 1) {
        
            add_submenu_page(
                    'options-general.php', __('BWL Google Analytics Manager Settings', 'bwl-adv-faq'), __('BWL Google Analytics Manager', 'bwl-adv-faq'), 'administrator', 'bgam-settings', 'bgam_settings'
            );        
        
        }
        
    }

    add_action('admin_menu', 'bgam_settings_submenu');