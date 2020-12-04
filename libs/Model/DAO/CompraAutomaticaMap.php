<?php
/** @package    DespensaEsforco::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * CompraAutomaticaMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the CompraAutomaticaDAO to the compra_automatica datastore.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * You can override the default fetching strategies for KeyMaps in _config.php.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package DespensaEsforco::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class CompraAutomaticaMap implements IDaoMap, IDaoMap2
{

	private static $KM;
	private static $FM;
	
	/**
	 * {@inheritdoc}
	 */
	public static function AddMap($property,FieldMap $map)
	{
		self::GetFieldMaps();
		self::$FM[$property] = $map;
	}
	
	/**
	 * {@inheritdoc}
	 */
	public static function SetFetchingStrategy($property,$loadType)
	{
		self::GetKeyMaps();
		self::$KM[$property]->LoadType = $loadType;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetFieldMaps()
	{
		if (self::$FM == null)
		{
			self::$FM = Array();
			self::$FM["Id"] = new FieldMap("Id","compra_automatica","id",true,FM_TYPE_INT,11,null,true);
			self::$FM["NomeSupermercado"] = new FieldMap("NomeSupermercado","compra_automatica","nome_supermercado",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Categoria"] = new FieldMap("Categoria","compra_automatica","categoria",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Prioridade"] = new FieldMap("Prioridade","compra_automatica","prioridade",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["ValorMaximo"] = new FieldMap("ValorMaximo","compra_automatica","valor_maximo",false,FM_TYPE_INT,10,null,false);
			self::$FM["MetodoPagamento"] = new FieldMap("MetodoPagamento","compra_automatica","metodo_pagamento",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["EnderecoEntrega"] = new FieldMap("EnderecoEntrega","compra_automatica","endereco_entrega",false,FM_TYPE_VARCHAR,255,null,false);
		}
		return self::$FM;
	}

	/**
	 * {@inheritdoc}
	 */
	public static function GetKeyMaps()
	{
		if (self::$KM == null)
		{
			self::$KM = Array();
		}
		return self::$KM;
	}

}

?>