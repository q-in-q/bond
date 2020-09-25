<?php
require_once 'routeros_api.class.php';

class ApiHandler extends RouterosAPI
{
    public $response = [];
    public $id_user = '12345';

    public function  __construct($config = [])
    {
        $valid = array_fill_keys(['hostname', 'username', 'password', 'port', 'ssl'], null);
        $this->config = array_merge($valid, $config);
        // print_r($this->config);
        // $this->ssl = true;
        // $this->port = 8729;

        if ($this->config['port'] != null) $this->port = $this->config['port'];
        $this->connect($this->config['hostname'], $this->config['username'], $this->config['password']);
        if ($this->connected === false)
            $this->error = "Tidak dapat terkoneksi dengan Mikrotik! setelah " . $this->attempts . " percobaan";
        return $this->connected;
    }

    public function __destruct()
    {
        parent::disconnect();
    }

    public function getRouterStatus()
    {
        // Resource Info
        $this->write('/system/resource/print');
        $a = $this->read()[0];
        $resource['uptime'] = $a['uptime'];
        $resource['name'] = $this->read($this->write('/system/identity/print'))[0]['name'];
        $resource['info'] = $a['platform'] . ' ' . $a['board-name'] . ' ' . $a['architecture-name'];
        $resource['version'] = $a['version'];
        $resource['cpu_name'] = $a['cpu-count'] . 'x ' . $a['cpu'] . ', ~' . $a['cpu-frequency'] . 'Mhz';
        $resource['cpu_load'] = $a['cpu-load'].'%';
        $resource['memory'] = $this->formatBytes($a['total-memory'] - $a['free-memory']) . '/' . $this->formatBytes($a['total-memory']);
        $resource['hdd'] = $this->formatBytes($a['total-hdd-space'] - $a['free-hdd-space']).'/'. $this->formatBytes($a['total-hdd-space']);
        $resource['architecture'] = $a['architecture-name'];
        $resource['board-name'] = $a['board-name'];
        $resource['time'] = $this->read($this->write('/system/clock/print'))[0]['time'];

        $this->response['resource'] = $resource;
        return; 
    }

    public function getClock(){
        $this->write('/system/clock/print');
        $a = $this->read()[0];
        $resource['time'] = $a['time'];
        $resource['date'] = $a['date'];
        $resource['timezone'] = $a['time-zone-name'];

        $this->response['resource'] = $resource;
        return; 
    }

    public function getCPULoad()
    {
        $this->write('/system/resource/print');
        $a = $this->read()[0];
        return $a['cpu-load'].'%';
    }

    public function getQueue()
    {
        $this->write('/queue/simple/print');
        $a = $this->read();
        foreach($a as $d) {
            $item['name'] = $d['name'];
            $item['max-limit'] = $d['max-limit'];
            $item['disabled'] = $d['disabled'];
            $item['.id'] = $d['.id'];
            $resource[] = $item;
        }

        $this->response['resource'] = $resource;
    
        return $a;
    }

    public function getQueueTree()
    {
        $this->write('/queue/tree/print');
        $a = $this->read();
        foreach($a as $d) {
            $item['.id'] = $d['.id'];
            $item['name'] = $d['name'];
            $item['limit-at'] = $d['limit-at'];
            $item['max-limit'] = $d['max-limit'];
            $item['disabled'] = $d['disabled'];
            $resource[] = $item;
        }
        $this->response['resource'] = $resource;

        return $a;
    }

    public function getScheduler()
    {
        $this->write('/system/scheduler/print');
        $a = $this->read();
        foreach($a as $d)
            {
                $item['.id'] = $d['.id'];
                $item['name'] = $d['name'];
                $item['start-time'] = $d['start-time'];
                $item['start-date'] = $d['start-date'];
                $resource[] = $item;
            }

            // $this->response['resource'] = $resource;

            return $a;

    }

    public function addSchDOWNSQ($id, $name, $date, $time, $bw, $bwup)
    {
        $sc = "/queue simple set [find name=\"$name-BOND\"] name=\"$name\" \r\n /queue simple set [find name=\"$name\"] max-limit=$bw \r\n \r\n:delay 2  \r\n \r\n/system scheduler remove [/system scheduler find name=\"$name-SQ_UP-$bwup\"] \r\n \r\n:delay 2  \r\n \r\n/system scheduler remove [/system scheduler find name=\"$name-SQ_DOWN-$bw\"]";
        $this->write('/system/scheduler/add', false);
        $this->write('=name=' . $name.'-SQ_DOWN-'.$bw , false);
        $this->write('=start-date= ' . $date, false);
        $this->write('=start-time=' . $time, false);
        $this->write('=on-event=' . "$sc");
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }
    public function addSchUPSQ($name, $date, $time, $bw)
    {
        $sc = "/queue simple set [find name=\"$name-BOND\"] max-limit=$bw \r\n \r\n:delay 2";
        $this->write('/system/scheduler/add', false);
        $this->write('=name=' . $name.'-SQ_UP-'.$bw , false);
        $this->write('=start-date= ' . $date, false);
        $this->write('=start-time=' . $time, false);
        $this->write('=on-event=' . "$sc");
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }

