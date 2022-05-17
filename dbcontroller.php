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
        $sql = "select * from t_car_base LIMIT " . $index . ", " . $limit;
        $statement = $this->mConnector->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    public function sortTCars($order_by, $sort_order, $index, $limit)
    {
        $sql = "select * from t_car_base order by " . $order_by . " " . $sort_order . " LIMIT " . $index . ", " . $limit;
        $statement = $this->mConnector->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    public function getMCommonList()
    {
        $sql = "select data_type,data_cd,value1 from m_common";
        $statement = $this->mConnector->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();

        $m_common = array();
        foreach ($result as $value) {
            $m_common[$value["data_type"]][$value["data_cd"]] = $value["value1"];
        }
        return $m_common;
    }

    public function searchTCars($keyword, $carNumber, $index, $limit)
    {
        $sql = "SELECT * from t_car_base where ";
        if ($keyword) {
            $sql .= "(maker_name like :mname or car_name like :cname) ";
        }
        if ($carNumber) {
            if ($keyword) {
                $sql .= "and ";
            }
            $sql .= "frame_number like :fnumber ";
        }
        $sql .= " LIMIT " . $index . ", " . $limit;
        $statement = $this->mConnector->prepare($sql);
        if ($keyword) {
            $keyParam = '%' . $keyword . '%';
            $statement->bindParam(":mname", $keyParam);
            $statement->bindParam(":cname", $keyParam);
        }
        if ($carNumber) {
            $carNumParam = '%' . $carNumber . '%';
            $statement->bindParam(":fnumber", $carNumParam);
        }
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    public function getTCarBaseById($id)
    {
        $sql = "select * from t_car_base where id=:tid";
        $statement = $this->mConnector->prepare($sql);
        $statement->bindParam(":tid", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getRowCount($keyword, $carNumber)
    {
        $sql = "SELECT count(*) from t_car_base ";
        if ($keyword || $carNumber) {
            $sql .= "where ";
        }
        if ($keyword) {
            $sql .= "(maker_name like :mname or car_name like :cname) ";
        }
        if ($carNumber) {
            if ($keyword) {
                $sql .= "and ";
            }
            $sql .= "frame_number like :fnumber ";
        }
        $statement = $this->mConnector->prepare($sql);
        if ($keyword) {
            $keyParam = '%' . $keyword . '%';
            $statement->bindParam(":mname", $keyParam);
            $statement->bindParam(":cname", $keyParam);
        }
        if ($carNumber) {
            $carNumParam = '%' . $carNumber . '%';
            $statement->bindParam(":fnumber", $carNumParam);
        }
        $statement->execute();
        $count = $statement->fetchColumn();
        return $count;
    }

    public function getMMakerList()
    {
        $sql = "select id,name from m_maker";
        $statement = $this->mConnector->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    public function getMCarNameList()
    {
        $sql = "select * from m_car_name";
        $statement = $this->mConnector->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    public function getMMakerById($id)
    {
        $sql = "select name from m_maker where id=:id";
        $statement = $this->mConnector->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }

    public function getMCarNameById($id)
    {
        $sql = "select name from m_car_name where id=:id";
        $statement = $this->mConnector->prepare($sql);
        $statement->bindParam(":id", $id);
        $statement->execute();
        $result = $statement->fetchColumn();
        return $result;
    }

    public function insertTCar ($st_cd, $maker_name, $car_name, $car_type, $frame_number, $first_entry_date, $out_color_name, $shift_cd, $shift_cnt, $shift_posi_cd, $sale_price) {
        $this->mConnector->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql="insert into t_car_base (ins_user_id, st_cd, maker_name, car_name, car_type, frame_number, first_entry_date, out_color_name, shift_cd, shift_cnt, shift_posi_cd, sale_price) values (:ins_user_id, :st_cd, :maker_name, :car_name, :car_type, :frame_number, :first_entry_date, :out_color_name, :shift_cd, :shift_cnt, :shift_posi_cd, :sale_price)";
		$statement = $this->mConnector->prepare($sql);
		$ins_user_id=0;
		$statement->bindParam(":ins_user_id",$ins_user_id);
		$statement->bindParam(":st_cd",$st_cd);
		$statement->bindParam(":maker_name",$maker_name);
		$statement->bindParam(":car_name",$car_name);
		$statement->bindParam(":car_type",$car_type);
		$statement->bindParam(":frame_number",$frame_number);
		$statement->bindParam(":first_entry_date",$first_entry_date);
		$statement->bindParam(":out_color_name",$out_color_name);
		$statement->bindParam(":shift_cd",$shift_cd);
		$statement->bindParam(":shift_cnt",$shift_cnt);
		$statement->bindParam(":shift_posi_cd",$shift_posi_cd);
		$statement->bindParam(":sale_price",$sale_price);
		return $statement->execute();
    }

    public function updateTCar($id, $st_cd, $maker_name, $car_name, $car_type, $frame_number, $first_entry_date, $out_color_name, $shift_cd, $shift_cnt, $shift_posi_cd, $sale_price) {
        $this->mConnector->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "update t_car_base set st_cd = :st_cd, maker_name = :maker_name, car_name = :car_name, car_type = :car_type, frame_number = :frame_number, first_entry_date = :first_entry_date, out_color_name = :out_color_name, shift_cd = :shift_cd, shift_cnt = :shift_cnt, shift_posi_cd = :shift_posi_cd, sale_price = :sale_price where id= :id";
        $statement = $this->mConnector->prepare($sql);
		$statement->bindParam(":id",$id);
		$statement->bindParam(":st_cd",$st_cd);
		$statement->bindParam(":maker_name",$maker_name);
		$statement->bindParam(":car_name",$car_name);
		$statement->bindParam(":car_type",$car_type);
		$statement->bindParam(":frame_number",$frame_number);
		$statement->bindParam(":first_entry_date",$first_entry_date);
		$statement->bindParam(":out_color_name",$out_color_name);
		$statement->bindParam(":shift_cd",$shift_cd);
		$statement->bindParam(":shift_cnt",$shift_cnt);
		$statement->bindParam(":shift_posi_cd",$shift_posi_cd);
		$statement->bindParam(":sale_price",$sale_price);
        return $statement->execute();
    }
}
