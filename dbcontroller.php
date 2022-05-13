<?php
class DBController
{
    public $mConnector;
    function __construct($conn)
    {
        $this->mConnector = $conn;
    }

    public function getTCarList($index, $limit)
    {
        $sql = "select * from t_car_base LIMIT ".$index.", ".$limit;
        $statement = $this->mConnector->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    public function sortTCars ($order_by, $sort_order, $index, $limit) {
		$sql="select * from t_car_base order by ".$order_by." ".$sort_order." LIMIT ".$index.", ".$limit;
		$statement = $this->mConnector->prepare($sql);
		$statement->execute();
		$result = $statement->fetchAll();
		return $result;
	}

    public function getMCommonList(){
		$sql = "select data_type,data_cd,value1 from m_common";
		$statement = $this->mConnector->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll();

		$m_common=array();
		foreach ($result as $value) {
			$m_common[$value["data_type"]][$value["data_cd"]]=$value["value1"];
		}
		return $m_common;
	}

    public function searchTCars ($keyword, $carNumber, $index, $limit){
        $sql="SELECT * from t_car_base where ";
        if($keyword) {
            $sql.= "(maker_name like :mname or car_name like :cname) ";
        }
        if($carNumber) {
            if($keyword) {
                $sql.= "and ";
            }
            $sql.= "frame_number like :fnumber ";
        }
        $sql.=" LIMIT ".$index.", ".$limit;
        $statement = $this->mConnector->prepare($sql);
        if($keyword) {
            $keyParam = '%'.$keyword.'%';
			$statement->bindParam(":mname", $keyParam);
			$statement->bindParam(":cname", $keyParam);
        }
        if($carNumber) {
            $carNumParam = '%'.$carNumber.'%';
            $statement->bindParam(":fnumber", $carNumParam);
        }
        $statement->execute();
        $result = $statement->fetchAll();
		return $result;
	}

    public function getRowCount($keyword, $carNumber) {
        $sql="SELECT count(*) from t_car_base ";
        if ($keyword || $carNumber) {
            $sql .= "where ";
        }
        if($keyword) {
            $sql.= "(maker_name like :mname or car_name like :cname) ";
        }
        if($carNumber) {
            if($keyword) {
                $sql.= "and ";
            }
            $sql.= "frame_number like :fnumber ";
        }
        $statement = $this->mConnector->prepare($sql);
        if($keyword) {
            $keyParam = '%'.$keyword.'%';
			$statement->bindParam(":mname", $keyParam);
			$statement->bindParam(":cname", $keyParam);
        }
        if($carNumber) {
            $carNumParam = '%'.$carNumber.'%';
            $statement->bindParam(":fnumber", $carNumParam);
        }
        $statement->execute();
        $count = $statement->fetchColumn();
		return $count;
    }

    public function getMMakerList(){
		$sql="select id,name from m_maker";
		$statement = $this->mConnector->prepare($sql);
		$statement->execute();
		$result=$statement->fetchAll();
		return $result;
	}
}
