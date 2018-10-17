<?php
/**
 * Przesłoń lub wstaw zmienne do szablonu html
 */
function grayscale_process_html(&$vars) {

    //dodaj klasy odpowiedzialne za styl czcionki
    $classes = explode(' ',$vars['classes']);
    $classes[]= theme_get_setting('font_family');
    $classes[] = theme_get_setting('font_size');
    $classes[] = theme_get_setting('input');
    $vars['classes'] = trim(implode(' ',$classes));



}

/**
 * Implements hook_theme().
 */
/*function grayscale_theme()
{
    return [
        'mybreadcrumb' => [
            'variables' => [
               'html' => null,
            ],
            'template' => 'mybreadcrumb'
        ]


    ];
}

function grayscale_breadcrumb($variables) {
    $breadcrumb = $variables['breadcrumb'];

    if (!empty($breadcrumb)) {
        // Provide a navigational heading to give context for breadcrumb links to
        // screen-reader users. Make the heading invisible with .element-invisible.
        $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';

        $output .= '<div class="breadcrumb">' . implode(' * ', $breadcrumb) . '</div>';
        return theme('mybreadcrumb',['output'=>$output]);
        return $output;
    }
}
*/

function grayscale_preprocess_breadcrumb(&$variables) {

    $variables['breadcrumb_delimiter'] = "#";
}