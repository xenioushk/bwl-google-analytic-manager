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

       <h2><?php _e('BWL Google Analytics Manager Settings', 'bwl_gam'); ?></h2>

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
           
                <table class="form-table">

                   <input type="hidden" name="bgam_settings" value="1" />

                   <tbody>

                       <tr>
                           <th scope="row"><?php _e('Analytic Code', 'bwl_gam') ?>: </th>
                           <td><textarea style="width: 100%; height: 300px;" id="bgam_code" name="bgam_code"><?php echo $bgam_code; ?></textarea></td>
                       </tr>
                       
                       <tr>
                           <th scope="row"><?php _e('Enable Code', 'bwl_gam') ?>: </th>
                           <td>
                           
                           <select name="bgam_status" id="bgam_status">
                               <option value="0" <?php echo ($bgam_status==0) ? 'selected=selected' :''; ?>>No</option>
                               <option value="1" <?php echo ($bgam_status==1) ? 'selected=selected' :''; ?>>Yes</option>
                           </select>
                           </td>
                       </tr>
                       
                       <tr>
                           <th scope="row"><?php _e('Analytic Code Location', 'bwl_gam') ?>: </th>
                           <td>
                           
                           <select name="bgam_loc" id="bgam_loc">
                               <option value="footer" <?php echo ($bgam_loc=='footer') ? 'selected=selected' :''; ?>>Footer</option>
                               <option value="header" <?php echo ($bgam_loc=='header') ? 'selected=selected' :''; ?>>Header</option>
                           </select>
                           </td>
                       </tr>

                   </tbody>
                   
               </table>

           <p class="submit">
               <input name="submit" type="submit" class="button-primary" value="<?php _e('Save Settings', 'bwl_gam'); ?>"/>
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
                    'options-general.php', __('BWL Google Analytics Manager Settings', 'bwl_gam'), 'Analytics Manager', 'administrator', 'bgam-settings', 'bgam_settings'
            );        
        
        }
        
    }

    add_action('admin_menu', 'bgam_settings_submenu');