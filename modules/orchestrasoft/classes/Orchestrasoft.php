<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of orchestrasoft
 *
 * @author Marc
 */
class Orchestrasoft extends ObjectModel{
  /** @var string Name */
  public $orchestrasoft;
 
  protected $fieldsRequired = array('orchestrasoft');
  protected $fieldsSize = array('orchestrasoft' => 64);
  protected $fieldsValidate = array('orchestrasoft' => 'isGenericName');
  protected $table = 'orchestrasoft';
  protected $identifier = 'id_orchestrasoft';
 
  public function getFields()
    {
    parent::validateFields();
    $fields['orchestrasoft'] = pSQL($this->test);
    return $fields;
    }
  }
?>}
