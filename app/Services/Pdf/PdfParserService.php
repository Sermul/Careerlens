<?php

namespace App\Services\Pdf;

use App\Exceptions\PdfParsingException;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser;

class PdfParserService implements PdfParserServiceInterface
{
    public function parse(string $storagePath): string
    {
        try {
            $filePath = Storage::disk('local')->path($storagePath);

            if (! file_exists($filePath) || ! is_readable($filePath)) {
                throw new PdfParsingException("PDF file not readable: {$storagePath}");
            }

            $parser = new Parser();
            $pdf = $parser->parseFile($filePath);
            $text = trim($pdf->getText() ?? '');

            return $text;
        } catch (\Throwable $exception) {
            throw new PdfParsingException('PDF parsing failed: '.$exception->getMessage(), 0, $exception);
        }
    }
}
