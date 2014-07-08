
  <div class="widget">
        <div class="navbar">
            <div class="navbar-inner">
                <h6>Create new Contribution</h6>
            </div>
        </div>
        <form id="wizard1" method="post" action="#" class="form-horizontal row-fluid well ui-formwizard">
            <fieldset class="step" id="step1">
                <div class="step-title">
                    <i>1</i>
                    <h5>Contribution Details</h5>
                    <span>These are the general details for the new contribution</span>
                </div>
                <div>
                    <div class="control-group">
                        <div class="control-label">
                            Contribution Name
                        </div>
                        <div class="controls">
                            <input type="text" name="contribution_name" class="input-large">
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="control-label">
                            Contribution Description
                        </div>
                        <div class="controls">
                            <input type="text" name="contribution_desc" class="input-large">
                        </div>
                    </div>

                </div>
            </fieldset>
            <fieldset id="step2" class="step">
                <div class="step-title">
                    <i>2</i>
                    <h5>Membership Requirements</h5>
                    <span>This section contains settings for membership requirements for this contribution</span>
                </div>
                <div class="control-group">
                    <label class="control-label">Generate rules here</label>
                    <div class="controls">
                        <select name="membership_rule">
                    <?php
                    //code to pull the rules from the controller
                    $result=Modules::run('rules/GetRules','membership'); //returns a ruleSet object
                    //$rules=$result->getRuleSet();
                    //var_dump($result);
                    if(!is_null($result))
                    {
                        $rule=$result->getRuleSet();
                        if(!is_null($rule))
                        {
                            //print_r($rule);

                            foreach($rule as $item){
                                echo '<option value="'.$item->getTitle().'">'.$item->getDescription().'</option>';
                                if($item->getRequireSettings()==1)
                                {
                                    echo '<input type="text" name="settings" class="input-large input-block-level"/>';
                                }
                            }

                        }
                    }

                    ?>
                        </select>
                    </div>
                </div>

            </fieldset>
            <fieldset id="step3" class="step">
                <div class="step-title">
                    <i>3</i>
                    <h5>Groups Requirement</h5>
                    <span>These settings help you choose if the cooperators would be expected to have certain group or loan requirement</span>
                </div>
                <div class="control-group">
                    <label class="control-label">Generate rules here</label>
                    <div class="controls"><input type="text" class="span12" /></div>
                </div>

            </fieldset>
            <div class="form-actions align-right">
                <input class="btn" id="back-1" value="Back" type="reset" />
                <input type="submit" class="btn btn-danger" id="next-1" value="Next">
            </div>
        </form>
      </div>
