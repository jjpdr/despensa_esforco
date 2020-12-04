<?php
/** @package    DespensaEsforco::Reporter */

/** import supporting libraries */
require_once("verysimple/Phreeze/Reporter.php");

/**
 * This is an example Reporter based on the CompraAutomatica object.  The reporter object
 * allows you to run arbitrary queries that return data which may or may not fith within
 * the data access API.  This can include aggregate data or subsets of data.
 *
 * Note that Reporters are read-only and cannot be used for saving data.
 *
 * @package DespensaEsforco::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class CompraAutomaticaReporter extends Reporter
{

	// the properties in this class must match the columns returned by GetCustomQuery().
	// 'CustomFieldExample' is an example that is not part of the `compra_automatica` table
	public $CustomFieldExample;

	public $Id;
	public $NomeSupermercado;
	public $Categoria;
	public $Prioridade;
	public $ValorMaximo;
	public $MetodoPagamento;
	public $EnderecoEntrega;

	/*
	* GetCustomQuery returns a fully formed SQL statement.  The result columns
	* must match with the properties of this reporter object.
	*
	* @see Reporter::GetCustomQuery
	* @param Criteria $criteria
	* @return string SQL statement
	*/
	static function GetCustomQuery($criteria)
	{
		$sql = "select
			'custom value here...' as CustomFieldExample
			,`compra_automatica`.`id` as Id
			,`compra_automatica`.`nome_supermercado` as NomeSupermercado
			,`compra_automatica`.`categoria` as Categoria
			,`compra_automatica`.`prioridade` as Prioridade
			,`compra_automatica`.`valor_maximo` as ValorMaximo
			,`compra_automatica`.`metodo_pagamento` as MetodoPagamento
			,`compra_automatica`.`endereco_entrega` as EnderecoEntrega
		from `compra_automatica`";

		// the criteria can be used or you can write your own custom logic.
		// be sure to escape any user input with $criteria->Escape()
		$sql .= $criteria->GetWhere();
		$sql .= $criteria->GetOrder();

		return $sql;
	}
	
	/*
	* GetCustomCountQuery returns a fully formed SQL statement that will count
	* the results.  This query must return the correct number of results that
	* GetCustomQuery would, given the same criteria
	*
	* @see Reporter::GetCustomCountQuery
	* @param Criteria $criteria
	* @return string SQL statement
	*/
	static function GetCustomCountQuery($criteria)
	{
		$sql = "select count(1) as counter from `compra_automatica`";

		// the criteria can be used or you can write your own custom logic.
		// be sure to escape any user input with $criteria->Escape()
		$sql .= $criteria->GetWhere();

		return $sql;
	}
}

?>