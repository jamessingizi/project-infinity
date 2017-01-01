<?php
/**
 * Created by PhpStorm.
 * User: James Singizi
 * Date: 17/11/2016
 * Time: 21:30
 */

class Validation {

    public static function cell($cellNumber){

        if (Validation::v_cell_with_code($cellNumber)||Validation::v_cell_without_code($cellNumber)) {

            return true;

        }else{

            return false;

        }

    }

    /**
     * validates a cell number with an intl' code
     * @param $cellNumber
     * @return bool
     */
    public static function v_cell_with_code($cellNumber){

        return (preg_match("/^[+][1-9]{0,1}[1-9]{1,2}[0-9]{9}$/", $cellNumber)==1)?true:false;

    }

    /**
     *validates a cell number without an intl' code
     * @param string $cellNumber
     * @return boolean
     */
    public static function v_cell_without_code($cellNumber){

        return (preg_match("/^[0-9]{10}$/", $cellNumber)==1)?true:false;

    }

    public static function v_email($email) {
        return  filter_var($email, FILTER_VALIDATE_EMAIL)?true:false;
    }

    /**
     * @param $password
     * @return boolean validates unencrypted password
     */
    public static function v_password($password) {
        return (strlen($password)>7)?true:false;
    }

    public static function v_name($name){
        if(strlen($name)<2||is_numeric($name)){
            return false;
        }else{
            return true;
        }
    }

    public static function jpeg($extension,$type){


        if(($extension == 'jpeg' || $extension == 'jpg' || $extension == 'JPG'|| $extension == 'JPEG') && ($type =='image/jpeg' || $type =='IMAGE/JPEG')){

            return true;
        }else{
            return  false;

        }
    }

    public static function png($extension,$type){


        if(($extension == 'png' || $extension == 'PNG') && ($type =='image/png' || $type =='IMAGE/PNG')){

            return true;
        }else{
            return  false;

        }
    }

    public static function image($extension,$type) {
        if (Validation::png($extension, $type)||Validation::jpeg($extension, $type)) {
            return true;
        }else{

            return false;

        }
    }

}