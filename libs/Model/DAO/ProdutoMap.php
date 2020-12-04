<?php
/** @package    DespensaEsforco::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * ProdutoMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the ProdutoDAO to the produto datastore.
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
class ProdutoMap implements IDaoMap, IDaoMap2
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
			self::$FM["Id"] = new FieldMap("Id","produto","id",true,FM_TYPE_INT,10,null,true);
			self::$FM["Nome"] = new FieldMap("Nome","produto","nome",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["DataValidade"] = new FieldMap("DataValidade","produto","data_validade",false,FM_TYPE_DATE,null,null,false);
			self::$FM["Categoria"] = new FieldMap("Categoria","produto","categoria",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Prioridade"] = new FieldMap("Prioridade","produto","prioridade",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["QtdMinima"] = new FieldMap("QtdMinima","produto","qtd_minima",false,FM_TYPE_INT,10,null,false);
			self::$FM["QtdMaxima"] = new FieldMap("QtdMaxima","produto","qtd_maxima",false,FM_TYPE_INT,10,null,false);
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