<?php
_auth();
$ui->assign('_application_menu', 'documents');
$ui->assign('_title', $_L['Documents'] . '- ' . $config['CompanyName']);
$ui->assign('_st', $_L['Documents']);
$action = route(1);

if ($action == '') {
    $action = 'list';
}
$user = User::_info();
$ui->assign('user', $user);

Event::trigger('documents');

switch ($action) {
    case 'list':
        $ui->assign(
            'jsvar',
            '
_L[\'are_you_sure\'] = \'' .
                $_L['are_you_sure'] .
                '\';
 '
        );

        $upload_max_size = ini_get('upload_max_filesize');
        $post_max_size = ini_get('post_max_size');

        $ui->assign('upload_max_size', $upload_max_size);
        $ui->assign('post_max_size', $post_max_size);

        $ui->assign(
            'xheader',
            Asset::css([
                'modal',
                'dropzone/dropzone',
                'footable/css/footable.core.min',
            ])
        );
        $ui->assign(
            'xfooter',
            Asset::js([
                'modal',
                'dropzone/dropzone',
                'footable/js/footable.all.min',
                'js/documents',
            ])
        );

        $xjq =
            '

var dl_token;

    $(".c_link").click(function (e) {
        e.preventDefault();

dl_token = $(this).attr("data-token")
        bootbox.prompt({
            title: "' .
            $_L['Secure Download Link'] .
            '",
            value: "' .
            U .
            'client/dl/" + dl_token,
            buttons: {
        \'cancel\': {
            label: \'' .
            $_L['Cancel'] .
            '\'
        },
        \'confirm\': {
            label: \'' .
            $_L['OK'] .
            '\'
        }
    },
            callback: function(result) {
                if (result === null) {

                } else {
                   // alert(result);
                     $.post( "' .
            U .
            'settings/networth_goal/", { goal: result })
        .done(function( data ) {
            location.reload();
        });
                }
            }
        });

    });

 ';

        $ui->assign('xjq', $xjq);

        $d = ORM::for_table('sys_documents')->find_array();
        $ui->assign('d', $d);
        $ui->display('documents.tpl');

        break;

    case 'upload':
        if ($_app_stage == 'Demo') {
            exit();
        }

        $uploader = new Uploader();
        $uploader->setDir('application/storage/docs/');
        $uploader->sameName(false);
        // $uploader->setExtensions(array('zip'));  //allowed extensions list//
        $uploader->allowAllFormats(); //allowed extensions list//
        if ($uploader->uploadFile('file')) {
            //txtFile is the filebrowse element name //
            $uploaded = $uploader->getUploadName(); //get uploaded file name, renames on upload//

            $file = $uploaded;
            $msg = $_L['Uploaded Successfully'];
            $success = 'Yes';
        } else {
            //upload failed
            $file = '';
            $msg = $uploader->getMessage();
            $success = 'No';
        }

        $a = [
            'success' => $success,
            'msg' => $msg,
            'file' => $file,
        ];

        header('Content-Type: application/json');

        echo json_encode($a);

        break;

    case 'post':
        $title = _post('title');
        $file_link = _post('file_link');

        $ext = pathinfo($file_link, PATHINFO_EXTENSION);

        $token = Ib_Str::random_string(30);

        if ($title == '' || $file_link == '') {
            ib_die($_L['All Fields are Required']);
        }

        $d = ORM::for_table('sys_documents')->create();
        $d->title = $title;
        $d->file_path = $file_link;
        $d->file_dl_token = $token;
        $d->file_mime_type = $ext;
        $d->created_at = date('Y-m-d H:i:s');
        $d->save();

        echo $d->id();

        break;

    case 'view':
        $id = route(2);

        $doc = ORM::for_table('sys_documents')->find_one($id);

        if ($doc) {
            $ext = pathinfo($doc->file_path, PATHINFO_EXTENSION);

            $ui->assign('ext', $ext);

            $ui->assign('doc', $doc);

            $ui->display('documents_view.tpl');
        } else {
            i_close('Not Found');
        }

        break;

    case 'download':
        $id = route(2);

        $doc = ORM::for_table('sys_documents')->find_one($id);

        if ($doc) {
            $file = 'application/storage/docs/' . $doc->file_path;

            $c_type = mime_content_type($file);

            if (file_exists($file)) {
                $basename = basename($file);
                $mime = mime_content_type($file);
                $size = filesize($file);
                $fp = fopen($file, "rb");
                if (!($mime && $size && $fp)) {
                    return;
                }

                header("Content-type: " . $mime);
                header("Content-Length: " . $size);
                header(
                    "Content-Disposition: attachment; filename=" . $basename
                );
                header('Content-Transfer-Encoding: binary');
                header(
                    'Cache-Control: must-revalidate, post-check=0, pre-check=0'
                );
                fpassthru($fp);
            }
        } else {
            i_close('Not Found');
        }

        break;

    default:
        echo 'action not defined';
}
