<?php

function menufun_greeting($firstname= '',$lastname='',$fromfirstname='',$fromlastname='')
{
    return t('Witaj, @firstname @lastname od @fromfirstname @fromlastname',['@firstname'=>$firstname,'@lastname'=>$lastname,'@fromfirstname'=>$fromfirstname,'@fromlastname'=>$fromlastname]);
}

function menufun_farewell()
{
    return t('Żegnaj!');
}

function menufun_title()
{
    drupal_set_title(t('Tytuł naszej strony'));
    $date = new DateTime();
    return t('Aktualna data to: '.$date->format('Y-m-d h:i:s'));

}

