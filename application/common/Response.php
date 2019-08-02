<?php

class Response
{
    const HTTP_OK = 200;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_NOT_FOUND = 404;
    const INTERNAL_SERVER_ERROR = 500;

    const RESULT_TYPE_SUCCESS = 0;
    const RESULT_TYPE_CLIENT_ERROR = 5;
    const RESULT_TYPE_SERVER_ERROR = 9;
}
