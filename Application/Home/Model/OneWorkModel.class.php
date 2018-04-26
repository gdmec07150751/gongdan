<?php
namespace Home\Model;
use Think\Model;

/**
 * 用户组操作
 * @author  singwa
 */
class OneWorkModel extends Model {
private $_db = '';

	public function __construct() {
		$this->_db = M('onework');
	}



public function Insert($data = array()){
      if(!$data || !is_array($data)) {
            return 0;
        }
        return $this->_db->add($data);
}

public function selectall($id){
    return $this->_db->where('workorder_id='.$id)
    ->join('LEFT JOIN oa_img ON oa_onework.img_id = oa_img.img_id' )
    ->join('LEFT JOIN oa_file ON oa_onework.file_id = oa_file.file_id')
    ->select();
}


//将数据分页




/*public function selectallwi($id){
    return $this->_db
                ->where('workorder_id='.$id)
                ->join('oa_img ON oa_onework.img_id = oa_img.img_id' )
                ->select();
}
public function selectallwf($id){
    return $this->_db
                ->where('workorder_id='.$id)
                ->join('oa_file ON oa_onework.file_id = oa_file.file_id' )
                ->select();
}*/

}