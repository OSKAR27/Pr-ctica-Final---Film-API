<?php

namespace MyApp\Component\Product\Application\Service;

interface EmailService
{
    // TODO: Consider creating a ValueObject for $email and a ValueObject for $content
    public function sendEmailTo(string $email, string $content);
}