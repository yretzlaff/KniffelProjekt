<?php

class Template {
    function render_partial($template_path, $data = array())
    {
        // registered passed variables as local variables
        extract($data);

        // load passed template and store contents for usage in layout
        ob_start();
       include(BASEDIR . '/templates/' . $template_path .'.php');
       // include('C:/xampp/htdocs/phpprakt/KniffelProjekt/templates/' . $template_path .'.php');
        return ob_get_clean();
    }

    public static function render($template_path, $data)
    {
        $template = new Template();
        $content_for_layout = $template->render_partial($template_path, $data);

        // load and show layout
        include(BASEDIR . '/templates/layout.php');

    }
}
