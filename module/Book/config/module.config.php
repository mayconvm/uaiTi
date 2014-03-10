<?php

namespace Book;

return array(
		'controllers' => array(
				'invokables' => array(
						'Book\Controller\Index' => 'Book\Controller\IndexController',
				),
		),
		'view_manager' => array(
				'template_path_stack' => array(
						__DIR__ . '/../view',
				),
		),
		'router' => array(
				'routes' => array(
						'book_index' => array(
								'type' => 'Zend\Mvc\Router\Http\Segment',
								'options' => array(
										'route'    => '/books[/:id]',
										'defaults' => array(
												'controller' => 'Book\Controller\Index',
												'action'     => 'index',
										),
										'constraints' => array(
												'action'	=> 	'[a-zA-Z0-9_-]+',
												'id'		=>	'[0-9]+'
										)
								),
						),
				)
		),
		'doctrine' => array(
				'driver' => array(
						__NAMESPACE__ . '_driver' => array(
								'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
								'cache' => 'array',
								'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
						),
						'orm_default' => array(
								'drivers' => array(
										__NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
								),
						),
				),
		),
);