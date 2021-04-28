<?php

/**
 * Class Chemical
 * Chemical model
 */
class NewChemical extends AppModel
{

	public $useDbConfig='new';
	public $useTable='chemicals';

	public $hasMany = [
		'NewComponent'=> [
			'foreignKey' => 'chemical_id',
			'dependent' => true
		]
	];

	public $belongsTo = [
		'NewFile'=>[
			'foreignKey' => 'file_id',
			],
		'NewSubstance'=>[
			'foreignKey' => 'substance_id',
		]
	];

	/**
	 * function to add a new chemical if it does not already exist
	 * @param array $data
	 * @param $setcnt
	 * @return integer
	 * @throws Exception
	 */
	public function add(array $data): int
	{
		$model='NewChemical';
		$found=$this->find('first',['conditions'=>$data,'recursive'=>-1]);
		if(!$found) {
			$this->create();
			$this->save([$model=>$data]);
			$id=$this->id;
			$this->clear();
		} else {
			$id=$found[$model]['id'];
		}
		return $id;
	}

}
