<?php
namespace app\index\controller;     // 该文件的位于application\index\controller文件夹
use app\common\model\Teacher;       // 教师模型
use think\Controller;
use think\Request;
/**
 * 教师管理
 */
class TeacherController extends Controller
{
    public function index()
    {
        $Teacher = new Teacher; 
        $teachers = $Teacher->select();

        // 向V层传数据
        $this->assign('teachers', $teachers);

        // 取回打包后的数据
        $htmls = $this->fetch();

        // 将数据返回给用户
        return $htmls;
    }
    public function add()
    {
        $htmls = $this->fetch();
        return $htmls;
    }
    public function insert()
    {
        // Request::instance()返回了一个对象，调用这个对象的post()方法，得到post数据
        $postData = Request::instance()->post();
        //$postData = $this->request->post(); 

        // 引用teacher数据表对应的模型
        $Teacher = new Teacher();

        // 为对象赋值
        $Teacher->name = $postData['name'];
        $Teacher->username = $postData['username'];
        $Teacher->sex = $postData['sex'];
        $Teacher->email = $postData['email'];
        $Teacher->createtime = time();
        
        // 新增对象至数据表
        $result = $Teacher->validate(true)->save();

        // 反馈结果
        if (false === $result)
        {
            return '新增失败:' . $Teacher->getError();
        } else {
            return  '新增成功。新增ID为:' . $Teacher->id;
        }
    }
    //http://localhost/thinkphp5/public/index/teacher/indexs?a=0
    //http://localhost/thinkphp5/public/index/teacher/indexs?a=1
    //http://localhost/thinkphp5/public/index/teacher/indexs/a/1
    public function indexs($a)
    {
        // $Teacher 首写字母大写，说明它是一个对象，更确切一些说明这是基于Teacher这个模型被我们手工实例化得到的，如果存在teacher数据表，它将对应teacher数据表。
        $Teacher=new Teacher();

        // $teachers 以s结尾，表示它是一个数组，数据中的每一项都是一个对象，这个对象基于Teahcer这个模型。
        $teachers=$Teacher->select();

        // 获取第0个数据
        $teacher = $teachers[$a];

        // 调用上述对象的getData()方法
        var_dump($teacher->getData('name'));
        echo $teacher->getData('name');
        return $teacher->getData('name');
    }    
    public function get_list()
    {
        //http://localhost/thinkphp5/public/index/teacher/get_list

        // $Teacher 首写字母大写，说明它是一个对象，更确切一些说明这是基于Teacher这个模型被我们手工实例化得到的，如果存在teacher数据表，它将对应teacher数据表。
        $Teacher=new Teacher();

        // $teachers 以s结尾，表示它是一个数组，数据中的每一项都是一个对象，这个对象基于Teahcer这个模型。
        $teachers=$Teacher->select();

        // 调用上述对象的getData()方法
        var_dump($teachers[0]);        
    }
}