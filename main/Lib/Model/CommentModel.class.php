<?php
class CommentModel extends RelationModel{
	 protected $_link = array(
	 		'reply_cmt'=>array(
            		'mapping_type'    =>HAS_MANY,//HAS_MANY,//HAS_ONE查询子表的一条
             		'class_name'    =>'reply_cmt',//子表表名，重要
	 				'mapping_name'=>'reply_cmt',//子表返回数组的数组名
	 				'foreign_key'		=>'rplcmt_cmt_id',//子表的关联字段名
                 // 定义更多的关联属性
             ),
     );
	
}
