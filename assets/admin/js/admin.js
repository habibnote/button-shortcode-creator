jQuery(document).ready(function ($) {

    // Add color picker to all elements with class 'color-picker'
    $('.color-picker').wpColorPicker({
        defaultColor: '#000000'
    });

    //add new btn
    $(document).on('click', '.bsc-add-new', function() {
        
        let post_id = $(this).attr('post_id');

        //clone a btn
        let clonedDiv = $(this).closest('.single-btn').clone();
  
        // Append the cloned div after the original div
        $(this).closest('.single-btn').after(clonedDiv);

        $.ajax({
            type: 'POST',
            url: BSC.ajax,
            data: {
                action: 'bsc_add_button',
                nonce: BSC.admin_nonce,
                post_id: post_id,
            },
            success: function(response) {
                console.log( response );
            }
        });

      });
  
    //   Delete Button Click Event
      $(document).on('click', '.bsc-delete', function() {
        // Remove the parent div
        $(this).closest('.single-btn').remove();

        let post_id = $(this).attr('post_id');
        let item_no = $(this).attr('item');

        $.ajax({
          type: 'POST',
          url: BSC.ajax,
          data: {
              action: 'bsc_remove_button',
              nonce: BSC.admin_nonce,
              post_id: post_id,
              item_no: item_no,
          },
          success: function(response) {
              console.log( response );
          }
      });
        
    });

    $(document).on('click', '.bsc-btn-setting', function(){
        $(this).closest('.left-area').find('.bsc_setting_metafield').toggle();
    });

});