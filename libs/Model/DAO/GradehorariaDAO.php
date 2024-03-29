<?php
/** @package W2o::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("GradehorariaMap.php");

/**
 * GradehorariaDAO provides object-oriented access to the gradehoraria table.  This
 * class is automatically generated by ClassBuilder.
 *
 * WARNING: THIS IS AN AUTO-GENERATED FILE
 *
 * This file should generally not be edited by hand except in special circumstances.
 * Add any custom business logic to the Model class which is extended from this DAO class.
 * Leaving this file alone will allow easy re-generation of all DAOs in the event of schema changes
 *
 * @package W2o::Model::DAO
 * @author ClassBuilder
 * @version 1.0
 */
class GradehorariaDAO extends Phreezable
{
	/** @var int */
	public $Id;

	/** @var enum */
	public $Horario;

	/** @var enum */
	public $Grademensal;

	/** @var enum */
	public $Diasemana;

	/** @var int */
	public $Materiaid;


	/**
	 * Returns the foreign object based on the value of Materiaid
	 * @return Materia
	 */
	public function GetIdMateria()
	{
		return $this->_phreezer->GetManyToOne($this, "FK_gradehoraria_materia");
	}


}
?>