<?php
class Category extends Db
{
    private $id;
    private $name;
    private $parentId;
    public $listChild = array();

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    public function getParentId()
    {
        return $this->parentId;
    }
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    public function getListChild(){
        return $this->listChild;
    }

    public function setListChild($listChild){
        $this->$listChild = $listChild;
    }

    public function getAll()
    {
        $sql = "select * from categories";
        return $this->select($sql);
    }

    public function insertCategory($name, $parentId){
        $sql = "insert into categories (name, parent_id) values(?,?);";
        $this->insert($sql, array($name, $parentId));
        $sql = "SELECT LAST_INSERT_ID() as max;";
        $data = $this->select($sql);
        return ($data != null)? $data[0]['max']:null;
    }

    public function deleteCategory($id){
        $sql = "delete from categories where id = ?";
       return $this->delete($sql, array($id));
    }

    public function editCategory($name, $parentId, $id){
        $sql = "update categories set name = ?, parent_id = ? where id = ?";
       return $this->update($sql, array($name, $parentId, $id));
    }

    public function buildTree($parentId, $categories)
    {
        $arr = array();
        foreach ($categories as $value) {
            if($value['parent_id'] == $parentId){
                $node = new Category();
                $id = $value['id'];
                $name = $value['name'];
                $listChild = array();
                array_push($listChild, $this->buildTree($id, $categories));
                $node->setId($id);
                $node->setName($name);
                $node->setParentId($parentId);
                $node->listChild = $listChild;
                $arr[] = $node;
            }
        }
        return $arr;
    }
}