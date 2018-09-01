<?php

namespace App\Repositories;

class SearchRepository
{
    use BaseRepository;

    private $limit          = 20;
    private $offset         = 0;
    private $draw           = 1;
    private $order_field    = 'created_at';
    private $order_type     = 'desc';
    private $totalCount     = 0;
    private $where          = "1=1";
    private $model          = null;

    private function init($request,$model)
    {
        $this->model = $model;

        $this->getDraw($request);
        $this->getWhere($request);
        $this->getOrderBy($request);
        $this->getLimit($request);
        $this->getOffset($request);
    }

    /**
     * 返回前台传递的 draw
     * 
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    private function getDraw($request)
    {
        $this->draw = $request['draw'] ? (int)$request['draw'] : $this->draw;
        return $this->draw;
    }

    /**
     * 获取查询条件
     * 
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    private function getWhere($request)
    {   
        $temp = array();
        if (empty($request['search'])) {
            return false;
        }

        $search = $request['search'];
        if (empty($search['value'])) {
            return false;
        }

        $search_value = $search['value'];

        //查询数组
        $search_arr = explode('#+',$search_value);

        foreach ($search_arr as $key => $val) {
            $arr = explode('&+',$val);
            $condition = isset($arr[1]) ? trim($arr[1]) : '';
            $param = isset($arr[0]) ? trim($arr[0]) : '';

            $arr = explode('=+',$param);
            $field = isset($arr[0]) ? trim($arr[0]) : '';
            $value = isset($arr[1]) ? trim($arr[1]) : '';

            switch ($condition) {
                case 'eq':
                    $this->where .= " and ".$field." = '".$value."'";
                    break;
                case 'lt':
                    $this->where .= " and ".$field." < '".$value."'";
                    break;
                case 'elt':
                    $this->where .= " and ".$field." <= '".$value."'";
                    break;
                case 'gt':
                    $this->where .= " and ".$field." > '".$value."'";
                case 'egt':
                    $this->where .= " and ".$field." >= '".$value."'";
                case 'like':
                    $this->where .= " and ".$field." like '%".$value."%'";
                    break;
                default:
                    # code...
                    break;
            }
        }

        if(strpos($this->where,'1=1 and') !== false){
            $this->where = str_replace('1=1 and', '', $this->where);
        }

        return $this->where;
    }

    /**
     * 获取排序
     *
     * @param $columns
     * @param $order
     * @return array|string
     */
    private function getOrderBy($request) 
    {
        if(empty($request['columns']) || empty($request['order'])){
            return false;
        }

        $columns = $request['columns'];
        $order = $request['order'];

        if (!isset($order[0]['column'])) {
            return false;
        }

        $column_index = $order[0]['column'];

        if (isset($columns[$column_index]['orderable']) && $columns[$column_index]['orderable'] == true) {
            $this->order_field = $columns[$column_index]['name'];
            $this->order_type = $order[0]['dir'];
            return true;
        } else {
            return false;
        }
    }

    /**
     * 获取limit
     */
    private function getLimit($request)
    {
        $this->limit = !empty($request['length']) ? (int)$request['length'] : $this->limit;
        return $this->limit;
    }

    /**
     * [getCount description]
     * @return [type] [description]
     */
    private function getCount()
    {   
        if(empty($this->where)){
            $this->totalCount = $this->model->count();
        }else{
            $this->totalCount = $this->model->whereRaw($this->where)->count();
        }

        return $this->totalCount;
    }

    /**
     * 获取总页数
     * 
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    private function getTotalPage()
    {   
        return  ceil($this->getCount()/$this->limit);
    }

    /**
     * 获取当前页面
     */
    private function getPage($request)
    {
        $page = !empty($request['start']) ? (((int)$request['start'])+1) : 1;
        $totalPage = self::getTotalPage();
        return $page > 1 ? max(1,min($page,$totalPage)) : 1;
    }

    /**
     * 获取offset
     */
    private function getOffset($request)
    {
        $this->offset = ($this->getPage($request)-1) * $this->limit;
        return $this->offset;
    }

    /**
     * 获取datatable插件列表
     * 
     * @param  [type] $data [description]
     * @return [type]             [description]
     */
    private function plusBtnHtml($data,$route)
    {
        foreach ($data as $key => $value) {
            $data[$key]['button'] = '<a href="'.url("admin/".$route,[$value['id'],'edit']).'"><button type="button" class="btn btn-success btn-xs"><i class="fa fa-pencil"> 编辑</i></button></a> <a href="javascript:;" data-id="'.$value['id'].'" class="btn btn-danger btn-xs destroy"><i class="fa fa-trash"> 删除</i><form action="'.url("admin/".$route,[$value['id']]).'" method="POST" name="delete_item_'.$value['id'].'" style="display:none"><input type="hidden" name="_method" value="DELETE">'.csrf_field().'</form></a>';
        }

        return $data;
    }

    /**
     * 查询入口
     * 
     * @return [type] [description]
     */
    public function handleSearch($request,$route,$model)
    {
        $this->init($request,$model);


        $data = $this->model
            ->offset($this->offset)->limit($this->limit)
            ->whereRaw($this->where)
            ->orderBy($this->order_field,$this->order_type)
            ->get()->toArray();

        return [
            'draw'              => $this->draw,
            'recordsTotal'      => $this->totalCount,
            'recordsFiltered'   => $this->totalCount,
            'data'              => $this->plusBtnHtml($data,$route)
        ];
    }
}