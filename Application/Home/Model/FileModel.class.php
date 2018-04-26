<?php
namespace Home\Model;
use Think\Model;

/**
 * 用户组操作
 * @author  singwa
 */
class FileModel extends Model {


public function Insertall($data = array()){
      if(!$data || !is_array($data)) {
            return 0;
        }
        return M('file')->add($data);
}

}