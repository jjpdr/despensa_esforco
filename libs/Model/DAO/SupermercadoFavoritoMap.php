<?php
/** @package    DespensaEsforco::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * SupermercadoFavoritoMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the SupermercadoFavoritoDAO to the supermercado_favorito datastore.
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
class SupermercadoFavoritoMap implements IDaoMap, IDaoMap2
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
			self::$FM["Id"] = new FieldMap("Id","supermercado_favorito","id",true,FM_TYPE_INT,11,null,true);
			self::$FM["Nome"] = new FieldMap("Nome","supermercado_favorito","nome",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Endereco"] = new FieldMap("Endereco","supermercado_favorito","endereco",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Bairro"] = new FieldMap("Bairro","supermercado_favorito","bairro",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Cep"] = new FieldMap("Cep","supermercado_favorito","cep",false,FM_TYPE_VARCHAR,10,null,false);
			self::$FM["Cidade"] = new FieldMap("Cidade","supermercado_favorito","cidade",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Estado"] = new FieldMap("Estado","supermercado_favorito","estado",false,FM_TYPE_VARCHAR,2,null,false);
			self::$FM["DataUltimaCompra"] = new FieldMap("DataUltimaCompra","supermercado_favorito","data_ultima_compra",false,FM_TYPE_DATE,null,null,false);
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