    public function editSchUPSQ($id, $name, $date, $time, $bw)
    {
        $sc = "/queue simple set [find name=\"$name-BOND\"] max-limit=$bw \r\n \r\n:delay 2";
        $this->write('/system/scheduler/set', false);
        $this->write( '=.id='. $id , false);
        $this->write( '=name='.$name.'-SQ_UP-'.$bw, false);
        $this->write('=start-date='.$date, false);
        $this->write('=start-time='.$time, false);
        $this->write('=on-event=' . "$sc");
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }

    public function editSchDOWNSQ($name, $date, $time, $bw, $bwup)
    {
        $sc = "queue simple set [find name=\"$name-BOND\"] max-limit=$bw\r\n \r\n/queue simple set [find name=\"$name-BOND\"] name=\"$name\" \r\n \r\n:delay 2  \r\n \r\n/system scheduler remove [/system scheduler find name=\"$name-SQ_UP-$bwup\"] \r\n \r\n:delay 2  \r\n \r\n/system scheduler remove [/system scheduler find name=\"$name-SQ_DOWN-$bw\"]";
        $this->write('/system/scheduler/set', false);
        $this->write( '=.id='. $name.'-SQ_DOWN-'.$bw , false);
        $this->write('=start-date='.$date, false);
        $this->write('=start-time='.$time, false);
        $this->write('=on-event=' . "$sc");
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }

    public function setQueue($id, $name)
    {
        $this->write('/queue/simple/set', false);
        $this->write( '=.id='. $id , false);
        $this->write('=name='.$name."-BOND");
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }

    public function setSQ($name, $maxlim){
        $this->write('/queue/simple/set', false);
        $this->write('=.id=' .$name.'-BOND' , false);
        $this->write('=name=' . $name, false);
        $this->write('=max-limit='. $maxlim);
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }

    public function delSchUPSQ($name)
    {
        $this->write('/system/scheduler/remove', false);
        $this->write( '=.id='. "\"$name-SQ_UP\"");
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }

    public function delSchDOWNSQ($name)
    {
        $this->write('/system/scheduler/remove', false);
        $this->write( '=.id='. "\"$name-SQ_DOWN\"");
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }


    // ============================================= EDIT SQ ON RUN ===============================================

    public function editSqUpRun($id, $name, $bw){
        $this->write('/system/scheduler/set', false);
        $this->write('=.id='.$id , false);
        $this->write('=name='.$name.'-SQ_UP-'.$bw , true);
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }

    public function editSqDownRun($nameQueue, $date, $bwdown, $bwup){
        $sc = "/queue simple set [find name=\"$nameQueue-BOND\"] max-limit=$bwdown \r\n/queue simple set [find name=\"$nameQueue-BOND\"] name=\"$nameQueue\" \r\n:delay 2\r\n/system scheduler remove [/system scheduler find name=\"$nameQueue-SQ_UP-$bwup\"]\r\n:delay 2  \r\n/system scheduler remove [/system scheduler find name=\"$nameQueue-SQ_DOWN-$bwdown\"]";
        $this->write('/system/scheduler/set', false);
        $this->write('=.id=' . $nameQueue.'-SQ_DOWN-'.$bwdown , false);
        $this->write('=start-date='.$date , false);
        $this->write('=on-event='."$sc");
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }

    public function editQueueRun($nameQueue, $bw){
        $this->write('/queue/simple/set', false);
        $this->write('=.id=' . $nameQueue.'-BOND' , false);
        $this->write('=max-limit='.$bw);
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }



    // QUEUE TREE
    public function addSchUPQT($name, $date, $time, $limatUP, $maxlimUP, $limatDOWN, $maxlimDOWN)
    {
        $sc = "/queue tree set [find name=\"$name-Up_BOND\"] limit-at=$limatUP max-limit=$maxlimUP \r\n \r\n/queue tree set [find name=\"$name-Down_BOND\"] limit-at=$limatDOWN max-limit=$maxlimDOWN";
        $this->write('/system/scheduler/add', false);
        $this->write('=name='. $name.'-QT_UP-'.$limatUP.'-'.$maxlimUP.'-'.$limatDOWN.'-'.$maxlimDOWN , false);
        $this->write('=start-date= ' . $date, false);
        $this->write('=start-time=' . $time, false);
        $this->write('=on-event=' . "$sc");
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }

