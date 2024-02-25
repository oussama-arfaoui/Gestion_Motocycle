<?php

if (!function_exists('processShortcodes')) {
    function processShortcodes($content) {
        // Regular expression to match shortcode patterns
        $pattern = '/\[(\w+)(.*?)\]/';

        // Initialize an array to store processed shortcodes
        $processedShortcodes = [];

        // Match shortcodes in the content
        preg_match_all($pattern, $content, $matches);

        // Check if any matches were found
        if (!empty($matches[0])) {
            // Iterate through matched shortcodes
            foreach ($matches[1] as $index => $name) {
                $attributes = [];
                if (!empty($matches[2][$index])) {
                    // Split attributes
                    preg_match_all('/(\w+)=["\']([^"\']*)["\']/', $matches[2][$index], $attributeMatches, PREG_SET_ORDER);
                    foreach ($attributeMatches as $attributeMatch) {
                        $attributes[$attributeMatch[1]] = $attributeMatch[2];
                    }
                }
                // Look up the shortcode in getShortcodeindex()
                $shortcodeTypes = getShortcodeindex();
                if (array_key_exists($name, $shortcodeTypes)) {
                    $shortcodeInfo = $shortcodeTypes[$name];
                    // Merge attributes with default attributes from getShortcodeindex()
                    $mergedAttributes = array_merge($shortcodeInfo['attributes'], $attributes);
                    // Render the view with the merged attributes
                    $view = renderViewWithAttributes($shortcodeInfo['view'], $mergedAttributes);
                    // Store the processed shortcode
                    $processedShortcodes[] = $view;
                }
            }
            // Replace the shortcodes in the content with their processed versions
            foreach ($matches[0] as $index => $shortcode) {
                // Add the processed shortcode to the content
                $content = str_replace($shortcode, $processedShortcodes[$index], $content);
            }
        }
        

        $content = preg_replace('/\[\/\w+\]/', '', $content);
        return $content;
    }
}


function renderViewWithAttributes($view, $attributes) {
    // Render the view with the provided attributes
    return view($view, $attributes)->render();
}

