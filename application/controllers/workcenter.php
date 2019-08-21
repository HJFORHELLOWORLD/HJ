<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Workcenter extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->purview_model->checkpurview(82);
        $this->uid   = $this->session->userdata('uid');
    }

    public function index(){
    /*        $this->load->model('mysql_model');
            $this->mysql_model->countQty();
            exit;*/
       $this->load->view('workcenter/index');
}
    public function add(){

        $this->load->view('workcenter/add');
    }

    /**
     * showdoc
     * @catalog 开发文档/用户
     * @title 用户注册
     * @description 用户注册的接口
     * @method get
     * @url https://www.2midcm.com/workcenter/add
     * @param pk_wc_id 必选 string 工作中心编号
     * @param wc_name 必选 string 工作中心名称
     * @param desc 可选 string 描述
     * @param  head_id 必选 string 负责人
     * @param  creator_id 必选  创建人
     * @return {"status":200,"msg":"success,"share":"true","userid":1,"name":"小阳","username":"admin"}
     * @return_param status static 1：'200'注册成功;2："-1"注册失败
     * @remark 这里是备注信息
     * @number 1
     */
    public function save()
    {

        $data = ($this->input->post('data',TRUE));
        $data= json_decode($data,true);
//        print_r($data);
//        var_dump($data);
        $id  = intval($this->input->post('pk_wc_id',TRUE));
        $act = str_enhtml($this->input->get('act', TRUE));
        $info['pk_wc_id'] = $data['pk_wc_id'];
        $info['wc_name'] = $data['wc_name'];
        $info['desc'] = $data['desc'] ;
        $info['head_id'] = $data['head_id'];
        $info['creator_id'] = $data['creator_id'] ;

//        strlen($data['wc_name']) < 1 && die('{"status":-1,"msg":"工作中心名称不能为空"}');
//		$info['categoryName']   = $data['categoryname'] = $this->mysql_model->db_one(CATEGORY,'(id='.$data['categoryid'].')','name');
//		$info['unitName']   = $data['unitname']     = $this->mysql_model->db_one(UNIT,'(id='.$data['unitid'].')','name');
//		!$data['categoryname'] || !$data['unitname']  && die('{"status":-1,"msg":"参数错误"}');
        /*		var_dump($info,$data);*/
        if ($act == 'add') {
            $this->purview_model->checkpurview(69);
            $this->mysql_model->db_count(WORK_CERTER, '(pk_wc_id="' . $data['pk_wc_id'] . '")') > 0 && die('{"status":-1,"msg":"工作中心编号重复"}');
            $sql = $this->mysql_model->db_inst(WORK_CERTER, $data);
            if ($sql) {
                $info['pk_wc_id'] = $sql;
                $this->mysql_model->db_inst(WORK_CERTER, array('pk_wc_id' => $sql, 'num' => 0));
                $this->cache_model->delsome(WORK_CERTER);
//                $this->data_model->logs('新增工作中心:' . $data['wc_name']);
                die('{"status":200,"msg":"success","data":' . json_encode($info) . '}');
            } else {
                die('{"status":-1,"msg":"添加失败"}');
            }
        } elseif ($act == 'update') {
            $this->purview_model->checkpurview(70);
            $this->mysql_model->db_count(WORK_CERTER, '(pk_bom_id<>' . $id . ') and (number="' . $data['number'] . '")') > 0 && die('{"status":-1,"msg":"商品编号重复"}');
            $name = $this->mysql_model->db_one(BOM_BASE, '(pk_bom_id=' . $id . ')', 'name');
            $sql = $this->mysql_model->db_upd(BOM_BASE, $data, '(pk_bom_id=' . $id . ')');
            if ($sql) {
                $info['pk_bom_id'] = $id;
                $info['propertys'] = array();
                $this->cache_model->delsome(BOM_BASE);
                $this->data_model->logs('修改商品:' . $name . ' 修改为 ' . $data['name']);
                die('{"status":200,"msg":"success","data":' . json_encode($info) . '}');
            } else {
                die('{"status":-1,"msg":"修改失败"}');
            }
        }
    }





}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */