<?php

_auth();
$ui->assign('_application_menu', 'contacts');
$ui->assign('_st', $_L['Search']);
$ui->assign('_title', $_L['Accounts'] . '- ' . $config['CompanyName']);
$action = $routes['1'];
$user = User::_info();
$ui->assign('user', $user);
switch ($action) {
    case 'ps':
        $type = _post('stype');
        $name = _post('txtsearch');
        $d = ORM::for_table('sys_items')
            ->where('type', $type)
            ->where_like('name', "%$name%")
            ->order_by_asc('name')
            ->find_many();
        if ($d) {
            echo '<table class="table table-hover">
        <tbody>';

            foreach ($d as $ds) {
                $price = number_format(
                    $ds['sales_price'],
                    2,
                    $config['dec_point'],
                    $config['thousands_sep']
                );
                echo ' <tr>

                <td class="project-title">
                    <a href="#" class="cedit"  id="t' .
                    $ds['id'] .
                    '">' .
                    $ds['name'] .
                    '</a>
                    <br>
                    <small>' .
                    $ds['item_number'] .
                    '</small>
                </td>
                <td>

                   ' .
                    $price .
                    '

                </td>

                <td class="project-actions">

                    <a href="#" class="btn btn-primary btn-sm cedit" id="e' .
                    $ds['id'] .
                    '"><i class="fa fa-pencil"></i> ' .
                    $_L['Edit'] .
                    ' </a>
                    <a href="#" class="btn btn-danger btn-sm cdelete" id="pid' .
                    $ds['id'] .
                    '"><i class="fa fa-trash"></i> ' .
                    $_L['Delete'] .
                    ' </a>
                </td>
            </tr>';
            }

            echo '
        </tbody>
    </table>';
        } else {
            echo '<h4>Nothing Found</h4>';
        }

        break;

    default:
        echo 'action not defined';
}
