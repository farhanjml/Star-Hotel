<?php

require_once('FormProcessor.php');

$form = array(
    'subject' => 'New Form Submission',
    'email_message' => 'You have a new form submission',
    'success_redirect' => '',
    'sendIpAddress' => true,
    'email' => array(
    'from' => '',
    'to' => ''
    ),
    'fields' => array(
    'name' => array(
    'order' => 1,
    'type' => 'string',
    'label' => 'E-mail:',
    'required' => true,
    'errors' => array(
    'required' => 'Field \'E-mail:\' is required.'
    )
    ),
    'private' => array(
    'order' => 2,
    'type' => 'string',
    'label' => 'Password:',
    'required' => false,
    'errors' => array(
    'required' => 'Field \'Password:\' is required.'
    )
    ),
    'checkbox' => array(
    'order' => 3,
    'type' => 'checkbox',
    'label' => 'Remember me',
    'required' => false,
    'errors' => array(
    'required' => 'Field \'Remember me\' is required.'
    )
    ),
    )
    );

    $processor = new FormProcessor('');
    $processor->process($form);

    ?>