{extends file="$tpl_admin_layout"}

{block name="content"}
    <div class="row">
        <div class="col-md-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{$_L['Add New User']}</h5>

                </div>
                <div class="ibox-content">

                    <form role="form" name="accadd" method="post" action="{$_url}settings/users-post">
                        <div class="form-group">
                            <label for="username">{$_L['Username']}</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="fullname">{$_L['Full Name']}</label>
                            <input type="text" class="form-control" id="fullname" name="fullname">
                        </div>
                        <div class="form-group">

                            <label>{$_L['User']} {$_L['Type']}</label>

                            <div class="i-checks"><label> <input type="radio" value="Admin" name="user_type" checked> <i></i> {$_L['Full Administrator']} </label></div>

                            {foreach $roles as $role}
                                <div class="i-checks"><label> <input type="radio" value="{$role['id']}" name="user_type"> <i></i> {$role['rname']} </label></div>
                            {/foreach}



                        </div>




                        <div class="form-group">
                            <label for="password">{$_L['Password']}</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <div class="form-group">
                            <label for="cpassword">{$_L['Confirm Password']}</label>
                            <input type="password" class="form-control" id="cpassword" name="cpassword">
                        </div>


                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> {$_L['Submit']}</button>
                        {$_L['Or']} <a href="{$_url}settings/users">{$_L['Cancel']}</a>
                    </form>

                </div>
            </div>



        </div>



    </div>
{/block}
