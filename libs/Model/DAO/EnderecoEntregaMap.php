<?php
/** @package    DespensaEsforco::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/IDaoMap.php");
require_once("verysimple/Phreeze/IDaoMap2.php");

/**
 * EnderecoEntregaMap is a static class with functions used to get FieldMap and KeyMap information that
 * is used by Phreeze to map the EnderecoEntregaDAO to the endereco_entrega datastore.
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
class EnderecoEntregaMap implements IDaoMap, IDaoMap2
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
			self::$FM["Id"] = new FieldMap("Id","endereco_entrega","id",true,FM_TYPE_INT,11,null,true);
			self::$FM["Rua"] = new FieldMap("Rua","endereco_entrega","rua",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["NroCasa"] = new FieldMap("NroCasa","endereco_entrega","nro_casa",false,FM_TYPE_VARCHAR,10,null,false);
			self::$FM["Bairro"] = new FieldMap("Bairro","endereco_entrega","bairro",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Cidade"] = new FieldMap("Cidade","endereco_entrega","cidade",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["Cep"] = new FieldMap("Cep","endereco_entrega","cep",false,FM_TYPE_VARCHAR,255,null,false);
			self::$FM["HorarioPreferencial"] = new FieldMap("HorarioPreferencial","endereco_entrega","horario_preferencial",false,FM_TYPE_VARCHAR,255,null,false);
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