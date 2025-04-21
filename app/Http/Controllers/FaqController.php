<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = [
            [
                'question' => 'Was ist latr?',
                'answer' => '"latr" ist eine smarte Watchlist für Filme, Serien und Videos. Plattformübergreifend, minimalistisch, und immer bereit, wenn du Zeit hast.',
                'open' => true
            ],
            [
                'question' => 'Ist latr kostenlos nutzbar?',
                'answer' => 'Ja, latr ist kostenlos nutzbar. Du kannst dich jederzeit registrieren und die App ohne Kosten nutzen.',
                'open' => false
            ],
            [
                'question' => 'Welche Plattformen werden derzeit unterstützt?',
                'answer' => 'Derzeit unterstützen wir nur YouTube. Weitere Plattformen werden aber in Zukunft hinzugefügt!',
                'open' => false
            ],
            [
                'question' => 'Was steckt hinter latr? Kann ich den Code sehen?',
                'answer' => 'Latr wurde mit Laravel und Tailwind entwickelt. Der Code ist öffentlich zugänglich, indem du unten auf den Link "Github" klickst.',
                'open' => false
            ],
        ];

        return view('faq', compact('faqs'));
    }
}
