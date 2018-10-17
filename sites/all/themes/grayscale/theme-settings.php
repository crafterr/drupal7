<?php

function grayscale_form_system_theme_settings_alter(&$form, &$form_state) {
    $form['styles'] = [
      '#type' => 'fieldset',
      '#title' => t('Ustawienia stylów'),
      '#collapsible' => false,
      '#collapsed' => false
    ];


    $form['styles']['font'] = [
      '#type' => 'fieldset',
      '#title' => t('Ustawienia czcionki'),
      '#collapsible' => true,
      '#collapsed' => true
    ];

    $form['styles']['font']['font_family'] = [
      '#type' => 'select',
      '#title' => t('Krój czcionki'),
      '#default_value' => theme_get_setting('font_family'),
      '#options' => [
          'ff-sss' => t('Helvetica Nueue, Trebuchet ms Arial, Nimbus Sans L, FreeSans, sans-serif'),
          'ff-ssl' => t('Verdana, Geneva, Arial, Helvetica, sans-serif'),
          'ff-a' => t('Arial, Helvetica, sans-serif'),
          'ff-ss' => t('Garmond, Perpetua, Nimbus Roman'),
          'ff-sl' => t('Basketville, Georgia, Palatino'),
          'ff-m' => t('Myriad Pro, Myriad, Arial, Helvetica, sans-serif'),
          'ff-l' => t('Lucida Sans, Lucida Grande, Lucida Sans Unicode, Verdana, Geneva, sans-serif'),

      ]
    ];

    $form['styles']['font']['font_size'] = [
      '#type' => 'select',
      '#title' => t('Rozmiar czcionki'),
      '#default_value' => theme_get_setting('font_size'),
      '#description' => t('Rozmiary czcionek są zawsze podawane w jednostkach relatywnych'),
      '#options' => [
          'fs-10' => t('10px'),
          'fs-11' => t('11px'),
          'fs-12' => t('12px'),
          'fs-13' => t('13px'),
          'fs-14' => t('14px'),
          'fs-15' => t('15px'),
          'fs-16' => t('16px')
      ]
    ];

    $form['root'] = [
        '#type' => 'fieldset',
        '#title' => t('Ustawienia root'),
        '#collapsible' => false,
        '#collapsed' => false
    ];

    $form['root']['subroot'] = [
        '#type' => 'fieldset',
        '#title' => t('Ustawienia subroot'),
        '#collapsible' => false,
        '#collapsed' => false
    ];

    $form['root']['subroot']['input'] = [
        '#type' => 'textfield',
        '#title' => t('Wpisz cos'),
        '#default_value' => theme_get_setting('input'),

    ];
}