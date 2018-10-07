<?php
/**
 * @file
 * ​Strona ​administracyjna ​z ​wywołaniami ​zwrotnymi ​modułu ​annotate.
 */

/**
 * Tworzenie formularza dla ustawien przypisow
 * @ingroup forms
 * @see system_settings_form()
 */
function annotate_admin_settings() {
    //Pobierz tablcie rodzajow segmentow, zawierajaca wewnetrzne nazwy jako klucze i przyjazne nazwy jako wartosci np array('page'=>'Prosta strona');
    $types = node_type_get_types();
    foreach ($types as $node_type)
    {
        $options[$node_type->type] = $node_type->name;
    }

    $form['annotate_node_types'] = [
      '#type' => 'checkboxes',
      '#title' => t('Użytkownicy mogą tworzyć pryzpisy dla nastepujących rodzajów zawartości'),
      '#options' => $options,
      '#default_value' => variable_get('annotate_node_types',['page']),
      '#description' => t('Przy wybranych rodzajach zawartości zostaną wyświetlone pola tekstowe w celu umożliwienia dodawania prywatnych uwag przez użytkowników'),

    ];

    $form['annotate_deletion'] = [
        '#type' => 'radios',
        '#title' => t('Przypisy zostaną usunięte'),
        '#description' => t('Wybierz metodę usuwania przypisów'),
        '#options' => [
            t('Nigdy'),
            t('Losowo'),
            t('Po 30 dniach')
        ],
        '#default_value' => variable_get('annotate_deletion',0), //domyslnie nigdy
    ];

    $form['annotate_limit_per_node'] = [
      '#type' => 'textfield',
      '#title' => t('Liczba przypisów na pojedyńczy segment'),
      '#description' => t('Wprowadź maksymalną dopuszczalną liczbę przypisów dla pojedyńczego segmentu (0 - brak limitu)'),
      '#default_value' =>  variable_get('annotate_limit_per_node',1),
      '#size' => 3
    ];


    $form['#submit'][] = 'annotate_admin_settings_submit';

    return system_settings_form($form);
}

/**
 * Przetwarzanie formularza ustawien przyciskow
 * @param $form
 * @param $form_state
 *
 */
function annotate_admin_settings_submit($form,$form_state) {
   //przeiteruj kolekcje checkoboksow zawartych w formie
    watchdog('Moduł Przypisy Form','Wysłam posta');

    foreach ($form_state['values']['annotate_node_types'] as $key => $value) {

        //jeśli checkbox nie jest zaznaczony
        if (!$value) {
            $instance = field_info_instance('node','annotation',$key);
           if (!empty($instance)) {
               field_delete_instance($instance);
               watchdog("Przypis",'Usunięto pole przypisu z następującego rodzaju zawartości: %key',['%key'=>$key]);
           }

        }
        else {
            //jeżeli checkobox dla danego rodzaju zawartości jest zaznaczony, sprawdź
            //czy pole przypisu dla danego rodzaju zawartości istnieje, jeśli nie dodaj pole przypisu do tego rodzaju zawartosci
            $instance = field_info_instance('node','annotation',$key);

            if (empty($instance)) {
                $instance = [
                  'field_name' => 'annotation',
                  'entity_type' => 'node',
                  'bundle' => $key,
                  'label' => t('Przypis'),
                  'widget_type' => 'text_textarea_with_summary',
                  'settings' => ['display_summary' => true],
                  'display' => [
                      'default' => [
                          'type' => 'text_default'
                      ],
                      'teaser' => [
                          'type' => 'text_summary_or_trimmed'
                      ]
                  ]
                ];

                field_create_instance($instance);
                watchdog('Przypis','Dodano pole pryzpisu do następującego rodzaju zwaartości: %key',['%key'=>$key]);
            }
        }
    }


}

/**
 * Walidacja formularza ustawien przypisow
 */
function annotate_admin_settings_validate($form,&$form_state)
{
    $limit = $form_state['values']['annotate_limit_per_node'];
    $annotate_node_types = $form_state['values']['annotate_node_types'];

    if (!is_numeric($limit)) {
        form_set_error('annotate_limit_per_node',t('Proszę wprowadzić liczbę'));
    }
    //sprawdz czy jedna opcja jest zaznaczona
    if (!annotate_node_types_is_validate($annotate_node_types)) {
        form_set_error('annotate_node_types',t('Proszę wybrać przynajmniej jedną opcję'));
    }


}

/**
 * validator
 * @param $annotate_node_types
 * @return bool
 */
function annotate_node_types_is_validate($annotate_node_types) {
    foreach ($annotate_node_types as $key => $value)
    {
        if (!is_numeric($value)) {
            return true;
        }
    }
    return false;
}