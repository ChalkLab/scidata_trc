<?php

/**
 * Class phase
 * Phase model
 */
class NewPhase extends AppModel
{

	public $useDbConfig='new';
	public $useTable='phases';

	public $belongsTo = [
		'NewPhasetype'=> [
			'foreignKey' => 'phasetype_id'
		],
		'NewMixture'=> [
			'foreignKey' => 'mixture_id'
		]
	];

	/**
	 * function to add a new phase if it does not already exist
	 * @param array $data
	 * @return integer
	 * @throws
	 */
	public function add(array $data): int
	{
		$model='NewPhase';
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
