jQuery(document).ready(function ($) {
    // Add color picker to all elements with class 'color-picker'
    $('.color-picker').wpColorPicker({
        defaultColor: '#000000'
    });

    $(document).on('click', '.bsc-add-new', function() {
        // Clone the parent div
        var clonedDiv = $(this).closest('.bsc-btn-meta.single-btn').clone();
  
        // Append the cloned div after the original div
        $(this).closest('.bsc-btn-meta.single-btn').after(clonedDiv);
      });
  
    //   Delete Button Click Event
      $(document).on('click', '.delete-btn', function() {
        // Remove the parent div
        $(this).closest('.dynamic-div').remove();
      });
});