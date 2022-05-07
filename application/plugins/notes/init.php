<?php
 
_auth();
 
$ui->assign('_application_menu', 'notes');
$ui->assign('_title', 'Notes'.' - '. $config['CompanyName']);
$ui->assign('_st', 'Notes');
$action = $routes['2'];
$user = User::_info();
$ui->assign('user', $user);
 
 
switch ($action) {
    case 'list':

        // Find all notes
        $notes = ORM::for_table('app_notes')->find_many();
        // Assign notes template variable
        $ui->assign('notes',$notes);

        // Include list.tpl file from views/list.tpl
        $ui->assign('_include','list');

        // Wrap the Contents & Display The Page
        $ui->display('wrapper.tpl');
 
        break;
    
    case 'add':

        // Include list.tpl file from views/add.tpl
        $ui->assign('_include','add');

        // Wrap the Contents & Display The Page
        $ui->display('wrapper.tpl');
        
        break;

    case 'add_post':

       // Grab the data from Previous Page

       $title = _post('title');
       $contents = _post('contents');

       if($title == ''){
           r2(U.'notes/init/add/','e','Note Title is Required');
       }

       // We want to store data to app_notes table
       $note = ORM::for_table('app_notes')->create();

       // Set data for title column
       $note->title = $title;

       // Set data for contents column
       $note->contents = $contents;

       // Finally Store the data
       $note->save();

       // All done, Let's redirect the user to list notes

        r2(U.'notes/init/list/','s','Note Added Successfully');

        break;
    
    
    case 'edit':

        // Get note id from the URL

        $id = $routes['3'];

        // Find note by id

        $note = ORM::for_table('app_notes')->find_one($id);

        // Assign Note for views

        $ui->assign('note',$note);

        // Include edit.tpl file from views/edit.tpl
        $ui->assign('_include','edit');

        // Wrap the Contents & Display The Page
        $ui->display('wrapper.tpl');
        
        break;


    case 'edit_post':

        // Grab the data from Previous Page

        $id = _post('id');

        // Find the note by id

        $note = ORM::for_table('app_notes')->find_one($id);

        if(!$note){
            r2(U.'notes/init/list/','e','Note Not Found');
        }

        $title = _post('title');
        $contents = _post('contents');

        if($title == ''){
            r2(U.'notes/init/edit/'.$id.'/','e','Note Title is Required');
        }

        // Set New data for note title
        $note->title = $title;

        // Set data for note contents
        $note->contents = $contents;

        // Finally Store the data
        $note->save();

        // All done, Let's redirect the user and show that Note Updated

        r2(U.'notes/init/edit/'.$id.'/','s','Note Edited Successfully');

        break;
    
    
    case 'delete':

        // Get note id from the URL

        $id = $routes['3'];

        // Find note by id

        $note = ORM::for_table('app_notes')->find_one($id);

        // Delete Note

        if($note){
            $note->delete();
        }

        // Done, Let's Redirect the User to the List Notes

        r2(U.'notes/init/list/','s','Note Deleted Successfully');
        
        break;
 
 
    default:
        echo 'action not defined';
}
 