<?php
class Category extends Db
{
    private $id;
    private $name;
    private $parent_id;
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
        return $this->parent_id;
    }
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }

    public function getListChild(){
        return $this->listChild;
    }

    public function setListChild($listChild){
        $this->$listChild[] = $listChild;
    }

    public function getAll()
    {
        $sql = "select * from categories";
        return $this->select($sql);
    }
    public function buildTree($parent_id, $categories)
    {
        // $child_categories = [];
        // foreach ($categories as $category) {
        //     if ($category["id"] == $parent_id) {
        //         $id = $category["id"];
        //         $name = $category["name"];
        //         $parent_id = $category["parent_id"];
        //         $listChild = $this->buildTree($category["id"], $categories);
        //         $node = new Category();
        //         $node->setId($id);
        //         $node->setName($name);
        //         $node->setParentId($parent_id);
        //         $node->setListChild($listChild);
        //         array_push($child_categories, $node);
        //     }
        // }
        // return $child_categories;

        $arr = array();
        foreach ($categories as $value) {
            if($value['parent_id'] == $parent_id){
                $node = new Category();
                $id = $value['id'];
                $name = $value['name'];
                $listChild = array();
                array_push($listChild, $this->buildTree($id, $categories));
                $node->setId($id);
                $node->setName($name);
                $node->setParentId($parent_id);
                $node->listChild = $listChild;
                $arr[] = $node;
            }
        }
        return $arr;
    }
}