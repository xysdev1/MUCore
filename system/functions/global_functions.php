<?php
function safe_input($data, $allowed_chars = '') {
    // Sanitiza la entrada
    return preg_replace('/[^' . preg_quote($allowed_chars, '/') . ']/', '', htmlspecialchars($data, ENT_QUOTES, 'UTF-8'));
}
