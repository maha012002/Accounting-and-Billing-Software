<?php
class Ib_Animate
{
    public $css_class_names = [
        [
            'group' => 'Attention Seekers',
            'names' =>
                'bounce,flash,pulse,rubberBand,shake,swing,tada,wobble,jello',
        ],
        [
            'group' => 'Bouncing Entrances',
            'names' =>
                'bounceIn,bounceInDown,bounceInLeft,bounceInRight,bounceInUp',
        ],

        [
            'group' => 'Fading Entrances',
            'names' =>
                'fadeIn,fadeInDown,fadeInDownBig,fadeInLeft,fadeInLeftBig,fadeInRight,fadeInRightBig,fadeInUp,fadeInUpBig',
        ],

        [
            'group' => 'Flippers',
            'names' => 'flip,flipInX,flipInYY',
        ],
        [
            'group' => 'Lightspeed',
            'names' => 'lightSpeedIn',
        ],
        [
            'group' => 'Rotating Entrances',
            'names' =>
                'rotateIn,rotateInDownLeft,rotateInDownRight,rotateInUpLeft,rotateInUpRight',
        ],

        [
            'group' => 'Sliding Entrances',
            'names' => 'slideInUp,slideInDown,slideInLeft,slideInRight',
        ],

        [
            'group' => 'Zoom Entrances',
            'names' => 'zoomIn,zoomInDown,zoomInLeft,zoomInRight,zoomInUp',
        ],

        [
            'group' => 'Specials',
            'names' => 'rollIn',
        ],
    ];

    public function options($selected)
    {
        $cs = $this->css_class_names;

        $html = '';

        foreach ($cs as $c) {
            $group = $c['group'];

            $names = explode(',', $c['names']);

            $opt = '';

            foreach ($names as $name) {
                $s = '';

                if ('animated ' . $name == $selected) {
                    $s = ' selected';
                }

                $opt .=
                    '<option value="animated ' .
                    $name .
                    '"' .
                    $s .
                    '>' .
                    $name .
                    '</option>';
            }

            $html .=
                '<optgroup label="' .
                $group .
                '">
            ' .
                $opt .
                '</optgroup>';
        }

        return $html;
    }
}
