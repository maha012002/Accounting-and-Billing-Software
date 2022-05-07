<div class="mail-box">


    <div class="mail-body">

        <form class="form-horizontal" method="get">
            <div class="form-group"><label class="col-sm-2 control-label">{$_L['To']}:</label>

                <div class="col-sm-10"><input type="text" id="toemail" name="toemail" class="form-control" value="{$d['email']}" disabled></div>
            </div>
            <div class="form-group"><label class="col-sm-2 control-label">{$_L['Subject']}:</label>

                <div class="col-sm-10"><input type="text" id="subject" name="subject" class="form-control" value=""></div>
            </div>
        </form>

    </div>

    <div class="mail-text">

        <textarea id="content"  class="form-control sysedit" name="content"></textarea>

        <div class="clearfix"></div>
    </div>
    <div class="mail-body text-right">

        <button type="submit" id="send_email"  class="btn btn-sm btn-primary"><i class="fa fa-paper-plane-o"></i> {$_L['Send']}</button>
    </div>
    <div class="clearfix"></div>



</div>

<table class="table table-bordered table-hover sys_table">
    <thead>
    <tr>


        <th width="80%">{$_L['Subject']}</th>
        <th>{$_L['Date']}</th>

    </tr>
    </thead>
    <tbody>

    {foreach $e as $is}
        <tr>


            <td>{$is['subject']}</td>
            <td>{$is['date']}</td>

        </tr>
    {/foreach}

    </tbody>
</table>