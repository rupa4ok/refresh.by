<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10.09.2018
 * Time: 11:40
 */

class Csv
{
    
    public function exportCsv($table, $filename)
    {
        
        $data = R::findAll($table);
        $list = array();
        
        switch ($table) {
            case 'object':
                $list[] = [
                    'IdObject',
                    'Naim',
                    'Data',
                    'Status',
                    'IdProrab'
                ];
                foreach ($data as $item) {
                    $list[] = array_push($list, [
                        $item->id,
                        $item->name,
                        '01.' . $item->mounth . '.' . $item->year,
                        $item->status,
                        $item->users_id,
                    ]);
                }
                break;
            case 'object_people':
                $list[] = [
                    'IdRabota',
                    'IdRabotnik',
                    'IdObject',
                    'Koef'
                ];
                foreach ($data as $item) {
                    $list[] = array_push($list, [
                        $item->id,
                        $item->people_id,
                        $item->object_id,
                        $item->koef
                    ]);
                }
                break;
            case 'time':
                $data = R::findAll($table, 'WHERE timework != 0');
                $list[] = [
                    'IdChasy',
                    'IdRabotnik',
                    'Data',
                    'IdRabota',
                    'Chasy',
                    'IdProrab'
                ];
                foreach ($data as $item) {
                    $list[] = array_push($list, [
                        $item->id,
                        $item->nrabotnik,
                        $item->date . '.' . $item->mounth . '.' . $item->year,
                        $item->nraboti,
                        $item->timework,
                        $item->nprorab
                    ]);
                }
                break;
            case 'people':
                $list[] = [
                    'FIO',
                    'FIOShort',
                    'Nrabotnik',
                ];
                foreach ($data as $item) {
                    $list[] = array_push($list, [
                        $item->fio,
                        $item->fioshort,
                        $item->nrabotnik]);
                }
                break;
            case 'users':
                $list[] = [
                    'Id',
                    'Naim',
                    'Email',
                ];
                foreach ($data as $item) {
                    $list[] = array_push($list, [
                        $item->id,
                        $item->name,
                        $item->email
                    ]);
                }
                break;
            default:
                return;
        }
        
        $fp = fopen($filename, 'w');
        
        foreach ($list as $fields) {
            @fputcsv($fp, $fields, '|');
        }
        fclose($fp);
        
        return;
    }
    
    /**
     * Изменение статусов объектов
     */
    public function block()
    {
        $date = date('m');
        $table = 'object';
        $result = R::findAll($table, "mounth < $date");
        
        foreach ($result as $res) {
            $object = R::dispense('object');
            $object->id = $res['id'];
            $object->status = 'Сдан';
            R::store($object);
        }
    }
    
}