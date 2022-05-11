<?php

namespace Tenant\Support\Exceptions;

use Exception;

class NotFoundException extends Exception
{
    /**
     * @param string|null     $message  The internal exception message
     * @param int             $code     The internal exception code
     */
    public function __construct(?string $message = '', int $code = 404)
    {
        if (empty($message)) {

            $message = 'Data not found';
        }

        parent::__construct($message, $code);
    }

    /**
     * Report the exception.
     *
     * @return bool|null
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {

    }
}
