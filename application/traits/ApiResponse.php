<?php

trait ApiResponse
{
    /**
     * Response success
     *
     * @param  mixed $data
     * @param  int $code
     *
     * @return JSON
     */
    public function responseSuccess($data, $code = 200, $resultType = 0)
    {
        return $this->json([
            'result_type' => $resultType,
            'code_status' => $code,
            'data'        => $data
        ]);
    }

    /**
     * Response error
     *
     * @param  mixed $message
     * @param  int $code
     * @param  int $resultType
     *
     * @return JSON
     */
    public function responseError($message, $code = 500, $resultType = 5)
    {
        return $this->json([
            'result_type'   => $resultType,
            'code_status'   => $code,
            'error_message' => $message
        ]);
    }

    /**
     * Send json to browser client
     *
     * @param  mixed $data
     *
     * @return JSON
     */
    public function json($data)
    {
        header("Content-Type: application/json; charset=utf-8");

        $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        if ($json === false) {
            // Avoid echo of empty string (which is invalid JSON), and
            // JSONify the error message instead:
            $json = json_encode(array("jsonError", json_last_error_msg()));
            if ($json === false) {
                // This should not happen, but we go all the way now:
                $json = '{"jsonError": "unknown"}';
            }
            // Set HTTP response status code to: 500 - Internal Server Error
            http_response_code(500);
        }
        echo $json;
        exit;
    }
}
