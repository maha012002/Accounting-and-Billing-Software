<div class="row">

    <div class="col-md-12">

        <div class="panel panel-default">
            <div class="panel-body">

                <form class="form-horizontal" action="{$_url}notes/init/edit_post/" method="post">

                    <div class="form-group"><label class="col-lg-2 control-label">Title </label>

                        <div class="col-lg-10"><input type="text" name="title" class="form-control" value="{$note['title']}">

                        </div>
                    </div>


                    <div class="form-group"><label class="col-lg-2 control-label">Contents </label>

                        <div class="col-lg-10">

                            <textarea class="form-control" name="contents" rows="15">{$note['contents']}</textarea>

                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">

                            <input type="hidden" name="id" value="{$note['id']}">

                            <button class="btn btn-primary" type="submit" id="submit"><i
                                        class="fa fa-check"></i> {$_L['Submit']}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


</div>