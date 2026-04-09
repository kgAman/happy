<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use thiagoalessio\TesseractOCR\TesseractOCR;

class OcrController extends Controller
{
    public function extract(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120'
        ]);

        // Store image
        $path = $request->file('image')->store('uploads');

        // OCR
        $text = (new TesseractOCR(storage_path('app/'.$path)))
            ->lang('eng')
            ->run();

        $text = $this->cleanText($text);

        return response()->json($this->extractFields($text));
    }

    private function cleanText($text)
    {
        return preg_replace('/\s+/', ' ', trim($text));
    }

    private function extractFields($text)
    {
        // Email
        preg_match('/[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}/i', $text, $email);

        // Phone
        preg_match('/(\+?\d{1,3}[\s-]?)?\d{10}/', $text, $phone);

        // Gender
        preg_match('/\b(male|female|other)\b/i', $text, $gender);

        // Name detection
        preg_match('/name[:\s]+([A-Za-z\s]+)/i', $text, $nameMatch);

        $first = $middle = $last = null;

        if (!empty($nameMatch[1])) {
            $parts = explode(' ', trim($nameMatch[1]));
            $first = $parts[0] ?? null;
            $last = count($parts) > 1 ? end($parts) : null;
            $middle = count($parts) > 2 ? implode(' ', array_slice($parts, 1, -1)) : null;
        }

        // Address
        preg_match('/address[:\s]+(.+?)(\d{6}|$)/i', $text, $address);

        return [
            'first_name'  => $first,
            'middle_name' => $middle,
            'last_name'   => $last,
            'phone'       => $phone[0] ?? null,
            'email'       => $email[0] ?? null,
            'gender'      => ucfirst(strtolower($gender[0] ?? '')),
            'address'     => trim($address[1] ?? '')
        ];
    }
}
