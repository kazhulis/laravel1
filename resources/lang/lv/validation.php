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
    'email' => ':attribute jābūt pareizam e-pastam.',
    'max' => [
        'numeric' => ':attribute jābūt mazākam par :max.',
        'file' => ':attribute jābūt mazākam par :max kilobytes.',
        'string' => ':attribute jābūt mazāk par :max :max characters.',
        'array' => 'The :attribute may not have more than :max items.',
    ],
    'min' => [
        'numeric' => ':attribute jābūt lielākam par :min.',
        'file' => ':attribute jābūt lielākam par :min.',
        'string' => ':attribute jābūt lielākam par :min.',
        'array' => ':attribute jābūt lielākam par :min.',
    ],
    'regex' => ':attribute formāts nav pareizs',
    'size' => [
        'numeric' => ':attribute jābūt mazākam par :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],

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
            'rule-name' => 'custom-message',
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
