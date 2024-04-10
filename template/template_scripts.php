<?php

echo '

    <script type="text/javascript">
        FontAwesomeConfig = { searchPseudoElements: true };
    </script>

    <script type="text/javascript" src="' . URL . '/assets/js/jquery-3.2.1.min.js?v=157785080"></script>
    <script type="text/javascript" src="' . URL . '/assets/js/bootstrap.min.js?v=157785080"></script>
    <script type="text/javascript" src="' . URL . '/assets/js/bootstrap.bundle.min.js?v=157785080"></script>
    <script type="text/javascript" src="' . URL . '/assets/js/pace.min.js?v=157785080"></script>
    <script type="text/javascript" src="' . URL . '/assets/js/fontawesome-all.js?v=157785080" defer></script>
    <script type="text/javascript" src="' . URL . '/assets/js/jquery.nicescroll.js?v=157785080"></script>
    <script type="text/javascript" src="' . URL . '/assets/js/tilt.jquery.min.js?v=157785080"></script>
    <script type="text/javascript" src="' . URL . '/assets/ckeditor/ckeditor.js?v=157785080"></script>

    <script type="text/javascript">
    
        $(document).ready(function () {
            $(".pl-body-scroll, .pl-sidebar").niceScroll({ autohidemode: true });
            
            $(\'#showmore\').on(\'click\', function () {
                $(\'.players-tab\').toggleClass(\'showall\');
            });
            
            $(\'#showmoresettings\').on(\'click\', function () {
                $(\'.settingsshow\').toggleClass(\'showallsettings\');
            });
            
        });
        
        function getval(sel) {
            var key = sel.value;
            $.get( 
                "lgsl_files/lgsl_type_loader",
                { type: key },
                function(data) {
                 $("#form_mod").html(data);
                }
            );
        }
        
        $(\'.js-tilt\').tilt({
            scale: 1.2
        });
        
        CKEDITOR.replace( \'.ckeditor\' );
        
    </script>';