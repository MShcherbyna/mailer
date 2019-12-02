<?php
namespace App\Src;

class Validation
{
    public function validate_email($field = '')
    {
        if ($field == "") return "Email address not entered";
        else if (
            !((strpos($field, ".") > 0) && (strpos($field, "@") > 0)) ||
            preg_match("/[^a-zA-Z0-9.@_-]/", $field)
        )
            return "Email format is not valid, [" . $field . "]";
        return true;
    }

    public function validate_name($field = '')
    {
        if ($field == "") return "Name is empty";
        else if (strlen($field) < 1)
            return "Username must be at least 5 characters, [" . $field . "]";
        else if (preg_match("/[^a-zA-Z0-9_-]/", $field))
            return "Only letters, numbers, - and _ are allowed in the username, [" . $field . "]";
        return true;
    }
}
