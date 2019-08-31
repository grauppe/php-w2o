<?php
/** @package W2o::Model::DAO */

/** import supporting libraries */
require_once("verysimple/Phreeze/Phreezable.php");
require_once("MateriaMap.php");

/**
 * MateriaDAO provides object-oriented access to the materia table.  This
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
class MateriaDAO extends Phreezable
{
	/** @var int */
	public $Id;

	/** @var string */
	public $Nome;


	/**
	 * Returns a dataset of Gradehoraria objects with matching Materiaid
	 * @param Criteria
	 * @return DataSet
	 */
	public function GetIdGradehorarias($criteria = null)
	{
		return $this->_phreezer->GetOneToMany($this, "FK_gradehoraria_materia", $criteria);
	}

	/**
	 * Returns a dataset of Professor objects with matching Materiaid
	 * @param Criteria
	 * @return DataSet
	 */
	public function GetIdProfessors($criteria = null)
	{
		return $this->_phreezer->GetOneToMany($this, "FK_professor_materia", $criteria);
	}


}
?>