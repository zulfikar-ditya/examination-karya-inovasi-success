<?php

namespace App\Http\Helpers;

trait ControllerHelpers
{
    public function get_set_message_crud(bool $success = true, $method = 'create', $message = null, $exception_message = null)
    {
        if ($success) {
            $final_message = 'Success ';
        } else {
            $final_message = 'Failed ';
        }

        if ($method == 'create') {
            $final_message .= 'insert new data. ';
        } else if ($method == 'edit') {
            $final_message .= 'update data. ';
        } else if ($method == 'delete') {
            $final_message .= 'delete data, ';
        }

        if ($message != null) {
            $final_message .= $message.' ';
        }

        if ($exception_message != null) {
            $final_message .= $exception_message;
        }
        return ['message' => $final_message, 'success' => $success];
    }
}
