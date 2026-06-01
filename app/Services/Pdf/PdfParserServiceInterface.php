<?php

namespace App\Services\Pdf;

interface PdfParserServiceInterface
{
    public function parse(string $storagePath): string;
}
