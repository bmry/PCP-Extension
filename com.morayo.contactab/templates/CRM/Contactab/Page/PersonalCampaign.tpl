{literal}
<div  ng-app="PersonalCampaign" ng-controller="ContactCtrl">
<table id="options" class="display">
  <thead>
    <tr>
    <th>Personal Campaign Page Title</th>
    <th>Contribution Page Title</th>
    <th>Number of Contribution</th>
    <th>Amount Raised</th>
    <th>Target Amount</th>
    <th>Status</th>
    <th>Action</th>
    
    </tr>
  </thead>
  <tbody>

  
  <tr ng-repeat="x in campaignlist">
    <td>{{x.pcp_title}}</td>
    <td>{{x.contribution_page_title}}</a></td>
    <td ng-click="shows(x.pcpid)"  title="Click to get contributions list"  style="cursor: pointer; "> <a href="javascript:;"> {{x.num_of_contribution}}</a></td>
    <td>{{x.amount_raised}}</td>
    <td>{{x.pcp_goal_amount}}</td>
    <td>{{x.pcp_status}}</td>
    <td><a href="{{x.edit_action}}">Edit</a>

      <div class="hides" id="c{{x.pcpid}}" style="display: none; background: white;top: 50%;left: 50%;height: auto;width: 243px;position: fixed;border-style: solid;">
                    <span style="display: block;text-align: right;padding-right: 5px;cursor: pointer;" ng-click="hides()" title="Click to close this window"> x </span>
                    <div style="background: #f6f6f2;">Contributions for: {{x.pcp_title}}</div>
                    <ul ng-repeat="x2 in x.donators" ng-cloak>
                        <li ng-bind-html="convertHtml(x2)"></li>
                    </ul>
                </div>

    </td>
  </tr>
  
  </tbody>
</table>


</div>
{/literal}
