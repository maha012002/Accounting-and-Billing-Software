<div class="row">

        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <a href="{$_url}notes/init/add/" class="btn btn-primary mb-md"><i class="fa fa-plus"></i> Add New Note </a>
                    <br>
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th width="70%">Title</th>
                            <th>Manage</th>
                        </tr>
                        </thead>
                        <tbody>

                        {foreach $notes as $note}

                            <tr>

                                <td>{$note['id']}</td>

                                <td><a href="{$_url}notes/init/edit/{$note['id']}/">{$note['title']}</a> </td>

                                <td>
                                    <a href="{$_url}notes/init/edit/{$note['id']}/" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                    <a href="{$_url}notes/init/delete/{$note['id']}/" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete </a>
                                </td>
                            </tr>

                            {foreachelse}

                            <tr>

                                <td colspan="3">No Notes Found</td>

                            </tr>

                        {/foreach}

                        </tbody>
                    </table>

                </div>
            </div>
        </div>


</div>