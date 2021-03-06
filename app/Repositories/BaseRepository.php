<?php

namespace App\Repositories;

trait BaseRepository
{
    /**
     * Get number of records
     *
     * @return array
     */
    public function getNumber()
    {
        return $this->model->count();
    }

    /**
     * Update columns in the record by id.
     *
     * @param $id
     * @param $input
     * @return App\Model|User
     */
    public function updateColumn($id, $input)
    {
        $this->model = $this->getById($id);

        foreach ($input as $key => $value) {
            $this->model->{$key} = $value;
        }

        return $this->model->save();
    }

    /**
     * Destroy a model.
     *
     * @param  $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->getById($id)->delete();
    }

    /**
     * 通过条件删除数据
     *
     * @param $where
     * @return mixed
     */
    public function deleteByWhere($where)
    {
        return $this->model->where($where)->delete();
    }

    /**通过条件获取一条数据
     *
     * @param $where
     * @return mixed
     */
    public function getOneByWhere($where)
    {
        return $this->model->where($where)->take(1)->get()->toArray();
    }

    /**
     * 删除
     *
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * 通过主键获取一条id
     *
     * @return App\Model
     */
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * 通过条件获取列表数据
     *
     * @return array User
     */
    public function all($where = '')
    {
        if ($where) {
            return $this->model->where($where)->get();
        } else {
            return $this->model->get();
        }
    }

    /**
     * Get number of the records
     *
     * @param  int $number
     * @param  string $sort
     * @param  string $sortColumn
     * @return Paginate
     */
    public function page($number = 10, $sortColumn = 'created_at',$sort = 'desc')
    {
        return $this->model->orderBy($sortColumn, $sort)->paginate($number);
    }

    /**
     * Store a new record.
     *
     * @param  $input
     * @return User
     */
    public function store($input)
    {
        return $this->save($this->model, $input);
    }

    /**
     * Update a record by id.
     *
     * @param  $id
     * @param  $input
     * @return User
     */
    public function update($id, $input)
    {
        $this->model = $this->getById($id);
        return $this->save($this->model, $input);
    }

    /**
     * 插入数据
     */
    public function insertData($data)
    {
        return $this->model->insert($data);
    }

    /**
     * 插入数据
     */
    public function updateData($where,$data)
    {
        return $this->model->where($where)->update($data);
    }

    /**
     * Save the input's data.
     *
     * @param  $model
     * @param  $input
     * @return User
     */
    public function save($model, $input)
    {
        $model->fill($input);
        $model->save();
        return $model;
    }
}
