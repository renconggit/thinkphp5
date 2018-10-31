<?php
namespace app\index\controller;     // 该文件的位于application\index\controller文件夹
use app\common\model\Teacher;       // 教师模型
/**
 * 教师管理
 */
class TeacherController
{
    public function index()
    {
        $Teacher = new Teacher;
        $teachers = $Teacher->select();

        // 获取第0个数据
        $teacher = $teachers[0];

        // 调用上述对象的getData()方法
        var_dump($teacher->getData());
    }
}