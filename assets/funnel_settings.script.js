jQuery(document).ready(function () {
    jQuery(document).on('change', 'input[name="selected_tab"]', function () {
        jQuery('.st-funnel-wrap .header, .st-funnel-wrap .data-sec').removeClass('active');
        jQuery(this).parents('.header').addClass('active');
        const target = jQuery(this).val();
        jQuery(target).addClass('active');
    });
    jQuery(document).on('click', '.st-funnel-wrap .st-tab', function () {
        jQuery('.st-tab').removeClass('nav-tab-active');
        jQuery(this).addClass('nav-tab-active');
        jQuery(this).blur();

        let target = jQuery(this).data('target');
        jQuery('.st-funnel-wrap .tab').removeClass('active');
        jQuery(target).addClass('active');
    });

    upsellOrder.init();

});
var upsellOrder = {

    init: function () {
        const _this = this;
        jQuery('.draggable-list').sortable({
            cursor: 'move',
            items: '.drag-item',
            opacity: 0.6,
            axis: 'y'
        });
        jQuery('#new-upsell').on('click', function () {
            let link_name = jQuery('[name="funnel_step-type"] option:selected').val();
            let target = jQuery(this).attr('data-target');
            if (jQuery(this).val() === 'Update') {
                if (link_name.length > 0) {
                    _this.update(target, link_name);
                }
            } else {
                if (link_name.length > 0) {
                    _this.addNew(link_name);
                }
            }
            jQuery('[name="new_upsell_link"]').val('');
        });
        jQuery(document).on('click', '.upsell-delete', function () {
            _this.remove(jQuery(this).parents('.drag-item'));           
        });
        jQuery(document).on('click', '.upsell-edit', function () {
            _this.edit(jQuery(this).parents('.drag-item'));
        });
        jQuery(document).on('change', '#page_id', function(){
            _this.saveSelection(jQuery(this).parents('.drag-item'));
        })
        jQuery(document).on('blur', '#page_id', function(){
            jQuery(this).parents('.select-wrap').addClass('disabled');
        });
    },
    listCount: function () {
        return jQuery('.draggable-list .drag-item').length;
    },
    addNew: function (link) {
        let id = 'upl-' + this.listCount();
        console.log(link);
        if(link){
            let class_added_select = st_page_drop_down.replace('%s%', link);
            if (this.listCount() <= 0) {
                jQuery('.draggable-list').addClass('has-items');
            }
            let template = `<li class="drag-item `+link+`" id="` + escape(id) + `">
                                <span class="dashicons dashicons-sort"></span>
                                <div class="select-wrap">
                                `+ class_added_select + `
                                </div>
                                <input type="hidden" name="funnel_steps[]" />
                                <ul class="action-list">
                                    <li class="upsell-edit">Edit</li>
                                    <li class="upsell-delete">Delete</li>
                                </ul>
                            </li>`;
            jQuery('.draggable-list').append(template);
            jQuery('#'+id).find('select').focus();
        }
    },
    remove: function (elem) {
        jQuery(elem).remove();
        if (this.listCount() <= 0) {
            jQuery('.draggable-list').removeClass('has-items');
        }
    },
    update: function (target, link_name) {
        jQuery('#' + target).find('.upsell-name').text(escape(link_name));
        jQuery('#' + target).find('input').val(escape(link_name));
        jQuery('#new-upsell').val('Add New');
    },
    edit: function (elem) {
       jQuery(elem).find('.select-wrap').removeClass('disabled');
       jQuery(elem).find('select').focus();
    },
    saveSelection : function(elem){
        let step = {};
        if(jQuery(elem).find('select').hasClass('upsell')){
            step.type =  'upsell';
        }else if(jQuery(elem).find('select').hasClass('downsell')){
            step.type = 'downsell';
        }
        step.page = jQuery(elem).find('select option:selected').val();

        jQuery(elem).find("input[type='hidden']").val(JSON.stringify(step));


    }
}