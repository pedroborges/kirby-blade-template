<?php

if (! function_exists('compatible_e')) {
  /**
   * Escape HTML special characters in a string.
   *
   * @param  \Illuminate\Contracts\Support\Htmlable|string  $value
   * @param  bool  $doubleEncode
   * @return string
   */
  function compatible_e($value, $doubleEncode = true)
  {
      if ($value instanceof Htmlable) {
          return $value->toHtml();
      }

      return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', $doubleEncode);
  }
}
