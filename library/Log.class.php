<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/13
 * Time: 13:03
 */

class Log {

    /**
     * 定义日志路径
     */
    private $path = '/logs/';

    /**
     * Log constructor.
     * 默认构造方法
     * 设置时区和日志的路径
     */
    public function __construct(){
        date_default_timezone_set('Asia/Shanghai');
        $this->path = dirname(__FILE__) .$this->path;
    }

    /**
     * 创建日志
     * @param $message
     */
    public function write($message) {
        $date = new DateTime();
        $log = $this->path . $date->format('Y-m-d').".txt";

        if (is_dir($this->path)) {
            if (!file_exists($log)) {
                $fh = fopen($log,'a+') or die("Fatal Error !");
                $logcontent = 'Time : ' . $date->format('H:i:s')."\r\n". $message."\r\n";
                fwrite($fh, $logcontent);
                fclose($fh);
            }
            else {
                $this->edit($log, $date, $message);
            }
        }
        else {
            if (mkdir($this->path, 0777) === true) {
                $this->write($message);
            }
        }
    }

    /**
     * 编辑日志
     * @param unknown $log
     * @param unknown $date
     * @param unknown $message
     */
    private function edit($log, $date, $message) {
        $logcontent = "Time : ". $date->format('H:i:s')."\r\n" . $message . "\r\n\r\n";
        $logcontent = $logcontent . file_get_contents($log);
        file_put_contents($log, $logcontent);
    }

}