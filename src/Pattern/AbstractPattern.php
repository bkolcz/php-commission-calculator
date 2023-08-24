<?php

namespace App\Pattern;

abstract class AbstractPattern implements PatternInterface {
    public function getEuPattern(): string {
        return '/AT|BE|BG|CY|CZ|DE|DK|EE|ES|FI|FR|GR|HR|HU|IE|IT|LT|LU|LV|MT|NL|PO|PT|RO|SE|SI|SK/';
    }
}