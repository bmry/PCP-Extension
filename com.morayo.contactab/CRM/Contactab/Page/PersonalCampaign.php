<?php

require_once 'CRM/Core/Page.php';

class CRM_Contactab_Page_PersonalCampaign extends CRM_Core_Page {
  public function run() {
    $contact_id=CRM_Utils_Request::retrieve('contact_id', 'Integer');

    print_r($contact_id);

    CRM_Core_Resources::singleton()->addScriptUrl('https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js',10, 'html-header');
    CRM_Core_Resources::singleton()->addScriptFile('com.morayo.contactab', 'js/personal_campaign.js');
    CRM_Core_Resources::singleton()->addVars('Pcp', array('contact_id' => $contact_id));

    // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    CRM_Utils_System::setTitle(ts('Personal Campaign Pages Extension'));

    parent::run();
  }
}
