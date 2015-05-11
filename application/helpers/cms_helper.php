<?php

function e($str) {
	return htmlentities($str);
}


function btn_edit($uri) {
    return anchor($uri, '<i class="glyphicon glyphicon-edit"></i>');
}

function btn_delete($uri) {
    return anchor($uri, '<i class="glyphicon glyphicon-remove"></i>', array('onclick' => "return confirm('Are You sure to delete')"));
}


function has_rights($uri) {
    $CI = &get_instance(); 
    //allowing super admin in all pagess
    //echo get_group_id(); die;
    if (is_logged_in() && get_group_id() == '1'){
        return TRUE;
    }
    else if (is_logged_in() && isset($CI->session->userdata['rights'][$uri]) && $CI->session->userdata['rights'][$uri])
        return true;
    else
        return false;
}

function is_logged_in() {
    $CI = &get_instance();
    return (bool)$CI->user_model->loggedin();
}

// function get_group_name() {
//     $CI = &get_instance();
//     return $CI->session->userdata('group_name');
// }

function get_group_id() {
    $CI = &get_instance();
    return $CI->session->userdata('group_id');
}

function get_user_id() {
    $CI = &get_instance();
    return $CI->session->userdata('id');
}
function get_uri(){
     $CI = &get_instance();
    $uri='';
    if($CI->uri->segment(1)){
        $uri=$CI->uri->segment(1);
        if($CI->uri->segment(2))
         $uri=$CI->uri->segment(1).'/'.$CI->uri->segment(2);        
        return $uri;
    }
}