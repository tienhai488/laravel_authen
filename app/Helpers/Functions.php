<?php
function isRole($roleArr,$nameModule,$nameRole='view'){
    if(!empty($roleArr) && !empty($roleArr[$nameModule])){
        $roleModuleArr = $roleArr[$nameModule];
        if(!empty($roleModuleArr)&&in_array($nameRole,$roleModuleArr)){
            return true;
        }
    }

    return false;
}