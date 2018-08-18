<?php

namespace Eli2n\XmlResponse;

use Eli2n\Array2xml\Array2xml;
use Illuminate\Support\Facades\Response;

class XmlResponse
{
    /**
     * Options
     *
     * @var array
     */
    private $options = [];

    private function headers()
    {
        return [
            'content-type' => 'application/xml',
        ];
    }

    public function __construct()
    {
        $this->options = config('xml') ?: [];
    }

    /**
     * @param array $data
     * @param int $status_code
     * @param array $options
     *
     * @return \Illuminate\Http\Response
     * @throws \Eli2n\Array2xml\Exceptions\Array2xmlException
     */
    public function getResponse($data = [], $status_code = 200, Array $options = [])
    {
        if (is_array($data)) {
            $content = (new Array2xml($this->options))->setAttributes($options)->setData($data)->get();
        } else if (is_object($data) and $data instanceof Array2xml) {
            $content = $data->setAttributes($this->options)->setAttributes($options)->get();
        } else {
            $content = $data;
        }

        return Response::make($content, $status_code, $this->headers());
    }
}
