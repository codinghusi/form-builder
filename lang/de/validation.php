<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute muss akzeptiert werden.',
    'active_url' => ':attribute ist keine gültige URL.',
    'after' => ':attribute muss ein Datum nach :date sein.',
    'alpha' => ':attribute darf nur Buchstaben enthalten.',
    'alpha_dash' => ':attribute darf nur Buchstaben, Zahlen, Bindestriche und Unterstriche enthalten.',
    'alpha_num' => ':attribute darf nur Buchstaben und Zahlen enthalten.',
    'array' => ':attribute muss ein Array sein.',
    'before' => ':attribute muss ein Datum vor :date sein.',
    'between' => [
        'array' => ':attribute muss zwischen :min und :max Einträge haben.',
        'file' => ':attribute muss zwischen :min und :max Kilobyte groß sein.',
        'numeric' => ':attribute muss zwischen :min und :max liegen.',
        'string' => ':attribute muss zwischen :min und :max Zeichen lang sein.',
    ],
    'boolean' => 'Das :attribute-Feld muss wahr oder falsch sein.',
    'confirmed' => 'Die :attribute-Bestätigung stimmt nicht überein.',
    'current_password' => 'Das Passwort ist falsch.',
    'date' => ':attribute ist kein gültiges Datum.',
    'date_format' => ':attribute entspricht nicht dem Format :format.',
    'decimal' => ':attribute muss :decimal Nachkommastellen haben.',
    'different' => ':attribute und :other müssen unterschiedlich sein.',
    'digits' => ':attribute muss :digits Stellen haben.',
    'digits_between' => ':attribute muss zwischen :min und :max Stellen haben.',
    'email' => ':attribute muss eine gültige E-Mail-Adresse sein.',
    'exists' => 'Das ausgewählte :attribute ist ungültig.',
    'file' => ':attribute muss eine Datei sein.',
    'filled' => 'Das :attribute-Feld muss einen Wert haben.',
    'gt' => [
        'array' => ':attribute muss mehr als :value Einträge haben.',
        'file' => ':attribute muss größer als :value Kilobyte sein.',
        'numeric' => ':attribute muss größer als :value sein.',
        'string' => 'Das :attribute muss größer als :value Zeichen sein.',
    ],
    'gte' => [
        'array' => 'Das :attribute muss mindestens :value Einträge haben.',
        'file' => 'Das :attribute muss mindestens :value Kilobyte oder mehr sein.',
        'numeric' => 'Das :attribute muss mindestens :value oder mehr sein.',
        'string' => 'Das :attribute muss mindestens :value Zeichen oder mehr sein.',
    ],
    'image' => 'Das :attribute muss ein Bild sein.',
    'in' => 'Das ausgewählte :attribute ist ungültig.',
    'in_array' => 'Das :attribute-Feld ist nicht in :other vorhanden.',
    'integer' => 'Das :attribute muss eine Ganzzahl sein.',
    'ip' => 'Das :attribute muss eine gültige IP-Adresse sein.',
    'ipv4' => 'Das :attribute muss eine gültige IPv4-Adresse sein.',
    'ipv6' => 'Das :attribute muss eine gültige IPv6-Adresse sein.',
    'json' => 'Das :attribute muss ein gültiger JSON-String sein.',
    'lowercase' => 'Das :attribute muss klein geschrieben sein.',
    'lt' => [
        'array' => 'Das :attribute muss weniger als :value Einträge haben.',
        'file' => 'Das :attribute muss weniger als :value Kilobyte sein.',
        'numeric' => 'Das :attribute muss weniger als :value sein.',
        'string' => 'Das :attribute muss weniger als :value Zeichen haben.',
    ],
    'lte' => [
        'array' => 'Das :attribute darf nicht mehr als :value Einträge haben.',
        'file' => 'Das :attribute muss weniger als oder gleich :value Kilobyte sein.',
        'numeric' => 'Das :attribute muss weniger als oder gleich :value sein.',
        'string' => 'Das :attribute muss weniger als oder gleich :value Zeichen haben.',
    ],
    'mac_address' => 'Das :attribute muss eine gültige MAC-Adresse sein.',
    'max' => [
        'array' => 'Das Attribut :attribute darf nicht mehr als :max Einträge haben.',
        'file' => 'Das Attribut :attribute darf nicht größer als :max Kilobyte sein.',
        'numeric' => 'Das Attribut :attribute darf nicht größer als :max sein.',
        'string' => 'Das Attribut :attribute darf nicht länger als :max Zeichen sein.',
    ],
    'max_digits' => 'Das Attribut :attribute darf nicht mehr als :max Stellen haben.',
    'mimes' => 'Das Attribut :attribute muss eine Datei vom Typ :values sein.',
    'mimetypes' => 'Das Attribut :attribute muss eine Datei vom Typ :values sein.',
    'min' => [
        'array' => 'Das Attribut :attribute muss mindestens :min Einträge haben.',
        'file' => 'Das Attribut :attribute muss mindestens :min Kilobyte groß sein.',
        'numeric' => 'Das Attribut :attribute muss mindestens :min betragen.',
        'string' => 'Das Attribut :attribute muss mindestens :min Zeichen lang sein.',
    ],
    'min_digits' => 'Das Attribut :attribute muss mindestens :min Stellen haben.',
    'missing' => 'Das Attributfeld :attribute muss fehlen.',
    'missing_if' => 'Das Attributfeld :attribute muss fehlen, wenn :other :value ist.',
    'missing_unless' => 'Das Attributfeld :attribute muss fehlen, es sei denn, :other ist :value.',
    'missing_with' => 'Das Attributfeld :attribute muss fehlen, wenn :values vorhanden ist.',
    'missing_with_all' => 'Das Attributfeld :attribute muss fehlen, wenn :values vorhanden sind.',
    'multiple_of' => 'Das Attribut :attribute muss ein Vielfaches von :value sein.',
    'not_in' => 'Das ausgewählte Attribut :attribute ist ungültig.',
    'not_regex' => 'Das Format des Attributs :attribute ist ungültig.',
    'numeric' => 'Das Attribut :attribute muss eine Zahl sein.',
    'password' => [
        'letters' => 'The :attribute must contain at least one letter.',
        'mixed' => 'The :attribute must contain at least one uppercase and one lowercase letter.',
        'numbers' => 'The :attribute must contain at least one number.',
        'symbols' => 'The :attribute must contain at least one symbol.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'The :attribute field must be present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute field is required.',
    'required_array_keys' => 'The :attribute field must contain papers for: :values.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_if_accepted' => 'The :attribute field is required when :other is accepted.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'array' => 'The :attribute must contain :size items.',
        'file' => 'The :attribute must be :size kilobytes.',
        'numeric' => 'The :attribute must be :size.',
        'string' => 'The :attribute must be :size characters.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'Das :attribute muss eine Zeichenkette sein.',
    'timezone' => 'Das :attribute muss eine gültige Zeitzone sein.',
    'unique' => 'Das :attribute wurde bereits verwendet.',
    'uploaded' => 'Das :attribute konnte nicht hochgeladen werden.',
    'url' => 'Das :attribute hat kein gültiges URL-Format.',
    'uuid' => 'Das :attribute muss eine gültige UUID sein.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'benutzerdefinierte Nachricht',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
