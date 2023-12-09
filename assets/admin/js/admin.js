jQuery(document).ready(function ($) {

    // Add color picker to all elements with class 'color-picker'
    $('.color-picker').wpColorPicker({
        defaultColor: '#000000'
    });

    //add new btn
    $(document).on('click', '.bsc-add-new', function() {
        
        let post_id = $(this).attr('post_id');

        //clone a btn
        let clonedDiv = $(this).closest('.bsc-btn-meta.single-btn').clone();
  
        // Append the cloned div after the original div
        $(this).closest('.bsc-btn-meta.single-btn').after(clonedDiv);

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
      $(document).on('click', '.delete-btn', function() {
        // Remove the parent div
        $(this).closest('.dynamic-div').remove();
      });
});