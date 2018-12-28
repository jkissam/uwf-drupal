// drupal-specific javascript

jQuery(document).ready(function($){
    
    // make entire legend of collapsible fieldsets clickable
    $('fieldset.collapsible legend').click(function(event){
        var fieldset = $(this).closest('fieldset').get(0);
        if (!fieldset.animating) {
            fieldset.animating = true;
            Drupal.toggleFieldset(fieldset);
        }
    });
    
    $('fieldset.collapsible').bind('collapsed',function(){
        setTimeout(function(){
            uwfUtil.fixFooter();
        }, 200);
    })
    
});
