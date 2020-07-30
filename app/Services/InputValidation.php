<?php
class InputValidation
{
    public function validateForm($data){
        $data = addslashes($data);
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}