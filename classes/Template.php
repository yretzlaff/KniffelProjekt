<?php

class Template {
    
    //Das Methode bekommt ein Template und benötigte Daten übergeben und zeigt dann das passende Template an
    
    function render_partial($template_path, $data = array())
    {
        extract($data);

        // Laden des Templates und speichern der Inhalte 
        ob_start();
       include(BASEDIR . '/templates/' . $template_path .'.php');
       
        return ob_get_clean();
    }

    public static function render($template_path, $data)
    {
        $template = new Template();
        $content_for_layout = $template->render_partial($template_path, $data);

        // Layout laden und erzeugen
        include(BASEDIR . '/templates/layout.php');

    }
}
