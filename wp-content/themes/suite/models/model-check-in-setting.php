<?php

class Admin_Model_Check_In_Setting{

    // ==================== IMPORT ==========================
    public function importMember($filename)
    {
        require_once(DIR_CLASS . 'PHPExcel.php');
        // Tien hanh xac thuc file
        $inputFileType = PHPExcel_IOFactory::identify($filename);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);

        // Chi doc du lieu
        //$objReader->setReadDataOnly(true);

        // Load du lieu sang dang doi tuong
        $objReader->load("$filename");
        // Lay ra so trang
        $total_sheets = $objPHPExcel->getSheetCount();
        // Lay ra ten trang
        $allSheetName = $objPHPExcel->getSheetNames();
        // Chon trang can truy xuat
        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
        // Lay ra so dong cuoi cung
        $highestRow = $objWorksheet->getHighestRow();
        // Lay ra ten cot cuoi cung
        $highestColumn = $objWorksheet->getHighestColumn();
        // Chuyen doi ten cot ve vi tri thu, vi du C la 3, D la 4
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $arraydata = array();
        // Lap qua tung o du lieu
        // Dong dau tien la cot tieu de nen se lap gia tri tu dong 2
        for ($row = 2; $row <= $highestRow; ++$row) {
            for ($col = 0; $col < $highestColumnIndex; ++$col) {
                // Lay gia tri cua tung o de do vao mang
                $value = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                $arraydata[$row - 2][$col] = $value;
            }
        }
        global $wpdb;
        $table = $wpdb->prefix . 'member';
        foreach($arraydata as $item) {
            $mobile = $item[8] == null ? "" : $item[8];
            $phone = $item[9] == null ? "" : $item[9];
            $tax = $item[10] == null ? "" : $item[10];
            $email = $item[11] == null ? "" : $item[11];
            $data = array(
                'serial' => $item[1],
                'company_vn' => $item[2],
                'company_cn' => $item[3],
                'address_vn' => $item[4],
                'address_cn' => $item[5],
                'contact' => $item[6],
                'position' => $item[7],
                'mobile' => $mobile,
                'tax' => $tax,
                'phone' => $phone,
                'email' => $email,
                'region' => $item[12],
                'service' => $item[13],
            );
            $wpdb->insert($table, $data);
        }
    }

    // =================== EXPORT ============================
    public function exportMember()
    {
        require_once(DIR_CLASS . 'PHPExcel.php');
        $exExport = new PHPExcel();

        // Tao cot title
        $exExport->setActiveSheetIndex(0)
            ->setCellValue('A1', 'serial')
            ->setCellValue('B1', 'company_vn')
            ->setCellValue('C1', 'company_cn')
            ->setCellValue('D1', 'address_vn')
            ->setCellValue('E1', 'address_cn')
            ->setCellValue('F1', 'contact')
            ->setCellValue('G1', 'position')
            ->setCellValue('H1', 'mobile')
            ->setCellValue('I1', 'phone')
            ->setCellValue('J1', 'tax')
            ->setCellValue('K1', 'email')
            ->setCellValue('L1', 'region')
            ->setCellValue('M1', 'service');
        
        // Tao noi dung chen tu dong 2
        global $wpdb;
        $table = $wpdb->prefix . 'member';
        $sql = "SELECT * FROM $table";
        $row = $wpdb->get_results($sql, ARRAY_A);
        if(!empty($row)) {
            $i = 2;
            foreach($row as $val){
                $exExport->setActiveSheetIndex(0)
                    ->setCellValueExplicit('A' . $i, $val['serial'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('B' . $i, $val['company_vn'])
                    ->setCellValue('C' . $i, $val['company_cn'])
                    ->setCellValue('D' . $i, $val['address_vn'])
                    ->setCellValue('E' . $i, $val['address_cn'])
                    ->setCellValue('F' . $i, $val['contact'])
                    ->setCellValue('G' . $i, $val['position'])
                    ->setCellValueExplicit('H' . $i, $val['mobile'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('I' . $i, $val['phone'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValueExplicit('J' . $i, $val['tax'], PHPExcel_Cell_DataType::TYPE_STRING)
                    ->setCellValue('K' . $i, $val['email'])
                    ->setCellValue('L' . $i, $val['region'])
                    ->setCellValue('M' . $i, $val['service']);
                $i++;    
            }
        }

        // Tao file excel va save lai theo dang path 
        //$objWriter = PHPExcel_IOFactory::createWriter($exExport, 'Excel2007');
        //$full_path = EXPORT_DIR . date("YmdHis") . '_report.xlsx'; //duong dan file
        //$objWriter->save($full_path);

        // Tao file excel va down truc tiep xuong client 
        $filename = date("YmdHis") . '_memberlist.xlsx';
        $objWriter = PHPExcel_IOFactory::createWriter($exExport, 'Excel2007');
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=$filename");
        header('Cache-Control: max-age=0');
        ob_end_clean();
        //ob_start();
        $objWriter->save('php://output');
    }
}