    public function addSchDOWNQT($name, $date, $time, $limatUP, $maxlimUP, $limatDOWN, $maxlimDOWN, $elimUP, $elimDOWN, $emaxUP, $emaxDOWN)
    {
        $sc = "/queue tree set [find name=\"$name-Up_BOND\"] name=\"$name-Up\" \r\n \r\nqueue tree set [find name=\"$name-Down_BOND\"] name=\"$name-Down\" \r\n/queue tree set [find name=\"$name-Up\"] limit-at=$limatUP max-limit=$maxlimUP \r\n \r\n/queue tree set [find name=\"$name-Down\"] limit-at=$limatDOWN max-limit=$maxlimDOWN \r\n \r\n:delay 2\r\n/system scheduler remove [/system scheduler find name=\"$name-QT_UP-$elimUP-$elimDOWN-$emaxUP-$emaxDOWN\"] \r\n \r\n:delay 2\r\n \r\n/system scheduler remove [/system scheduler find name=\"$name-QT_DOWN-$limatUP-$maxlimUP-$limatDOWN-$maxlimDOWN\"]";
        $this->write('/system/scheduler/add', false);
        $this->write('=name=' . $name."-QT_DOWN-".$limatUP.'-'.$maxlimUP.'-'.$limatDOWN.'-'.$maxlimDOWN , false);
        // $this->write('=comment= ' . $name);
        $this->write('=start-date= ' . $date, false);
        $this->write('=start-time=' . $time, false);
        $this->write('=on-event=' . "$sc");
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }

    public function editSchUPQT($id, $name, $date, $time, $limatUP, $maxlimUP, $limatDOWN, $maxlimDOWN)
    {
        $sc = "/queue tree set [find name=\"$name-Up_BOND\"] limit-at=$limatUP max-limit=$maxlimUP \r\n \r\n/queue tree set [find name=\"$name-Down_BOND\"] limit-at=$limatDOWN max-limit=$maxlimDOWN";
        $this->write('/system/scheduler/set', false);
        $this->write('=.id= ' . $id , false);
        $this->write('=name='. $name.'-QT_UP-'.$limatUP.'-'.$maxlimUP.'-'.$limatDOWN.'-'.$maxlimDOWN , false);
        $this->write('=start-date= ' . $date, false);
        $this->write('=start-time=' . $time, false);
        $this->write('=on-event=' . "$sc");
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }

    public function editSchDOWNQT($name, $date, $time, $limatUP, $maxlimUP, $limatDOWN, $maxlimDOWN, $elimUP, $elimDOWN, $emaxUP, $emaxDOWN)
    {
        $sc = "/queue tree set [find name=\$name-Up\"] limit-at=$limatUP max-limit=$maxlimUP \r\n \r\n/queue tree set [find name=\"$name-Down\"] limit-at=$limatDOWN max-limit=$maxlimDOWN \r\n:delay 2\r\n/system scheduler remove [/system scheduler find name=\"$name-QT_UP-$elimUP-$elimDOWN-$emaxUP-$emaxDOWN\"] \r\n \r\n:delay 2\r\n \r\n/system scheduler remove [/system scheduler find name=\"$name-QT_DOWN-$limatUP-$maxlimUP-$limatDOWN-$maxlimDOWN\"]";        
        $this->write('/system/scheduler/set', false);
        $this->write('=.id='. $name.'-QT_DOWN-'.$limatUP.'-'.$maxlimUP.'-'.$limatDOWN.'-'.$maxlimDOWN , false);
        $this->write('=start-date= ' . $date, false);
        $this->write('=start-time=' . $time, false);
        $this->write('=on-event=' . "$sc");
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }
    public function delSchUPQT($name)
    {
        $this->write('/system/scheduler/remove', false);
        $this->write( '=.id='. "\"$name-QT_UP\"");
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }
    public function delSchDOWNQT($name)
    {
        $this->write('/system/scheduler/remove', false);
        $this->write( '=.id='. "\"$name-QT_DOWN\"");
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }

