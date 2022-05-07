<?php
_auth();
$ui->assign('_application_menu', 'calendar');
$ui->assign('_title', $_L['Calendar'] . '- ' . $config['CompanyName']);
$ui->assign('_st', $_L['Calendar']);
$action = $routes['1'];
$user = User::_info();
$ui->assign('user', $user);

Event::trigger('calendar');

switch ($action) {
    case 'events':
        $mdate = date('Y-m-d');
        $ui->assign('mdate', $mdate);

        $lang_code = Ib_I18n::get_code($config['language']);

        $ui->assign(
            'jsvar',
            '
        _L[\'are_you_sure\'] = \'' .
                $_L['are_you_sure'] .
                '\';
 var ib_lang = \'' .
                $lang_code .
                '\';
ib_rtl = false;
ib_calendar_first_day = 0;
ib_date_format_picker = \'' .
                ib_js_date_format($config['df'], 'picker') .
                '\';
ib_date_format_moment = \'' .
                ib_js_date_format($config['df']) .
                '\';
 '
        );
        $ui->assign(
            'xheader',
            Asset::css([
                'spectrum/spectrum',
                'ibilling/picker/picker',
                'ibilling/clockpicker/clockpicker',
                'modal',
                'fc/fc',
                'fc/fc_ibilling',
            ])
        );
        $ui->assign(
            'xfooter',
            Asset::js([
                'spectrum/spectrum',
                'spectrum/i18n/' . $config['language'],
                'ibilling/picker/picker',
                'ibilling/picker/date',
                'ibilling/picker/time',
                'validator/parsley',
                'validator/i18n/' . Ib_I18n::get_code($config['language']),
                'ibilling/clockpicker/clockpicker',
                'modal',
                'fc/fc',
                'fc/lang/' . $lang_code,
                'ibilling/calendar',
            ])
        );

        $ui->display('calendar.tpl');

        break;

    case 'save_event':
        $data = ib_posted_data();

        $start = date('Y-m-d', strtotime($data['start']));

        if ($data['end'] != '') {
            $end = date('Y-m-d', strtotime($data['end']));
        } else {
            $end = $start;
        }

        if (isset($data['all_day_event'])) {
            $start_date = $start . ' 00:00:00';
            $end_date = $start . ' 23:59:59';
            $allday = 1;
        } else {
            $start_date = $start . ' ' . $data['start_time'] . ':00';
            $end_date = $start . ' ' . $data['end_time'] . ':59';
            $allday = 0;
        }

        if ($data['ib_act'] == 'edit') {
            $event_id = $data['event_id'];

            $calendar = Model::factory('Models_Calendar')->find_one($event_id);

            if (!$calendar) {
                i_close('Event not Found.');
            }
        } else {
            $calendar = Model::factory('Models_Calendar')->create();
        }

        $calendar->title = $data['title'];
        $calendar->start = $start_date;
        $calendar->end = $end_date;
        $calendar->description = $data['description'];
        $calendar->color = $data['color'];
        $calendar->allday = $allday;
        $calendar->save();

        echo $calendar->id();

        break;

    case 'data':
        header('Content-Type: application/json');

        $start = _get('start') . ' 00:00:00';
        $end = _get('end') . ' 23:59:00';

        $calendar = Model::factory('Models_Calendar')
            ->where_gte('start', $start)
            ->where_lte('end', $end)
            ->select('title')
            ->select('start')
            ->select('end')
            ->select('description', '_tooltip')
            ->select('id', 'eventid')
            ->select('color')
            ->find_array();

        echo json_encode($calendar);
        //  echo json_encode($data);

        break;

    case 'js_date':
        $date = _post('date');

        echo date('Y-m-d', strtotime(current(explode("(", $date))));

        break;

    case 'view_event':
        $id = route(2);

        $calendar = Model::factory('Models_Calendar')->find_one($id);

        if ($calendar) {
            header('Content-Type: application/json');

            $data = [];
            $data['id'] = $calendar->id;
            $data['title'] = $calendar->title;
            $data['start_date'] = date('Y-m-d', strtotime($calendar->start));
            $data['start_time'] = date('H:i', strtotime($calendar->start));
            $data['end_date'] = date('Y-m-d', strtotime($calendar->end));
            $data['end_time'] = date('H:i', strtotime($calendar->end));
            $data['color'] = $calendar->color;
            $data['description'] = $calendar->description;
            if ($calendar->allday == 1) {
                $data['allDay'] = true;
            } else {
                $data['allDay'] = false;
            }

            echo json_encode($data);
        }

        break;

    default:
        echo 'action not defined';
}
