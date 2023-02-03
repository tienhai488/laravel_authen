<?php
function isRole($roleArr,$nameModule,$nameRole){
    if(!empty($roleArr) && !empty($roleArr[$nameModule])){
        $roleModuleArr = $roleArr[$nameModule];
        if(!empty($roleModuleArr)&&in_array($nameRole,$roleModuleArr)){
            return true;
        }
    }

    return false;
}