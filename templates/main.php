<div class="wrap st-funnel-wrap">
    <h2> Funnel Settings</h2>
    <?php if (isset($_SESSION['funnel']['user_message'])): ?>
        <div class="notice notice-<?php echo $_SESSION['funnel']['user_message']['type']; ?> is-dismissible">
            <p><?php _e($_SESSION['funnel']['user_message']['message'], 'funnel'); ?></p>        
        </div>
        <?php
        unset($_SESSION['funnel']['user_message']);
    endif;
    ?>
    <div class="container">
        <form class="funnel-data" action="#" method="post">
            <!-- EarnWare Account and transaction information -->
            <div class="form-inner-wrap">
                <header class="tab-headers">
                    <div class="header active">
                        <label for="tab2">
                            <span class="dashicons dashicons-list-view"></span>  <span><?php echo apply_filters('st_funnel_konnektive_crm_section_header', __('Konnektive CRM Details')); ?></span>
                            <input type="radio" name="selected_tab" value="#api" id="tab2"/>
                        </label>
                    </div>
                    <div class="header">
                        <label for="tab1">
                            <span class="dashicons dashicons-id-alt"></span> <span> <?php echo apply_filters('st_funnel_earnware_api_section_header', __('Earnware API Details')); ?></span>
                            <input type="radio" name="selected_tab" value="#account-sec" id="tab1"/>
                        </label>
                    </div>
                    <div class="header">
                        <label for="tab3" >
                            <span class="dashicons dashicons-admin-links"></span> <span><?php echo apply_filters('st_funnel_api_endpoints_section_header', __('API Endpoints')); ?></span>
                            <input type="radio" name="selected_tab" value="#endpoints" id="tab3"/>
                        </label>
                    </div>
                    <div class="header">
                        <label for="tab5" >
                            <span class="dashicons dashicons-excerpt-view"></span><span><?php _e('Funnel Steps'); ?></span>
                            <input type="radio" name="selected_tab" value="#upsell-order" id="tab5"/>
                        </label>
                    </div>
                    <div class="header">
                        <label for="tab4" >
                            <span class="dashicons dashicons-admin-tools"></span> <span><?php _e('Debug'); ?></span>
                            <input type="radio" name="selected_tab" value="#debug" id="tab4"/>
                        </label>
                    </div>                    
                </header>
                <!-- Create Public array for konnektive api -->
                <section class="data-sec active" id="api" >
                    <h3><?php echo apply_filters('st_funnel_konnektive_crm_section_header', __('Konnektive CRM Details')); ?></h3>    
                    <table>
                        <tbody align='left'>
                            <tr>
                                <th>Campaign Name
                                </th>
                                <td><input  name="funnel_konnektive_api[campaignName]" value="<?php echo (!isset($konnektive['campaignName'])) ? '' : $konnektive['campaignName']; ?>" type="text" placeholder="Enter Campaign Name"/> </td>
                            </tr>
                            <tr>
                                <th>Campaign id
                                </th>
                                <td><input  name="funnel_konnektive_api[campaignId]" value="<?php echo (!isset($konnektive['campaignId'])) ? '' : $konnektive['campaignId']; ?>" type="text" placeholder="Enter Campaign Id"/> </td>
                            </tr>
                            <tr>
                                <th>API Login   
                                </th>
                                <td><input  name="funnel_konnektive_api[loginId]" value="<?php echo (!isset($konnektive['loginId'])) ? '' : $konnektive['loginId']; ?>" type="text" placeholder="Enter Login Id"/> </td>
                            </tr>
                            <tr>
                                <th>Password
                                </th>
                                <td><input  name="funnel_konnektive_api[password]" value="<?php echo (!isset($konnektive['password'])) ? '' : $konnektive['password']; ?>" type="text" placeholder="Enter API password"/> </td>
                            </tr>
                            <tr>
                                <th>Pay Source
                                </th>
                                <td><input  name="funnel_konnektive_api[paySource]" value="<?php echo (!isset($konnektive['paySource'])) ? 'CREDITCARD' : $konnektive['paySource']; ?>" type="text" placeholder="Enter Pay Source" readonly/> </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                
                <section class="data-sec" id="account-sec">
                    <h3><?php echo apply_filters('st_funnel_earnware_api_section_header', __('Earnware API Details')); ?></h3>
                    <table>
                        <tbody align='left'>
                            <tr>
                                <th>User ID</th>
                                <td>
                                    <input  name="funnel_earnware[userId]" value="<?php echo (!isset($earnware['userId'])) ? '' : $earnware['userId']; ?>" type="text" placeholder="Enter Earnware user Id"/> 
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h4>Lead</h4>
                                </td>
                            </tr>
                            <tr>
                                <th>Key <small>(Lists)</small></th>
                                <td> 
                                    <input  name="funnel_earnware[lead][key]" value="<?php echo (!isset($earnware['lead']['key'])) ? '' : $earnware['lead']['key']; ?>" type="text" placeholder="Enter Lead Key"/> 
                                </td>
                            </tr>
                            <tr>
                                <th>Tag Lead</th>
                                <td> 
                                    <input  name="funnel_earnware[lead][tagLead]" value="<?php echo (!isset($earnware['lead']['tagLead'])) ? '' : $earnware['lead']['tagLead']; ?>" type="text" placeholder="Enter Lead Tag"/> 
                                </td>
                            </tr>
                            <tr>
                                <th>Campaign</th>
                                <td> 
                                    <input  name="funnel_earnware[lead][campaign]" value="<?php echo (!isset($earnware['lead']['campaign'])) ? '' : $earnware['lead']['campaign']; ?>" type="text" placeholder="Enter Lead Campaign"/> 
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h4>Buyer</h4>
                                </td>
                            </tr>
                            <tr>
                                <th>Key <small>(Lists Check)</small></th>
                                <td> 
                                    <input  name="funnel_earnware[buyer][key]" value="<?php echo (!isset($earnware['buyer']['key'])) ? '' : $earnware['buyer']['key']; ?>" type="text" placeholder="Enter Buyer Key"/> 
                                </td>
                            </tr>
                            <tr>
                                <th>Tag Purchase</th>
                                <td> 
                                    <input  name="funnel_earnware[buyer][tagPurchase]" value="<?php echo (!isset($earnware['buyer']['tagPurchase'])) ? '' : $earnware['buyer']['tagPurchase']; ?>" type="text" placeholder="Enter Tag Purchase"/> 
                                </td>
                            </tr>
                            <tr>
                                <th>Tag Order Bump</th>
                                <td> 
                                    <input  name="funnel_earnware[buyer][tagOrderBump]" value="<?php echo (!isset($earnware['buyer']['tagOrderBump'])) ? '' : $earnware['buyer']['tagOrderBump']; ?>" type="text" placeholder="Enter Tag Order Bump"/> 
                                </td>
                            </tr>
                            <tr>
                                <th>Content</th>
                                <td> 
                                    <input  name="funnel_earnware[buyer][content]" value="<?php echo (!isset($earnware['buyer']['content'])) ? '' : $earnware['buyer']['content']; ?>" type="text" placeholder="Enter Buyer Content"/> 
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <h4>Membership Buyer</h4>
                                </td>
                            </tr>
                            <tr>
                                <th>Key <small>(Lists Up-sell)</small></th>
                                <td> 
                                    <input  name="funnel_earnware[membershipBuyer][key]" value="<?php echo (!isset($earnware['membershipBuyer']['key'])) ? '' : $earnware['membershipBuyer']['key']; ?>" type="text" placeholder="Enter Membership Buyer Key"/> 
                                </td>
                            </tr>
                            <tr>
                                <th>Tag</th>
                                <td> 
                                    <input  name="funnel_earnware[membershipBuyer][tag]" value="<?php echo (!isset($earnware['membershipBuyer']['tag'])) ? '' : $earnware['membershipBuyer']['tag']; ?>" type="text" placeholder="Enter Membership Buyer Tag"/> 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <!-- konnektive url and earWare endpoints -->
                <section class="data-sec " id="endpoints">
                    <h3><?php echo apply_filters('st_funnel_api_endpoints_section_header', __('API Endpoints')); ?></h3>
                    <table>
                        <tbody align='left'>
                            <tr>
                                <th>Partial URL
                                </th>
                                <td><input  name="funnel_api_endpoints[partial]" value="<?php echo (!isset($endpoints['partial'])) ? '' : $endpoints['partial']; ?>" type="text" placeholder="Enter Partial endpoint"/> </td>
                            </tr>
                            <tr>
                                <th>Order URL
                                </th>
                                <td><input  name="funnel_api_endpoints[order]" value="<?php echo (!isset($endpoints['order'])) ? '' : $endpoints['order']; ?>" type="text" placeholder="Enter order endpoint"/> </td>
                            </tr>
                            <tr>
                                <th>Upsell URL
                                </th>
                                <td> <input  name="funnel_api_endpoints[upsell]" value="<?php echo (!isset($endpoints['upsell'])) ? '' : $endpoints['upsell']; ?>" type="text" placeholder="Enter upsell endpoint"/> </td>
                            </tr>
                            <tr>
                                <th>Click URL
                                </th>
                                <td> <input  name="funnel_api_endpoints[click]" value="<?php echo (!isset($endpoints['click'])) ? '' : $endpoints['click']; ?>" type="text" placeholder="Enter click endpoint"/> </td>
                            </tr>
                            <tr>
                                <th>Query Order
                                </th>
                                <td> <input  name="funnel_api_endpoints[queryOrder]" value="<?php echo (!isset($endpoints['queryOrder'])) ? '' : $endpoints['queryOrder']; ?>" type="text" placeholder="Enter query order endpoint"/> </td>
                            </tr>
                            <tr>
                                <th>Earnware API
                                </th>
                                <td><input  name="funnel_api_endpoints[EarnApiURL]" value="<?php echo (!isset($endpoints['EarnApiURL'])) ? '' : $endpoints['EarnApiURL']; ?>" type="text" placeholder="Enter EarnApiURL "/> </td>
                            </tr>
                        </tbody>
                    </table>
                </section>
                <section class="data-sec " id="upsell-order">
                    <h3><?php _e('Funnel Steps'); ?></h3>       
                    <!-- <?php var_dump($funnel_steps); ?>      -->
                    <ul class="draggable-list <?php echo (!empty($funnel_steps))? "has-items": "";?>">
                        <?php if(!empty($funnel_steps)):?>
                            <?php foreach($funnel_steps  as $index => $upsell_item): ?>
                                <li class="drag-item <?php echo $upsell_item->type; ?>" id="upl-<?php echo $index;?>" >
                                    <span class="dashicons" title="Step Type:&nbsp;&nbsp;<?php echo $upsell_item->type; ?>"></span>
                                    <input type="hidden" name="funnel_steps[]" value='<?php echo addslashes(json_encode($upsell_item, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE )); ?>'/>
                                    <div class="select-wrap disabled">
                                        <?php wp_dropdown_pages([
                                            "show_option_none" => "Select a Page",
                                            "class" => $upsell_item->type,
                                            "selected" => $upsell_item->page,
                                            "hierarchical" => 0 
                                        ]); ?>
                                    </div>
                                    <ul class="action-list">
                                        <li class="upsell-edit">Edit</li>
                                        <li class="upsell-delete">Delete</li>
                                    </ul>
                                </li>                        
                            <?php endforeach; ?>
                        <?php endif;?>
                    </ul>
                    <table class="upsell-table">
                        <tbody align='left'>      
                            <tr>
                                <th>Step Type</th>
                                <td> 
                                    <select name="funnel_step-type" class="funnel_step-type">
                                        <option selected disabled value="">Select a Type</option>
                                        <option value="upsell">Upsell</option>
                                        <option value="downsell">Downsell</option>
                                    </select>
                                </td>
                                <td> 
                                    <input  type="button" data-target="" id="new-upsell" class="button button-primary" value="Add New">
                                </td>
                            </tr>                            
                        </tbody>
                    </table>
                </section>
                <section class="data-sec " id="debug">
                    <h3><?php _e('Debug settings'); ?></h3>
                    <table>
                        <tbody align='left'>      
                            <tr>
                                <th class="api-log-th">API Logs</th>
                                <td> 
                                    <label class="d-block" for="earnware-log">
                                        <input  name="funnel_debug[earnware][log]" value="active" <?php (isset($debug['earnware']))? checked($debug['earnware']['log'], 'active') : '';?> type="checkbox" id="earnware-log"/> 
                                        Enable Earnware API Log
                                    </label>
                                    <label class="d-block" for="konnektive-log">
                                        <input  name="funnel_debug[konnektive][log]" value="active" <?php (isset($debug['konnektive']))? checked($debug['konnektive']['log'], 'active') : '';?> type="checkbox" id="konnektive-log"/> 
                                        Enable Konnektive API Log
                                    </label>
                                </td>
                            </tr>                            
                        </tbody>
                    </table>
                </section>
            </div>
            <div class="form-action">
                <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>               
            </div>
        </form>
    </div>

</div>