<?php
/** @package DespensaEsforco::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("MetodoPagamentoMap.php");

/**
 * MetodoPagamentoDAO provides object-oriented access to the metodo_pagamento table.  This
 * class is automatically generated by ClassBuilder.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * Add any custom business logic to the Model class which is extended from this DAO class.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package DespensaEsforco::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class MetodoPagamentoDAO extends Phreezable
{
	/** @var int */
	public $Id;

	/** @var string */
	public $NomeTitular;

	/** @var string */
	public $NumeroCartao;

	/** @var date */
	public $DataValidadeCartao;

	/** @var int */
	public $CodigoSeguranca;

	/** @var string */
	public $CpfTitular;



}
?>