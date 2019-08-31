<?php

/** @package    W2o::Model */
/** import supporting libraries */
require_once("DAO/GradehorariaDAO.php");
require_once("GradehorariaCriteria.php");

/**
 * The Gradehoraria class extends GradehorariaDAO which provides the access
 * to the datastore.
 *
 * @package W2o::Model
 * @author ClassBuilder
 * @version 1.0
 */
class Gradehoraria extends GradehorariaDAO {

    /**
     * Override default validation
     * @see Phreezable::Validate()
     */
    public function Validate() {
        // example of custom validation
        // $this->ResetValidationErrors();
        // $errors = $this->GetValidationErrors();
        // if ($error == true) $this->AddValidationError('FieldName', 'Error Information');
        // return !$this->HasValidationErrors();

        if (!$this->HasValidationErrors()) {
            // já existe um mais de uma matéria no mesmo dia no banco
            $criteria = new GradehorariaCriteria();
            $criteria->Diasemana_Equals = $this->Diasemana;
            $criteria->Materiaid_Equals = $this->Materiaid;
            $gradehorarias = $this->_phreezer->Query('Gradehoraria', $criteria);

            if ($gradehorarias->Count() > 0) {
                $this->AddValidationError('Materiaid', 'Já existem registros para esta Matéria no mesmo dia');
            }
        }

        if (!$this->HasValidationErrors()) {
            // já existe um registro igual no banco
            $criteria = new GradehorariaCriteria();
            $criteria->Diasemana_Equals = $this->Diasemana;
            $criteria->Horario_Equals = $this->Horario;
            if ($this->Grademensal != "Todas"){
                $criteria->Grademensal_Equals = $this->Grademensal;
            }
            $gradehorarias = $this->_phreezer->Query('Gradehoraria', $criteria);

            if ($gradehorarias->Count() > 0) {
                $this->AddValidationError('Horario', 'Já existem registros para este Horário e Dia da Semana');
            }
        }

        if (!$this->HasValidationErrors()) {
            // somente aulas de seg a sextaem Todas.
            if ($this->Diasemana != "Sabado" && $this->Grademensal != "Todas") {
                $this->AddValidationError('Grademensal', 'Aulas durante a semana devem ser iguais para todas as semanas do mês');
            }
        }
        
        if (!$this->HasValidationErrors()) {
            // sabados não podem ser Todas.
            if ($this->Diasemana == "Sabado" && $this->Grademensal == "Todas") {
                $this->AddValidationError('Diasemana', 'Aulas de Sábado são de reforço. Só acontecem uma vez no mês');
            }
        }
        
        if (!$this->HasValidationErrors()) {
            // mais de 3 matérias durante a semana.
            $criteria = new GradehorariaCriteria();
            $criteria->Materiaid_Equals = $this->Materiaid;
            $criteria->Diasemana_NotEquals = 'Sabado';
            $gradehorarias = $this->_phreezer->Query('Gradehoraria', $criteria);

            if ($gradehorarias->Count() >= 3) {
                $this->AddValidationError('Materiaid', 'Já existem Matérias demais na semana');
            }
        }
        
        if (!$this->HasValidationErrors()) {
            // mais de 3 matérias durante a semana.
            $criteria = new GradehorariaCriteria();
            $criteria->Materiaid_Equals = $this->Materiaid;
            $criteria->Diasemana_Equals = 'Sabado';
            $gradehorarias = $this->_phreezer->Query('Gradehoraria', $criteria);

            if ($gradehorarias->Count() > 0 && $this->Diasemana=="Sabado") {
                $this->AddValidationError('Materiaid', 'Já existe esta Matéria cadastra no Sábado');
            }
        }

        if (!$this->HasValidationErrors()) {
            // aulas no ultimo sábado.
            if ($this->Diasemana=="Sabado" && $this->Grademensal=="Ultima" && $this->Materiaid <= 5) {
                $this->AddValidationError('Materiaid', 'No último sábado do mês só terão Aulas de Matemática,Geografia,História e Física');
            }
        }

        if (!$this->HasValidationErrors()) {
            // aulas no penultimo sabado.
            if ($this->Diasemana=="Sabado" && $this->Grademensal=="Penultima" && $this->Materiaid > 5) {
                $this->AddValidationError('Materiaid', 'No penúltimo sábado do mês só terão Aulas de Português,Inglês,Espanhol e Literatura');
            }
        }

        return !$this->HasValidationErrors();

        //return parent::Validate();
    }

    /**
     * @see Phreezable::OnSave()
     */
    public function OnSave($insert) {
        // the controller create/update methods validate before saving.  this will be a
        // redundant validation check, however it will ensure data integrity at the model
        // level based on validation rules.  comment this line out if this is not desired

        if (!$this->Validate())
            throw new Exception('Unable to Save Gradehoraria: ' . implode(', ', $this->GetValidationErrors()));

        // OnSave must return true or Phreeze will cancel the save operation
        return true;
    }

}

?>
