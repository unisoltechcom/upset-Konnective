<div class="wrap st-funnel-wrap">
    <h1>API Logs</h1>
    <h2 class="nav-tab-wrapper">
        <a href="#" class="nav-tab st-tab nav-tab-active" data-target="#tab1">
            <?php _e('Earnware Log', 'funnel-settings'); ?>          
        </a>
        <a href="#" class="nav-tab st-tab" data-target="#tab2">
            <?php _e('Konnektive Log', 'funnel-settings'); ?>
        </a>
    </h2>
    <div class="tab-content">
        <div class="tab active" id="tab1"> 
            <div class="log-display">
                <div class="log-location">funnel-settings/logs/earnware.log</div>
                <div class="inner-wrap">
                    <div class="log-content">
                        <div class="preserve-style">
                            <?php  if(!empty($earnware_log)){
                                echo trim($earnware_log);
                            }else{
                                echo "Sorry! No records found";
                            } 
                                ?>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab" id="tab2"> 
            <div class="log-display">
                <div class="log-location">funnel-settings/logs/konnektive.log</div>
                <div class="inner-wrap">
                    <div class="log-content">
                        <div class="preserve-style">
                            <?php  if(!empty($konnektive_log)){
                                echo trim($konnektive_log);
                            }else{
                                echo "Sorry! No records found";
                            } 
                                ?>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>