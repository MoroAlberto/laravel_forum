<?php

// only the rules used by the app, the others fall back to English
return [
    'confirmed' => 'Il campo :attribute non corrisponde.',
    'email' => 'Il campo :attribute deve essere un indirizzo email valido.',
    'exists' => 'Il valore selezionato per :attribute non è valido.',
    'integer' => 'Il campo :attribute deve essere un numero intero.',
    'lowercase' => 'Il campo :attribute deve essere in minuscolo.',
    'max' => [
        'string' => 'Il campo :attribute non può superare :max caratteri.',
    ],
    'min' => [
        'numeric' => 'Il campo :attribute deve essere almeno :min.',
        'string' => 'Il campo :attribute deve contenere almeno :min caratteri.',
    ],
    'required' => 'Il campo :attribute è obbligatorio.',
    'string' => 'Il campo :attribute deve essere un testo.',
    'unique' => 'Il valore di :attribute è già in uso.',

    'attributes' => [
        'comment' => 'commento',
        'content' => 'contenuto',
        'email' => 'email',
        'name' => 'nome',
        'password' => 'password',
        'post_type_id' => 'tipo',
        'title' => 'titolo',
        'typeFilter' => 'filtro',
    ],
];
