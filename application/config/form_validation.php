<?php
$config = array(
           'designer_controller/send_email' => array(
                                    array(
                                            'field' => 'email_address',
                                            'label' => 'Email',
                                            'rules' => 'trim|required|valid_email'
                                         ),
           							array(
           								'field' => 'first_name',
           								'label' => 'First Name',
           								'rules' => 'trim|required'
                                    ),
           							array(
           								'field' => 'postcode',
           								'label' => 'Postcode',
           								'rules' => 'trim|required'
           								)
                                    )
               );