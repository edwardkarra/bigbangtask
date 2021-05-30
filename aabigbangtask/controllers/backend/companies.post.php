<?php
use Tygh\Registry;


include "app/addons/aabigbangtask/agreement_controller.php";
Registry::get('view')->assign('is_add',false);


// if user is adding a vendor
if($mode === 'add'){
    //assign variable to tpl to control showing the upload form
    Registry::get('view')->assign('is_add',true);

    //if vendor is created ( form submitted )
    if(isset($_POST['company_data'])){
        $company_name = $_POST['company_data']['company'];
        upload($company_name);
    }
}
//vendor details nav tabs
$tabsArr = Registry::get('navigation.tabs');

//if user is viewing vendor details
if($mode === 'update') {

    if (!isset($tabsArr['files'])) {

        // add File tab to Nav Tabs
        $tabsArr['files'] = array(
            'title' => __('files'),
            'js' => true
        );
        Registry::set('navigation.tabs', $tabsArr);
    }

    $company_id = $_REQUEST['company_id'];
    $company_name = fn_get_company_name($company_id);

    // if agreement_download button clicked
    if(isset($_POST['agreement_call'])){
        download($company_name);
    }
}

?>