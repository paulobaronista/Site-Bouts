<?php
return array(
    'email' => array(
        'credentials' => array(
            'from_mail' => 'contato@bouts.com.br',
            'from_name' => 'contato',
        ),
        //use smtp or sendmail
        'transport' => 'sendmail',
        'smtp' => array(
            'host' => 'smtp.domain.com',
            'port' => 587,
            'connection_class' => 'login',
            'connection_config' => array(
                'ssl'      => 'tls',
                'username' => 'youremail',
                'password' => 'yourpassword'
            ),
        ),
    ),
);