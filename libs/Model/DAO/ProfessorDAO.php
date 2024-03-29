<?php
/** @package W2o::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("ProfessorMap.php");

/**
 * ProfessorDAO provides object-oriented access to the professor table.  This
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
class ProfessorDAO extends Phreezable
{
	/** @var int */
	public $Id;

	/** @var string */
	public $Nome;

	/** @var enum */
	public $Tipo;

	/** @var int */
	public $Materiaid;


	/**
	 * Returns a dataset of Feria objects with matching Professorid
	 * @param Criteria
	 * @return DataSet
	 */
	public function GetIdFerias($criteria = null)
	{
		return $this->_phreezer->GetOneToMany($this, "FK__professor", $criteria);
	}

	/**
	 * Returns the foreign object based on the value of Materiaid
	 * @return Materia
	 */
	public function GetIdMateria()
	{
		return $this->_phreezer->GetManyToOne($this, "FK_professor_materia");
	}


}
?>