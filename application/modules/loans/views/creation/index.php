<?php
/**
 * Created by PhpStorm.
 * User: Samuel
 * Date: 8/3/14
 * Time: 12:16 PM
 *
 * Loan Creation View
 */
?>
<!-- Default wizard -->
<div class="widget">
    <div class="navbar">
        <div class="navbar-inner">
            <h6>Create New Loan Scheme</h6>
            <!--div class="nav pull-right">
                <a href="#" class="dropdown-toggle navbar-icon" data-toggle="dropdown"><i class="icon-cog"></i></a>
                <ul class="dropdown-menu pull-right">
                    <li><a href="#"><i class="icon-plus"></i>Add new option</a></li>
                    <li><a href="#"><i class="icon-reorder"></i>View statement</a></li>
                    <li><a href="#"><i class="icon-cogs"></i>Parameters</a></li>
                </ul>
            </div-->
        </div>
    </div>
    <form id="wizard1" method="post" action="#" class="form-horizontal row-fluid well">
        <fieldset class="step" id="step1">
            <div class="step-title">
                <i>1</i>
                <h5>Basic Information</h5>
                <span>Please specify the requested information below</span>
            </div>
            <div>
                <div class="control-group">
                    <label class="control-label">Loan Name:</label>
                    <div class="controls"><input type="text" name="loan_name" class="span12" /></div>
                </div>
                <div class="control-group">
                    <label class="control-label">Description:</label>
                    <div class="controls"><input type="text" name="loan_desc" class="span12" /></div>
                </div>

            </div>
        </fieldset>
        <fieldset id="step2" class="step">
            <div class="step-title">
                <i>2</i>
                <h5>Membership Requirements</h5>
                <span>Please specify the membership requirement below</span>
            </div>
            <div>

               <?/*php $result=Modules::run('rules/GetRules','membership'); //returns a ruleSet object
               if(!is_null($result))
               {
                   $rule=$result->getRuleSet();
                   if(!is_null($rule))
                   {
                       //print_r($rule);
                       echo '<select name="membership_rule">';
                       foreach($rule as $item){
                           echo '<option value="'.$item->getTitle().'">'.$item->getDescription().'</option>';
                           if($item->getRequireSettings()==1)
                           {
                               echo '<input type="text" name="settings" class="input-large"/>';
                           }
                       }
                       echo '</select>';

                   }
               }
*/?>
            </div>

        </fieldset>
        <div class="form-actions align-right">
            <input class="btn" id="back-1" value="Back" type="reset" />
            <input type="submit" class="btn btn-danger" id="next-1" value="Next">
        </div>
    </form>
</div>