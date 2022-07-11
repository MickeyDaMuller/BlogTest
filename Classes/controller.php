<?php 

include_once('model.php');

class dataModel extends DataController{

    public function viewItem($query,$array)
    {
      return $this->read($query,$array);

    }

    public function viewItemById($id)
    {
      return $this->readById($id);

    }

    public function addItem($query,$array)
    {
      return $this->create($query,$array);

    }

    public function viewItemByPagination($page,$dbTable)
    {
      return $this->readByPagination($page,$dbTable);

    }

    public function deleteItem($id)
    {
      return $this->delete($id);

    }

}

?>