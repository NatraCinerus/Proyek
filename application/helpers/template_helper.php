<?php if ( ! function_exists('element')) { 
    function show($view, $data=array(), $template='default') { 
        $ci = &get_instance(); 
        $data['view'] = $view; 
        $ci->load->view('template/'.$template, $data); 
    } 
} 