    public function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1000);
        $suffixes = array('', 'K', 'M', 'G', 'T');   
    
        return round(pow(1000, $base - floor($base)), $precision) .''. $suffixes[floor($base)];
    }

    // public function addSchTempQT($name)
    // {
    //     date_default_timezone_set('Asia/Jakarta');
    //     $date = date("M/d/Y");
    //     $time = date("H:i:s", time() + 2);
    //     $sc = "/queue tree set [find name=\"$name-Up\"] name=$name-Up_BOND\r\n \r\nqueue tree set [find name=\"$name-Down\"] name=$name-Down_BOND \r\n \r\n:delay 5\r\n \r\nsystem scheduler remove [/system scheduler find name=\"$name-Temp\"]";
    //     $this->write('/system/scheduler/add', false);
    //     $this->write('=name=' .$name.'-Temp' , false);
    //     $this->write('=start-date= ' . $date, false);
    //     $this->write('=start-time=' . $time, false);
    //     $this->write('=on-event=' . "$sc");
    //     $data = $this->read();

    //     $this->response['lastResponse'] = $data;
    //     return (empty($data)) ? true : false;
    // }

    // public function delSchTempQT($name,$limup,$maxup,$limdown,$maxdown)
    // {
    //     date_default_timezone_set('Asia/Jakarta');
    //     $date = date("M/d/Y");
    //     $time = date("H:i:s", time() + 1);
    //     $sc = "queue tree set [find name=\"$name-Up_BOND\"] name=$name-Up\r\n \r\nqueue tree set [find name=\"$name-Down_BOND\"] name=$name-Down \r\n/queue tree set [find name=\"$name-Up\"] limit-at=\"$limup\" max-limit=\"$maxup\"\r\n/queue tree set [find name=\"$name-Down\"] limit-at=\"$limdown\" max-limit=\"$maxdown\" \r\n:delay 2\r\n \r\nsystem scheduler remove [/system scheduler find name=\"$name-Temp\"]";
    //     $this->write('/system/scheduler/add', false);
    //     $this->write('=name=' .$name.'-Temp' , false);
    //     $this->write('=start-date= ' . $date, false);
    //     $this->write('=start-time=' . $time, false);
    //     $this->write('=on-event=' . "$sc");
    //     $data = $this->read();

    //     $this->response['lastResponse'] = $data;
    //     return (empty($data)) ? true : false;
    // }


    // ==================================== EDIT ON RUN QT =============================================
    public function editSchQtUpRun($id, $name, $bw){
        $this->write('/system/scheduler/set', false);
        $this->write('=.id='.$id , false);
        $this->write('=name='.$name.'-QT_UP-'.$bw);
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }

    public function editSchQtDownRun($name, $bwdownold, $tgl, $limatUP, $maxlimUP , $limatDOWN, $maxlimDOWN, $elimUP,$elimDOWN,$emaxUP,$emaxDOWN){
        $sc = "/queue tree set [find name=\"$name-Up_BOND\"] name=\"$name-Up\" \r\n \r\nqueue tree set [find name=\"$name-Down_BOND\"] name=\"$name-Down\" \r\n/queue tree set [find name=\"$name-Up\"] limit-at=$limatUP max-limit=$maxlimUP \r\n \r\n/queue tree set [find name=\"$name-Down\"] limit-at=$limatDOWN max-limit=$maxlimDOWN \r\n \r\n:delay 2\r\n/system scheduler remove [/system scheduler find name=\"$name-QT_UP-$elimUP-$elimDOWN-$emaxUP-$emaxDOWN\"] \r\n \r\n:delay 2\r\n \r\n/system scheduler remove [/system scheduler find name=\"$name-QT_DOWN-$limatUP-$maxlimUP-$limatDOWN-$maxlimDOWN\"]";
        $this->write('/system/scheduler/set', false);
        $this->write('=.id='.$name.'-QT_DOWN-'.$bwdownold, false);
        $this->write('=start-date='.$tgl, false);
        $this->write('=on-event='.$sc);
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }

    public function editQtUpRun($name, $lim, $max){
        $this->write('/queue/tree/set', false);
        $this->write('=.id='.$name.'-Up_BOND' , false);
        $this->write('=limit-at='.$lim , false);
        $this->write('=max-limit='.$max);
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }

    public function editQtDownRun($name, $lim, $max){
        $this->write('/queue/tree/set', false);
        $this->write('=.id='.$name.'-Down_BOND' , false);
        $this->write('=limit-at='.$lim , false);
        $this->write('=max-limit='.$max);
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }

    public function SetQueueDown($name){
        $this->write('/queue/tree/set', false);
        $this->write('=.id='.$name.'-Down' , false);
        $this->write('=name='.$name.'-Down_BOND', true);
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }
    public function SetQueueUp($name){
        $this->write('/queue/tree/set', false);
        $this->write('=.id='.$name.'-Up' , false);
        $this->write('=name='.$name.'-Up_BOND', true);
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }
    public function delQueueUp($name, $limat, $maxlim){
        $this->write('/queue/tree/set', false);
        $this->write('=.id='.$name.'-Up_BOND' , false);
        $this->write('=name='.$name.'-Up', false);
        $this->write('=limit-at='.$limat, false);
        $this->write('=max-limit='.$maxlim, true);
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }
    public function delQueueDown($name, $limat, $maxlim){
        $this->write('/queue/tree/set', false);
        $this->write('=.id='.$name.'-Down_BOND' , false);
        $this->write('=name='.$name.'-Down', false);
        $this->write('=limit-at='.$limat, false);
        $this->write('=max-limit='.$maxlim, true);
        $data = $this->read();

        $this->response['lastResponse'] = $data;
        return (empty($data)) ? true : false;
    }

}