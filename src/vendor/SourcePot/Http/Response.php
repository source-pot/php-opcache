<?php

namespace SourcePot\Http;

class Response {
    private array $headers = [];

    public function setHeader($name, $value): self {
        $this->headers[$name] = $value;
        return $this;
    }

    protected function sendHeaders(): void {
        foreach($this->headers as $name => $value) {
            header("$name: $value");
        }
    }

    public function send(string $response): void {
        $this->sendHeaders();
        echo $response;
        exit;
    }
}