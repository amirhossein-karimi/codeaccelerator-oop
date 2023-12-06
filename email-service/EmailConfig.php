<?php

final class EmailConfig
{

    private int $SMTPDebug;
    private bool $SMPTAuth;
    private string $SMTPSecure;
    private int $port;
    private string $host;
    private string $username;
    private string $password;

    public function getSMTPDebug(): int
    {
        return $this->SMTPDebug;
    }

    public function setSMTPDebug(int $SMTPDebug): void
    {
        $this->SMTPDebug = $SMTPDebug;
    }

    public function isSMPTAuth(): bool
    {
        return $this->SMPTAuth;
    }

    public function setSMPTAuth(bool $SMPTAuth): void
    {
        $this->SMPTAuth = $SMPTAuth;
    }

    public function getSMTPSecure(): string
    {
        return $this->SMTPSecure;
    }

    public function setSMTPSecure(string $SMTPSecure): void
    {
        $this->SMTPSecure = $SMTPSecure;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function setPort(int $port): void
    {
        if ($port <= 0 || $port > 65535) {
            throw new Exception('The port number is not valid');
        }
        $this->port = $port;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
