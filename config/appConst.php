<?php
return [

    // Define function type
    'arrFuncType' => [
        1 => 'Edit', 
        2 => 'Add', 
        3 => 'Delete',
    ],
    
    // Define database status optimized
    'arrDbOtimized' => [
        1 => 'Chưa tối ưu', 
        2 => 'Đã tối ưu', 
        3 => 'Không cần tối ưu',
    ],
    
    'arrProcessStatus' => [
        1 => 'Chưa làm', 
        2 => 'Không làm nữa', 
        3 => 'Đã làm xong',
        4 => 'Ðang làm',
        5 => 'Rollback lại',
    ],

    'listPosition' => [
        1 => 'Leader',
        2 => 'Dev',
        3 => 'Tester',
        4 => 'Comtor',
        5 => 'QC',
        6 => 'Manager',
    ],
    'listStyle' => [
        'blue' => "blue",
        'red' => 'red',
        'yellow' => 'yellow',
        'green' => 'green',
        'grey' => 'grey',
    ],
    'targetLink' => [
        '_blank' => "blank",
        '_self' => 'self',
        '_parent' => 'parent',
        '_top' => 'top',
        'framename' => 'framename',
    ],
    'statusRelease' => [
        1 => "success",
        2 => 'failed',
    ],
    'statusChecklist' => [
        1 => "reviewed",
        2 => 'not reviewed',
        3 => 'failed'
    ],
];
