<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/13
 * Time: 13:02
 */
require ("connect/config.php");
require ("Log.class.php");

class DB {

    /**
     * 声明PDO对象
     */
    private $pdo;

    /**
     * 声明sql声明语句
     */
    private $sQuery;

    /**
     * 声明数据库设置
     */
    private $settings;

    /**
     * 声明是否连接数据库
     */
    private $bConnected = false;

    /**
     * 声明数据库异常日志
     */
    private $log;

    /**
     * 声明SQL语句参数
     */
    private $parameters;

    /**
     * DB constructor.
     * 声明默认构造函数
     * 1.初始化日志类
     * 2.连接数据库
     * 3.创建参数数组
     */
    public function __construct(){
        $this->log = new Log();
        $this->Contect();
        $this->parameters = array();
    }

    /**
     * 连接数据库
     */
    private function Contect() {
        $dsn = 'mysql:dbname='. DBName . ';host=' . DBHost . '';

        try {
            $this->pdo = new PDO($dsn, DBUser, DBPassword, array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ));//记录任何异常日志
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//记录任何SQL声明语句错误日志
            $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);//设置连接状态为true
            $this->bConnected = true;
        } catch (PDOException $e) {
            echo $this->ExceptionLog($e->getMessage());
            die();
        }
    }

    /**
     * 关闭数据库连接
     * @return mixed
     */
    public function CloseConnection()
    {
        $this->pdo = null;
    }

    /**
     * 初始化函数
     * @param unknown $query
     * @param string $parameters
     */
    private function Init($query, $parameters = "") {
        //连接数据库
        if (!$this->bConnected) {
            $this->Contect();
        }

        try {
            // Prepare query
            $this->sQuery = $this->pdo->prepare($query);

            //添加更多参数到参数数组里
            $this->bindMore($parameters);

            //绑定参数
            if (!empty($this->parameters)) {
                foreach ($this->$parameters as $param => $value) {
                    $type = PDO::PARAM_STR;
                    switch ($value[1]) {
                        case is_int($value[1]):
                            $type = PDO::PARAM_INT;
                            break;
                        case is_bool($value[1]):
                            $type = PDO::PARAM_BOOL;
                            break;
                        case is_null($value[1]):
                            $type = PDO::PARAM_NULL;
                            break;
                    }
                    $this->sQuery->bindValue($value[0],$value[1], $type);
                }
            }

            //执行SQL语句
            $this->sQuery->execute();

        } catch (PDOException $e) {
            echo $this->ExceptionLog($e->getMessage(), $query);
            die();
        }

        //重置参数
        $this->parameters = array();
    }

    /**
     * @param unknown $para
     * @param unknown $value
     */
    public function bind($para, $value) {
        $this->parameters[sizeof($this->parameters)] = [":" . $para, $value];
    }

    /**
     * 绑定更多的参数到参数数组中
     * @param unknown $parray
     */
    public function bindMore($parray) {
        if (empty($this->parameters) && is_array($parray)) {
            $columns = array_keys($parray);
            foreach ($columns as $i => $column) {
                $this->bind($column, $parray[$column]);
            }
        }
    }

    /**
     * 实现数据库查询
     * @param unknown $query
     * @param null $params
     * @param int $ferchmode
     * @return null
     */
    public function query($query, $params = null, $ferchmode = PDO::FETCH_ASSOC) {
        $query = trim(str_replace("\r", " ", $query));
        $this->Init($query, $params);
        $rawStatement = explode(" ", preg_replace("/\s+|\t+|\n+/", " ", $query));

        //哪一句SQL语句被执行
        $statement = strtolower($rawStatement[0]);

        if ($statement === 'select' || $statement === 'show') {
            return $this->sQuery->fetchAll($ferchmode);
        } elseif ($statement === 'insert' || $statement === 'update' || $statement === 'delete') {
            return $this->sQuery->rowCount();
        } else {
            return null;
        }

    }

    /**
     * 实现返回最新一次插入数据的主键
     * @return mixed
     */
    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }

    /**
     * 实现开始事务
     * @return mixed
     */
    public function beginTransaction() {
        return $this->pdo->beginTransaction();
    }

    /**
     * 实现执行事务
     * @return mixed
     */
    public function executeTransaction() {
        return $this->pdo->commit();
    }

    /**
     * 实现事务回滚
     * @return mixed
     */
    public function rollBack() {
        return $this->pdo->rollBack();
    }

    /**
     * 实现查询结果集中的列
     * @param unknown $query
     * @param null $param
     * @return array|null
     */
    public function column($query, $param = null) {
        $this->Init($query, $param);
        $Columns = $this->sQuery->fetchAll(PDO::FETCH_NUM);

        $column = null;

        foreach ($Columns as $cells) {
            $column[] = $cells[0];
        }

        return $column;
    }

    /**
     * 实现查询结果集中的行
     * @param unknown $query
     * @param null $params
     * @param int $fetchmode
     * @return mixed
     */
    public function row($query, $params = null, $fetchmode = PDO::FETCH_ASSOC ) {
        $this->Init($query, $params);
        $result = $this->sQuery->fetch($fetchmode);
        $this->sQuery->closeCursor();
        return $result;
    }

    /**
     * 实现查询单列
     * @param unknown $query
     * @param null $params
     * @return mixed
     */
    public function single($query, $params = null) {
        $this->Init($query, $params);
        $result = $this->sQuery->fetchColumn();
        $this->sQuery->closeCursor();
        return $result;
    }

    /**
     * 异常日志
     * @param unknown $message
     * @param string $sql
     * @return string
     */
    private function ExceptionLog($message, $sql = "") {
        $exception  = 'Unhandled Exception.<br />';
        $exception .= $message;
        $exception .= "<br /> You can find the error back in the log.";

        if (!empty($sql)) {
            $message .= "\r\nRaw SQL : " . $sql;
        }

        $this->log->write($message);
        return $exception;
    }

}