<?php

/**
  *  Not implemented yet
 */
function civicrm_api3_pcp_create($params) {
    //return civicrm_api3_create_success($personalsArray, $params, 'Entity', 'get', $personalsBAO);
}

/**
 * Gets a Personals data according to ID PCP.
 *
 * @param array $params
 *   Array per getfields documentation.
 *
 * @return array API result array
 *   API result array
 */
function civicrm_api3_pcp_get($params) {
      
      
      $pcp = new CRM_PCP_BAO_PCP();
      global $base_url;
      $pcpDashboard = $pcp->getPcpDashboardInfo($params['contact_id']);
      $pcpDetails =$pcpDashboard[1];
      $pcpInfo= array();
      $num = 0;
      $prms = array('id' => $pcpdata["pcpId"]);
      CRM_Core_DAO::commonRetrieve('CRM_PCP_DAO_PCP', $prms, $pcp_info);
      foreach ($pcpDetails as $key => $data) {
        $pcpInfo[$num]["pcpid"] = $data["pcpId"];
        $pcpInfo[$num]["contribution_page_title"] = $data["pageTitle"];
        $pcpInfo[$num]["pcp_title"] = $data["pcpTitle"];
        $pcpInfo[$num]["pcp_status"] = $data["pcpStatus"];
        $pcpInfo[$num]["pcp_goal_amount"] = $pcp_info["goal_amount"];
        $pcpInfo[$num]["amount_raised"] = $pcp->thermoMeter($data["pcpId"]);
        $pcpInfo[$num]["pcp_link"] = $base_url."/index.php?q=civicrm/pcp/info&reset=1&id=".$data["pcpId"];
        $pcpInfo[$num]["edit_action"] =$base_url."/index.php?q=civicrm/pcp/info&action=update&reset=1&id=".$data["pcpId"]."&component=contribute";
      $pcpInfo[$num]["contribPage"] = $pcp->getPcpPageTitle($data["pcpId"], "contribute");
      $pcpInfo[$num]["eventPage"] = $pcp->getPcpPageTitle($data["pcpId"], "event");
      $pcpInfo[$num]["idscontributions"] = array();

      
      foreach ($pcp->honorRoll($data["pcpId"]) as $contribs => $contrib){
        $contribution_url = $base_url."/index.php?q=civicrm/contact/view/contribution&reset=1&id=".$contribs."&cid=34&action=view&context=search&selectedChild=contribute";

        $pcpInfo[$num]["donators"][] = "<a target='_blank' href='".$contribution_url."'>".$contrib["total_amount"]." ".$contrib["nickname"]."</a>";
      }

      if (empty($pcpInfo[$num]["donators"])) {
        $pcpInfo[$num]["donators"][] = "Contribution Not Availble";
      }

      $pcpInfo[$num]["num_of_contribution"] = count($pcp->honorRoll($data["pcpId"]));
      $num++;


      }
    

            
                  
        return civicrm_api3_create_success($pcpInfo,$params, 'Pcp', 'get');
}

/**
  *  Not implemented yet
 */
function civicrm_api3_pcp_delete($params) {
  /*
  if (CRM_Activity_BAO_Activity::deletepersonals($params)) {
    return civicrm_api3_create_success(1, $params, 'Entity', 'delete');
  }
  else {
    throw new API_Exception('Could not delete Entity');
  }*/
}