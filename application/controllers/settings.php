<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct(){
        parent::__construct();
		$this->load->model('config_model');
		$this->purview_model->checkpurview();
    }
	
	//系统参数
	public function parameter() {
	    $this->purview_model->checkpurview(81);
		$data = str_enhtml($this->input->post(NULL,TRUE));
		if (is_array($data) && count($data)>0) {
		    $dir = './data/config/parameter_config.php';
			$err = $this->config_model->set_config($data,$dir);
			if ($err) {
			    die('{"status":200,"msg":"success"}');
			} else {
			    alert('设置失败'); 
			}
		} else {
		    $this->load->view('settings/parameter',$data);	
		}
	}
	
	//皮肤切换
	public function skins() {
		$skin = $this->input->get_post('skin',TRUE);
		$skin = $skin ? $skin : 'green';
		set_cookie('skin',$skin,120000);
		die('{"status":200,"msg":"success"}');
	}

	
	//供应商分类
	public function vendor_cate_manage() {
		$this->load->view('settings/vendor_cate_manage');	
	}
	
	//客户分类
	public function customer_cate_manage() {
		$this->load->view('settings/customer_cate_manage');	
	}
	
	//批量选择供应商 
	public function vendor_batch() {
		$this->load->view('settings/vendor_batch');	
	}
	
	//批量选择客户
	public function customer_batch() {
		$this->load->view('settings/customer_batch');	
	}
	
	//批量选择商品 
	public function goods_batch() {
		$this->load->view('settings/goods_batch');	
	}
	
	//新增商品
	public function goods_manage() {
        $data['specArr'] = array('spec1' => '属性1', 'spec2' => '属性2', 'spec3' => '属性3', 'spec4' => '属性4', 'spec5' => '属性5', 'spec6' => '属性6',
            'spec7' => '属性7');
		$this->load->view('settings/goods_manage',$data);
	}
	
	//结算方式选择
	public function settlement_manage() {
		$this->load->view('settings/settlement_manage');	
	}
	
	//供应商选择
	public function vendor_manage() {
		$this->load->view('settings/vendor_manage');	
	}
	
	//客户选择
	public function customer_manage() {
		$this->load->view('settings/customer_manage');	
	}
	
	//单位
	public function unit_manage() {
		$this->load->view('settings/unit_manage');	
	}

    //人员
    public function user_manage() {
        $this->load->view('settings/user_manage');
    }
	
	//高级查询
	public function other_search() {
		$this->load->view('settings/other_search');	
	}
	
	//单个库存查询
	public function inventory() {
		$this->load->view('settings/inventory');	
	}
	
	//选择客户
	public function select_customer() {
		$this->load->view('settings/select_customer');	
	}
	
	//选择供应商
	public function select_vendor() {
		$this->load->view('settings/select_vendor');	
	}

    //选择销售单据列表
    public function invsa_batch() {
        $this->load->view('invsa/invsa_batch');
    }

    //查看销售单据的具体信息
    public function invsa_info() {
/*        $id = str_enhtml($this->input->get('id',TRUE));
        $this->load->model('data_model');
        $list = $this->data_model->invsa_info(' and (a.invsaid='.$id.')','order by id desc');
        foreach ($list as $arr=>$row) {
            $v[$arr]['invSpec']           = $row['spec'];
            $v[$arr]['taxRate']           = intval($row['id']);
            $v[$arr]['srcOrderEntryId']   = 0;
            $v[$arr]['srcOrderNo']        = NULL;
            $v[$arr]['locationId']        = 0;
            $v[$arr]['goods']             = $row['goodsno'].' '.$row['goodsname'].' '.$row['spec'];
            $v[$arr]['invName']           = $row['goodsname'];
            $v[$arr]['qty']               = (float)abs($row['qty']);
            $v[$arr]['locationName']      = '';
            $v[$arr]['amount']            = (float)abs($row['amount']);
            $v[$arr]['taxAmount']         = (float)abs($row['amount']);
            $v[$arr]['price']             = (float)$row['price'];
            $v[$arr]['tax']               = 0;
            $v[$arr]['mainUnit']          = $row['unitname'];
            $v[$arr]['deduction']         = (float)$row['deduction'];
            $v[$arr]['invId']             = intval($row['goodsid']);
            $v[$arr]['invNumber']         = $row['number'];
            $v[$arr]['discountRate']      = (float)$row['discountrate'];
            $v[$arr]['description']       = $row['description'];
            $v[$arr]['unitId']            = intval($row['unitid']);
            $v[$arr]['srcOrderId']        = 0;
        }*/
        $this->load->view('invsa/invsa_info');
    }

    //查看某个采购计划的信息
    public function purchasePlan_info(){
/*        $id = str_enhtml($this->input->get('id',TRUE));
        $this->load->model('data_model');
        $list = $this->data_model->purchasePlanInfo(' and (a.planId='.$id.')','order by a.id desc');
        foreach ($list as $arr=>$row) {
            $v[$arr]['planId']      = $row['planId'];
            $v[$arr]['goodsid']      = $row['goodsid'];
            $v[$arr]['goods_no']      = $row['goods_no'];
            $v[$arr]['create_time']           = $row['create_time'];
            $v[$arr]['qty']               = (float)abs($row['qty']);
            $v[$arr]['goodsName']      = $row['goodsName'];
            $v[$arr]['unitName']      = $row['unitName'];
        }*/
        $this->load->view('invpu/purchasePlan_info');
    }

    //查看购货单据的具体信息
    public function invpu_info(){
        $this->load->view('invpu/invpu_info');
    }

    //查看购货单的具体信息
    public function sheet_info(){
        $this->load->view('sheet/sheet_info');
    }

    //查看商品规格
    public function spec_info(){
        $specArr = array(
            1 => array('spec1' => '长', 'spec2' => '宽', 'spec3' =>'深', 'spec4' => 'spec4', 'spec5' => 'spec5', 'spec6' => 'spec6', 'spec7' => 'spec7', 'spec8' => 'spec8', 'spec9' => 'spec9'),
            2 => array('spec1' => '长', 'spec2' => '宽', 'spec3' =>'高', 'spec4' => 'spec4', 'spec5' => 'spec5', 'spec6' => 'spec6', 'spec7' => 'spec7', 'spec8' => 'spec8', 'spec9' => 'spec9'),
            3 => array('spec1' => '长', 'spec2' => '宽', 'spec3' =>'深1', 'spec4' => 'spec4', 'spec5' => 'spec5', 'spec6' => 'spec6', 'spec7' => 'spec7', 'spec8' => 'spec8', 'spec9' => 'spec9'),
            4 => array('spec1' => '长', 'spec2' => '宽', 'spec3' =>'深2', 'spec4' => 'spec4', 'spec5' => 'spec5', 'spec6' => 'spec6', 'spec7' => 'spec7', 'spec8' => 'spec8', 'spec9' => 'spec9'),
            5 => array('spec1' => '长', 'spec2' => '宽', 'spec3' =>'深3', 'spec4' => 'spec4', 'spec5' => 'spec5', 'spec6' => 'spec6', 'spec7' => 'spec7', 'spec8' => 'spec8', 'spec9' => 'spec9')
        );
        $data = array();
        $type = $_GET['type'];
        $specStr = $_GET['specStr'];
        $a = explode(',', $specStr);
        $b = $specArr[$type];
        foreach ($a as $val){
            $values = explode('_', $val);
            $data[] = array('spec' => $b[$values[0]], 'val' => $values[1]);
        }
        $result['data'] = $data;
        $this->load->view('goods/spec_info',$result);
    }



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */